<?php $__env->startSection('title', 'Manage Order Booking | ' . App\Models\Setting::get('store_name', 'Cracker Demo') . ' Sivakasi'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-8 select-none text-slate-800">
    
    <!-- Title banner -->
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
        <div>
            <h2 class="text-xl font-extrabold text-slate-900 tracking-tight flex items-center gap-2">
                <a href="<?php echo e(route('admin.orders.index')); ?>" class="text-slate-400 hover:text-slate-650"><i class="fa-solid fa-arrow-left"></i></a>
                <span>Order Booking Management</span>
            </h2>
            <p class="text-[10px] text-slate-450 uppercase tracking-widest leading-none font-bold">Reference: <strong class="text-slate-700 font-mono select-all"><?php echo e($order->order_number); ?></strong></p>
        </div>
        
        <div class="flex gap-3">
            <a href="<?php echo e(route('admin.orders.invoice', $order->id)); ?>" target="_blank" class="bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 px-4 py-2 rounded-xl text-xs font-bold flex items-center gap-1.5 shadow-sm transition-all active:scale-95">
                <i class="fa-solid fa-file-invoice text-crimson-600"></i> View Retail Invoice
            </a>
        </div>
    </div>

    <!-- Main edit grid layout -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
        
        <!-- Left: Order Details (ColSpan 2) -->
        <div class="lg:col-span-2 bg-white border border-slate-200 rounded-2xl p-6 shadow-sm space-y-6">
            
            <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest border-b border-slate-150 pb-3">Client Booking Information</h3>

            <!-- Customer Shipping details -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-xs text-slate-650 font-medium">
                <div class="space-y-2">
                    <div class="text-slate-400 uppercase tracking-wider text-[10px] font-bold">Delivery Location</div>
                    <div class="font-bold text-slate-800"><?php echo e($order->name); ?></div>
                    <div class="leading-relaxed"><?php echo e($order->address); ?></div>
                    <?php if($order->landmark): ?>
                        <div class="text-slate-550"><strong class="text-slate-400 text-[10px] uppercase font-bold">Landmark:</strong> <?php echo e($order->landmark); ?></div>
                    <?php endif; ?>
                    <div><?php echo e($order->city); ?>, <?php echo e($order->state); ?> - <strong><?php echo e($order->pincode); ?></strong></div>
                </div>
                <div class="space-y-2.5">
                    <div class="text-slate-400 uppercase tracking-wider text-[10px] font-bold">Contact Particulars</div>
                    <div class="flex justify-between">
                        <span class="text-slate-500">Contact Mobile:</span>
                        <strong class="text-slate-800 font-mono select-all"><?php echo e($order->phone); ?></strong>
                    </div>
                    <?php if($order->whatsapp): ?>
                    <div class="flex justify-between">
                        <span class="text-slate-500">WhatsApp:</span>
                        <strong class="text-slate-800 font-mono select-all"><?php echo e($order->whatsapp); ?></strong>
                    </div>
                    <?php endif; ?>
                    <div class="flex justify-between border-t border-slate-200 pt-2.5">
                        <span class="text-slate-500">Booked On:</span>
                        <span class="text-slate-700 font-bold"><?php echo e($order->created_at->format('d M Y, h:i A')); ?></span>
                    </div>
                </div>
            </div>

            <!-- Ordered Line Items -->
            <div class="border border-slate-200 rounded-xl overflow-hidden shadow-sm">
                <table class="w-full text-left text-xs border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200 text-slate-450 font-bold text-[10px] uppercase tracking-wider">
                            <th class="py-3.5 px-4">Firecracker Name</th>
                            <th class="py-3.5 px-4 text-center">Unit</th>
                            <th class="py-3.5 px-4 text-right">Price (₹)</th>
                            <th class="py-3.5 px-4 text-center">Qty Ordered</th>
                            <th class="py-3.5 px-4 text-right pr-4">Total (₹)</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-150 text-slate-700 font-semibold">
                        <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="hover:bg-slate-50/50">
                            <td class="py-3 px-4 text-slate-800"><?php echo e($item->product_name); ?></td>
                            <td class="py-3 px-4 text-slate-400 text-center font-mono"><?php echo e($item->pack_size); ?></td>
                            <td class="py-3 px-4 text-right text-slate-600">₹<?php echo e(number_format($item->price, 2)); ?></td>
                            <td class="py-3 px-4 text-center text-slate-800 font-mono font-bold"><?php echo e($item->quantity); ?></td>
                            <td class="py-3 px-4 text-right font-bold text-slate-800 pr-4">₹<?php echo e(number_format($item->total_price, 2)); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

            <!-- Totals -->
            <div class="bg-slate-50 border border-slate-200 p-4 rounded-xl space-y-2.5 text-xs font-semibold">
                <div class="flex justify-between text-slate-500">
                    <span>Original subtotal printed MRP sum:</span>
                    <span class="line-through text-slate-400">₹<?php echo e(number_format($order->subtotal, 2)); ?></span>
                </div>
                <div class="flex justify-between text-crimson-600">
                    <span>Flat <?php echo e(App\Models\Setting::get('discount_percent', 60)); ?>% Discount Savings:</span>
                    <span class="font-black">-₹<?php echo e(number_format($order->discount_amount, 2)); ?></span>
                </div>
                <div class="flex justify-between text-slate-800 border-t border-slate-200 pt-2.5 text-sm font-black">
                    <span>Net Amount Payable:</span>
                    <span class="text-crimson-650 text-base font-black">₹<?php echo e(number_format($order->net_amount, 2)); ?></span>
                </div>
            </div>

            <!-- Notes -->
            <?php if($order->notes): ?>
            <div class="space-y-1.5 text-xs">
                <span class="text-slate-400 uppercase tracking-widest text-[9px] font-bold"><i class="fa-solid fa-pencil"></i> Client Order Instructions / Notes</span>
                <p class="bg-slate-50 border border-slate-200 p-3.5 rounded-xl text-slate-700 leading-normal font-semibold"><?php echo e($order->notes); ?></p>
            </div>
            <?php endif; ?>

        </div>

        <!-- Right: Status updates Form (ColSpan 1) -->
        <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm space-y-6">
            
            <h3 class="text-xs font-bold text-slate-700 uppercase tracking-widest border-b border-slate-200 pb-3">Update Order Status</h3>

            <form action="<?php echo e(route('admin.orders.update', $order->id)); ?>" method="POST" class="space-y-5 text-xs">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                
                <!-- Order Status Select -->
                <div class="space-y-1.5">
                    <label class="block text-[9px] font-bold text-slate-450 uppercase tracking-wider mb-1 px-0.5">Booking Delivery Status</label>
                    <select name="order_status" class="w-full bg-slate-55 border border-slate-200 focus:border-slate-350 focus:bg-white rounded-xl px-3 py-2.5 text-xs text-slate-700 focus:outline-none transition-all">
                        <option value="pending" <?php echo e($order->order_status === 'pending' ? 'selected' : ''); ?>>Pending Approval</option>
                        <option value="approved" <?php echo e($order->order_status === 'approved' ? 'selected' : ''); ?>>Approved / Paid</option>
                        <option value="processing" <?php echo e($order->order_status === 'processing' ? 'selected' : ''); ?>>Processing / Packing</option>
                        <option value="shipped" <?php echo e($order->order_status === 'shipped' ? 'selected' : ''); ?>>Dispatched / Shipped</option>
                        <option value="delivered" <?php echo e($order->order_status === 'delivered' ? 'selected' : ''); ?>>Delivered</option>
                        <option value="cancelled" <?php echo e($order->order_status === 'cancelled' ? 'selected' : ''); ?>>Cancelled</option>
                    </select>
                </div>

                <!-- Payment Status Select -->
                <div class="space-y-1.5">
                    <label class="block text-[9px] font-bold text-slate-450 uppercase tracking-wider mb-1 px-0.5">Payment Verification Status</label>
                    <select name="payment_status" class="w-full bg-slate-55 border border-slate-200 focus:border-slate-350 focus:bg-white rounded-xl px-3 py-2.5 text-xs text-slate-700 focus:outline-none transition-all">
                        <option value="pending" <?php echo e($order->payment_status === 'pending' ? 'selected' : ''); ?>>Pending Payment Verification</option>
                        <option value="paid" <?php echo e($order->payment_status === 'paid' ? 'selected' : ''); ?>>Verified / Paid (Full)</option>
                        <option value="verified" <?php echo e($order->payment_status === 'verified' ? 'selected' : ''); ?>>Verified (Partial)</option>
                    </select>
                </div>

                <!-- Lorry Transport details -->
                <div class="space-y-4 border-t border-slate-200 pt-4">
                    <span class="text-[9px] text-slate-400 font-bold uppercase tracking-wider block"><i class="fa-solid fa-truck"></i> Transport Lorry Tracking</span>
                    
                    <div class="space-y-1.5">
                        <label class="block text-[9px] font-bold text-slate-450 uppercase tracking-wider mb-1 px-0.5">Lorry Transport Agent Name</label>
                        <input type="text" name="transport_name" value="<?php echo e($order->transport_name); ?>" placeholder="e.g. KPN Transport, ARC Lorry Service" class="w-full bg-slate-55 border border-slate-200 focus:border-slate-350 focus:bg-white rounded-xl px-3.5 py-2.5 text-xs text-slate-700 placeholder-slate-400 focus:outline-none transition-all">
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-[9px] font-bold text-slate-450 uppercase tracking-wider mb-1 px-0.5">Lorry Receipt (LR) tracking number</label>
                        <input type="text" name="lr_number" value="<?php echo e($order->lr_number); ?>" placeholder="e.g. LR-987654-XYZ" class="w-full bg-slate-55 border border-slate-200 focus:border-slate-350 focus:bg-white rounded-xl px-3.5 py-2.5 text-xs text-slate-700 placeholder-slate-400 focus:outline-none transition-all font-mono">
                    </div>
                </div>

                <!-- Action Button -->
                <button type="submit" class="w-full bg-gradient-to-r from-crimson-600 to-crimson-500 hover:from-crimson-700 hover:to-crimson-600 text-white font-extrabold py-3 rounded-xl text-xs uppercase tracking-wider shadow-sm transform active:scale-95 transition-all flex items-center justify-center gap-1.5">
                    <i class="fa-solid fa-circle-check text-[11px]"></i>
                    <span>Apply Modifications</span>
                </button>

            </form>

        </div>

    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Athi\OneDrive\Desktop\crackers\resources\views/admin/orders/show.blade.php ENDPATH**/ ?>