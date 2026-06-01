<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display listings of orders.
     */
    public function index(Request $request)
    {
        $status = $request->input('status');
        
        $query = Order::orderBy('created_at', 'desc');
        
        if ($status) {
            $query->where('order_status', $status);
        }
        
        $orders = $query->get();
        return view('admin.orders.index', compact('orders', 'status'));
    }

    /**
     * Display details of specific order.
     */
    public function show(Order $order)
    {
        $order->load('items');
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Update order details (statuses and lorry logistics).
     */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'order_status' => 'required|in:pending,approved,processing,shipped,delivered,cancelled',
            'payment_status' => 'required|in:pending,paid,verified',
            'transport_name' => 'nullable|string|max:255',
            'lr_number' => 'nullable|string|max:255',
        ]);

        $order->update([
            'order_status' => $request->order_status,
            'payment_status' => $request->payment_status,
            'transport_name' => $request->transport_name,
            'lr_number' => $request->lr_number,
        ]);

        return redirect()->route('admin.orders.show', $order->id)->with('success', 'Order status updated successfully!');
    }

    /**
     * Print invoice for order.
     */
    public function printInvoice(Order $order)
    {
        $order->load('items');
        return view('admin.orders.invoice', compact('order'));
    }
}
