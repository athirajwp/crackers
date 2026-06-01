<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    /**
     * Store a newly created order.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'whatsapp' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'address' => 'required|string',
            'landmark' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'pincode' => 'required|string|max:10',
            'items' => 'required|array',
            'items.*.id' => 'required|exists:products,id',
            'items.*.qty' => 'required|integer|min:0',
            'notes' => 'nullable|string',
        ]);

        $cartItems = $request->input('items');
        $subtotal = 0; // MRP sum
        $netAmount = 0; // selling price sum
        $validatedItems = [];

        // Fetch products and calculate totals safely
        foreach ($cartItems as $item) {
            $qty = (int) $item['qty'];
            if ($qty <= 0) {
                continue;
            }

            $product = Product::find($item['id']);
            if (!$product) {
                return response()->json(['error' => 'Product not found!'], 422);
            }

            $itemSubtotal = $product->mrp * $qty;
            $itemNet = $product->selling_price * $qty;

            $subtotal += $itemSubtotal;
            $netAmount += $itemNet;

            $validatedItems[] = [
                'product' => $product,
                'qty' => $qty,
                'price' => $product->selling_price,
                'total_price' => $itemNet,
            ];
        }

        if (empty($validatedItems)) {
            return response()->json(['error' => 'Your cart is empty!'], 422);
        }

        // Validate Minimum Purchase
        $minOrder = Setting::get('min_order_value', 3800);
        if ($netAmount < $minOrder) {
            return response()->json([
                'error' => "Minimum order value is ₹{$minOrder}. Your current order is ₹{$netAmount}. Please add more items."
            ], 422);
        }

        $discountAmount = $subtotal - $netAmount;

        try {
            DB::beginTransaction();

            $order = Order::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'whatsapp' => $request->whatsapp ?? $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'landmark' => $request->landmark,
                'city' => $request->city,
                'state' => $request->state,
                'pincode' => $request->pincode,
                'subtotal' => $subtotal,
                'discount_amount' => $discountAmount,
                'net_amount' => $netAmount,
                'payment_status' => 'pending',
                'order_status' => 'pending',
                'notes' => $request->notes,
            ]);

            foreach ($validatedItems as $vItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $vItem['product']->id,
                    'product_name' => $vItem['product']->name,
                    'pack_size' => $vItem['product']->pack_size,
                    'price' => $vItem['price'],
                    'quantity' => $vItem['qty'],
                    'total_price' => $vItem['total_price'],
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'redirect' => route('checkout.success', ['order_number' => $order->order_number])
            ]);

        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Order placement failed: ' . $exception->getMessage());
            return response()->json(['error' => 'Something went wrong! Please try again.'], 500);
        }
    }

    /**
     * Show checkout success page with payment information.
     */
    public function success($orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)->with('items')->firstOrFail();

        // Load payment details
        $upiId = Setting::get('store_upi', 'aathishacrackers@okaxis');
        $storeName = Setting::get('store_name', 'Cracker Demo');
        
        // Build raw UPI pay link for QR generation:
        // upi://pay?pa=address@bank&pn=Payee%20Name&am=Amount&cu=INR
        $encodedStoreName = urlencode($storeName);
        $upiPayUrl = "upi://pay?pa={$upiId}&pn={$encodedStoreName}&am={$order->net_amount}&cu=INR";
        
        // Use Google Charts API to render QR Code representing this UPI string
        $qrCodeUrl = "https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=" . urlencode($upiPayUrl) . "&choe=UTF-8";

        $bankDetails = [
            'name' => Setting::get('bank_name', 'State Bank of India'),
            'acc_no' => Setting::get('bank_acc_no', '1234567890'),
            'ifsc' => Setting::get('bank_ifsc', 'SBIN0000123'),
            'holder' => Setting::get('bank_holder', 'Cracker Demo'),
        ];

        $whatsappNum = Setting::get('store_whatsapp', '919998887776');

        // Formulate pre-filled WhatsApp verification text
        $waMessage = "Hello " . $storeName . ", I have placed an order!\n\n"
                   . "*Order Number:* {$order->order_number}\n"
                   . "*Customer Name:* {$order->name}\n"
                   . "*Total Amount:* ₹" . number_format($order->net_amount, 2) . "\n\n"
                   . "I am attaching the payment screenshot below for verification.";
        
        $whatsappUrl = "https://api.whatsapp.com/send?phone={$whatsappNum}&text=" . urlencode($waMessage);

        return view('checkout_success', compact('order', 'qrCodeUrl', 'bankDetails', 'whatsappUrl', 'whatsappNum'));
    }
}
