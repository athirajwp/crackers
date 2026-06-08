<?php
    $theme = App\Models\Setting::get('admin_theme', 'gold');
    
    // Set theme classes
    $themeClasses = [
        'gold' => [
            'active' => 'bg-gold-500 text-slate-950',
            'accent' => 'gold-500'
        ],
        'blue' => [
            'active' => 'bg-blue-600 text-white shadow-md shadow-blue-500/20',
            'accent' => 'blue-600'
        ],
        'crimson' => [
            'active' => 'bg-crimson-600 text-white shadow-md shadow-crimson-500/20',
            'accent' => 'crimson-600'
        ],
        'emerald' => [
            'active' => 'bg-emerald-600 text-white shadow-md shadow-emerald-500/20',
            'accent' => 'emerald-600'
        ]
    ];
    
    $currentTheme = $themeClasses[$theme] ?? $themeClasses['gold'];
?>


<?php $__env->startSection('title', 'Store Settings | Admin Console'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-8 select-none text-xs font-semibold">
    
    <!-- Header -->
    <div>
        <h2 class="text-xl font-extrabold text-slate-900 tracking-tight">Store Configurations Console</h2>
        <p class="text-[10px] text-slate-500 uppercase tracking-widest leading-normal font-semibold font-sans mt-2">Modify client-side booking values, payment profiles, and support details</p>
    </div>

    <!-- Error blocks -->
    <?php if(isset($errors) && $errors->any()): ?>
    <div class="bg-crimson-50 border border-crimson-200 text-crimson-700 p-4 rounded-2xl text-xs space-y-1 shadow-sm font-semibold">
        <strong class="block font-bold"><i class="fa-solid fa-circle-exclamation mr-1 text-crimson-600"></i> Please correct the following errors:</strong>
        <ul class="list-disc pl-4 space-y-0.5">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
    <?php endif; ?>

    <!-- Main Config Form -->
    <form action="<?php echo e(route('admin.settings.update')); ?>" method="POST" class="grid grid-cols-1 lg:grid-cols-2 gap-8 text-xs font-semibold">
        <?php echo csrf_field(); ?>
        
        <!-- Left: General Configurations & Support -->
        <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm space-y-6">
            <h3 class="text-xs font-bold text-slate-700 uppercase tracking-widest border-b border-slate-200 pb-3 flex items-center gap-1.5"><i class="fa-solid fa-gears text-<?php echo e($currentTheme['accent']); ?>"></i> General Configuration</h3>
            
            <div class="space-y-1.5">
                <label class="block text-[9px] font-bold text-slate-500 uppercase tracking-wider mb-1 px-0.5">Website / Store Name</label>
                <input type="text" name="store_name" required value="<?php echo e($settings['store_name']); ?>" class="w-full bg-slate-50 border border-slate-200 focus:border-<?php echo e($currentTheme['accent']); ?> focus:bg-white rounded-xl px-3.5 py-2.5 text-xs text-slate-800 focus:outline-none transition-all">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label class="block text-[9px] font-bold text-slate-500 uppercase tracking-wider mb-1 px-0.5">Minimum Order Amount (₹)</label>
                    <input type="number" name="min_order_value" required value="<?php echo e($settings['min_order_value']); ?>" class="w-full bg-slate-50 border border-slate-200 focus:border-<?php echo e($currentTheme['accent']); ?> focus:bg-white rounded-xl px-3.5 py-2.5 text-xs text-slate-800 focus:outline-none transition-all">
                </div>
                <div class="space-y-1.5">
                    <label class="block text-[9px] font-bold text-slate-500 uppercase tracking-wider mb-1 px-0.5">Global Discount Rate (%)</label>
                    <input type="number" min="0" max="100" name="discount_percent" required value="<?php echo e($settings['discount_percent']); ?>" class="w-full bg-slate-50 border border-slate-200 focus:border-<?php echo e($currentTheme['accent']); ?> focus:bg-white rounded-xl px-3.5 py-2.5 text-xs text-slate-800 focus:outline-none transition-all font-mono">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 border-t border-slate-200 pt-4">
                <div class="space-y-1.5">
                    <label class="block text-[9px] font-bold text-slate-500 uppercase tracking-wider mb-1 px-0.5">WhatsApp Booking Mobile</label>
                    <input type="text" name="store_whatsapp" required value="<?php echo e($settings['store_whatsapp']); ?>" placeholder="91..." class="w-full bg-slate-50 border border-slate-200 focus:border-<?php echo e($currentTheme['accent']); ?> focus:bg-white rounded-xl px-3.5 py-2.5 text-xs text-slate-800 focus:outline-none transition-all font-mono">
                </div>
                <div class="space-y-1.5">
                    <label class="block text-[9px] font-bold text-slate-500 uppercase tracking-wider mb-1 px-0.5">Support Call Phone</label>
                    <input type="text" name="store_phone" required value="<?php echo e($settings['store_phone']); ?>" class="w-full bg-slate-50 border border-slate-200 focus:border-<?php echo e($currentTheme['accent']); ?> focus:bg-white rounded-xl px-3.5 py-2.5 text-xs text-slate-800 focus:outline-none transition-all font-mono">
                </div>
            </div>

            <div class="space-y-1.5">
                <label class="block text-[9px] font-bold text-slate-500 uppercase tracking-wider mb-1 px-0.5">Support Email Address</label>
                <input type="email" name="store_email" required value="<?php echo e($settings['store_email']); ?>" class="w-full bg-slate-50 border border-slate-200 focus:border-<?php echo e($currentTheme['accent']); ?> focus:bg-white rounded-xl px-3.5 py-2.5 text-xs text-slate-800 focus:outline-none transition-all">
            </div>

            <div class="space-y-1.5">
                <label class="block text-[9px] font-bold text-slate-500 uppercase tracking-wider mb-1 px-0.5">Store Retail Address</label>
                <textarea name="store_address" required rows="3" class="w-full bg-slate-50 border border-slate-200 focus:border-<?php echo e($currentTheme['accent']); ?> focus:bg-white rounded-xl px-3.5 py-2.5 text-xs text-slate-800 focus:outline-none transition-all resize-none"><?php echo e($settings['store_address']); ?></textarea>
            </div>

        </div>

        <!-- Right: Payment UPI Profiles & Direct Bank details -->
        <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm flex flex-col justify-between gap-6">
            
            <div class="space-y-6">
                <h3 class="text-xs font-bold text-slate-700 uppercase tracking-widest border-b border-slate-200 pb-3 flex items-center gap-1.5"><i class="fa-solid fa-qrcode text-<?php echo e($currentTheme['accent']); ?>"></i> Payment Gateways & Banking</h3>
                
                <div class="space-y-1.5">
                    <label class="block text-[9px] font-bold text-slate-500 uppercase tracking-wider mb-1 px-0.5">Active UPI Payment ID (VPA)</label>
                    <input type="text" name="store_upi" required value="<?php echo e($settings['store_upi']); ?>" placeholder="username@bank" class="w-full bg-slate-50 border border-slate-200 focus:border-<?php echo e($currentTheme['accent']); ?> focus:bg-white rounded-xl px-3.5 py-2.5 text-xs text-slate-800 focus:outline-none transition-all font-mono">
                    <span class="text-[9px] text-slate-450 block leading-normal px-0.5 font-semibold"><i class="fa-solid fa-circle-info text-<?php echo e($currentTheme['accent']); ?>"></i> Used for generating the dynamic GPay/PhonePe scan-to-pay QR codes. Make sure this ID is correct.</span>
                </div>

                <div class="grid grid-cols-2 gap-4 border-t border-slate-200 pt-4">
                    <div class="space-y-1.5">
                        <label class="block text-[9px] font-bold text-slate-500 uppercase tracking-wider mb-1 px-0.5">Bank Name</label>
                        <input type="text" name="bank_name" required value="<?php echo e($settings['bank_name']); ?>" class="w-full bg-slate-50 border border-slate-200 focus:border-<?php echo e($currentTheme['accent']); ?> focus:bg-white rounded-xl px-3.5 py-2.5 text-xs text-slate-800 focus:outline-none transition-all">
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-[9px] font-bold text-slate-500 uppercase tracking-wider mb-1 px-0.5">Account Holder Name</label>
                        <input type="text" name="bank_holder" required value="<?php echo e($settings['bank_holder']); ?>" class="w-full bg-slate-50 border border-slate-200 focus:border-<?php echo e($currentTheme['accent']); ?> focus:bg-white rounded-xl px-3.5 py-2.5 text-xs text-slate-800 focus:outline-none transition-all">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="block text-[9px] font-bold text-slate-500 uppercase tracking-wider mb-1 px-0.5">Bank Account Number</label>
                        <input type="text" name="bank_acc_no" required value="<?php echo e($settings['bank_acc_no']); ?>" class="w-full bg-slate-50 border border-slate-200 focus:border-<?php echo e($currentTheme['accent']); ?> focus:bg-white rounded-xl px-3.5 py-2.5 text-xs text-slate-800 focus:outline-none transition-all font-mono">
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-[9px] font-bold text-slate-500 uppercase tracking-wider mb-1 px-0.5">Bank IFSC Code</label>
                        <input type="text" name="bank_ifsc" required value="<?php echo e($settings['bank_ifsc']); ?>" class="w-full bg-slate-50 border border-slate-200 focus:border-<?php echo e($currentTheme['accent']); ?> focus:bg-white rounded-xl px-3.5 py-2.5 text-xs text-slate-800 focus:outline-none transition-all font-mono font-bold">
                    </div>
                </div>
            </div>

            <!-- Submit action -->
            <div class="pt-6 lg:pt-0">
                <button type="submit" class="w-full bg-gradient-to-r from-<?php echo e($currentTheme['accent']); ?> to-<?php echo e($currentTheme['accent']); ?>/90 hover:opacity-95 text-white font-extrabold py-3.5 rounded-full text-xs uppercase tracking-wider shadow transform active:scale-95 transition-all flex items-center justify-center gap-1.5">
                    <i class="fa-solid fa-floppy-disk text-[11px]"></i>
                    <span>Save All Settings</span>
                </button>
            </div>

        </div>

    </form>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Athi\OneDrive\Desktop\crackers\resources\views/admin/settings.blade.php ENDPATH**/ ?>