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


<?php $__env->startSection('title', 'Site Branding Customization | Admin Console'); ?>

<?php $__env->startSection('content'); ?>
<!-- Load Quill Rich Text Editor Styles -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

<div x-data="{ activeTab: 'contact' }" class="space-y-8 select-none">
    
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-xl font-extrabold text-slate-900 tracking-tight">Site Branding Settings</h2>
            <p class="text-[10px] text-slate-500 uppercase tracking-widest leading-normal font-semibold mt-2">Customize social connections, promo codes, scroll banners, dynamic themes, policy documents, and brand imagery</p>
        </div>
    </div>

    <!-- Navigation Tabs -->
    <div class="flex gap-2 border-b border-slate-200 pb-px">
        <button @click="activeTab = 'contact'" 
            :class="activeTab === 'contact' ? '<?php echo e($currentTheme['active']); ?> shadow-sm' : 'bg-slate-100 hover:bg-slate-200 text-slate-600'" 
            class="px-4 py-2.5 rounded-xl text-xs font-extrabold transition-all duration-200 uppercase tracking-wider">
            <i class="fa-solid fa-file-invoice-dollar mr-1"></i> Contact & Payment Details
        </button>
        <button @click="activeTab = 'images'" 
            :class="activeTab === 'images' ? '<?php echo e($currentTheme['active']); ?> shadow-sm' : 'bg-slate-100 hover:bg-slate-200 text-slate-600'" 
            class="px-4 py-2.5 rounded-xl text-xs font-extrabold transition-all duration-200 uppercase tracking-wider">
            <i class="fa-solid fa-images mr-1"></i> Image Upload
        </button>
    </div>

    <!-- TAB 1: Contact & Payment Details -->
    <div x-show="activeTab === 'contact'" class="space-y-6">
        
        <form action="<?php echo e(route('admin.branding.update')); ?>" method="POST" id="branding-form" class="space-y-8 text-xs font-semibold">
            <?php echo csrf_field(); ?>
            
            <!-- Premium Unified Contact, Payment & Promo Details Card -->
            <div class="bg-white border border-slate-200 rounded-3xl p-6 md:p-8 shadow-sm space-y-7 select-none">
                
                <!-- Row 1: Address, Phone, Email -->
                <div class="grid grid-cols-1 lg:grid-cols-10 gap-4 mt-2">
                    <div class="relative lg:col-span-6">
                        <label class="absolute -top-2 left-3 bg-white px-1.5 text-[9px] text-slate-500 font-bold uppercase tracking-wider">Address<span class="text-crimson-600">*</span></label>
                        <input type="text" name="store_address" value="<?php echo e($settings['store_address']); ?>" required class="w-full bg-white border border-slate-300 rounded-lg px-3.5 py-3 text-xs text-slate-800 focus:border-<?php echo e($currentTheme['accent']); ?> focus:outline-none transition-all">
                    </div>
                    <div class="relative lg:col-span-2">
                        <label class="absolute -top-2 left-3 bg-white px-1.5 text-[9px] text-slate-500 font-bold uppercase tracking-wider">Phone Number<span class="text-crimson-600">*</span></label>
                        <input type="text" name="store_phone" value="<?php echo e($settings['store_phone']); ?>" required class="w-full bg-white border border-slate-300 rounded-lg px-3.5 py-3 text-xs text-slate-800 focus:border-<?php echo e($currentTheme['accent']); ?> focus:outline-none transition-all font-mono">
                    </div>
                    <div class="relative lg:col-span-2">
                        <label class="absolute -top-2 left-3 bg-white px-1.5 text-[9px] text-slate-500 font-bold uppercase tracking-wider">Email<span class="text-crimson-600">*</span></label>
                        <input type="email" name="store_email" value="<?php echo e($settings['store_email']); ?>" required class="w-full bg-white border border-slate-300 rounded-lg px-3.5 py-3 text-xs text-slate-800 focus:border-<?php echo e($currentTheme['accent']); ?> focus:outline-none transition-all">
                    </div>
                </div>

                <!-- Row 2: Instagram, WhatsApp, YouTube -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                    <div class="relative">
                        <label class="absolute -top-2 left-3 bg-white px-1.5 text-[9px] text-slate-500 font-bold uppercase tracking-wider">Instagram Link</label>
                        <input type="text" name="instagram_link" value="<?php echo e($settings['instagram_link']); ?>" class="w-full bg-white border border-slate-300 rounded-lg px-3.5 py-3 text-xs text-slate-800 focus:border-<?php echo e($currentTheme['accent']); ?> focus:outline-none transition-all">
                    </div>
                    <div class="relative">
                        <label class="absolute -top-2 left-3 bg-white px-1.5 text-[9px] text-slate-500 font-bold uppercase tracking-wider">Whatsapp Link</label>
                        <input type="text" name="whatsapp_link" value="<?php echo e($settings['whatsapp_link']); ?>" class="w-full bg-white border border-slate-300 rounded-lg px-3.5 py-3 text-xs text-slate-800 focus:border-<?php echo e($currentTheme['accent']); ?> focus:outline-none transition-all">
                    </div>
                    <div class="relative">
                        <label class="absolute -top-2 left-3 bg-white px-1.5 text-[9px] text-slate-500 font-bold uppercase tracking-wider">Youtube Link</label>
                        <input type="text" name="youtube_link" value="<?php echo e($settings['youtube_link']); ?>" class="w-full bg-white border border-slate-300 rounded-lg px-3.5 py-3 text-xs text-slate-800 focus:border-<?php echo e($currentTheme['accent']); ?> focus:outline-none transition-all">
                    </div>
                </div>

                <!-- Row 3: Twitter, Facebook, Bank Name -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                    <div class="relative">
                        <label class="absolute -top-2 left-3 bg-white px-1.5 text-[9px] text-slate-500 font-bold uppercase tracking-wider">Twitter Link</label>
                        <input type="text" name="twitter_link" value="<?php echo e($settings['twitter_link']); ?>" class="w-full bg-white border border-slate-300 rounded-lg px-3.5 py-3 text-xs text-slate-800 focus:border-<?php echo e($currentTheme['accent']); ?> focus:outline-none transition-all">
                    </div>
                    <div class="relative">
                        <label class="absolute -top-2 left-3 bg-white px-1.5 text-[9px] text-slate-500 font-bold uppercase tracking-wider">Facebook Link</label>
                        <input type="text" name="facebook_link" value="<?php echo e($settings['facebook_link']); ?>" class="w-full bg-white border border-slate-300 rounded-lg px-3.5 py-3 text-xs text-slate-800 focus:border-<?php echo e($currentTheme['accent']); ?> focus:outline-none transition-all">
                    </div>
                    <div class="relative">
                        <label class="absolute -top-2 left-3 bg-white px-1.5 text-[9px] text-slate-500 font-bold uppercase tracking-wider">Bank Name</label>
                        <input type="text" name="bank_name" value="<?php echo e($settings['bank_name']); ?>" class="w-full bg-white border border-slate-300 rounded-lg px-3.5 py-3 text-xs text-slate-800 focus:border-<?php echo e($currentTheme['accent']); ?> focus:outline-none transition-all">
                    </div>
                </div>

                <!-- Row 4: IFSC, Acc No, Branch -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                    <div class="relative">
                        <label class="absolute -top-2 left-3 bg-white px-1.5 text-[9px] text-slate-500 font-bold uppercase tracking-wider">IFSC Code</label>
                        <input type="text" name="bank_ifsc" value="<?php echo e($settings['bank_ifsc']); ?>" class="w-full bg-white border border-slate-300 rounded-lg px-3.5 py-3 text-xs text-slate-800 focus:border-<?php echo e($currentTheme['accent']); ?> focus:outline-none transition-all font-mono uppercase">
                    </div>
                    <div class="relative">
                        <label class="absolute -top-2 left-3 bg-white px-1.5 text-[9px] text-slate-500 font-bold uppercase tracking-wider">Account No.</label>
                        <input type="text" name="bank_acc_no" value="<?php echo e($settings['bank_acc_no']); ?>" class="w-full bg-white border border-slate-300 rounded-lg px-3.5 py-3 text-xs text-slate-800 focus:border-<?php echo e($currentTheme['accent']); ?> focus:outline-none transition-all font-mono">
                    </div>
                    <div class="relative">
                        <label class="absolute -top-2 left-3 bg-white px-1.5 text-[9px] text-slate-500 font-bold uppercase tracking-wider">Branch</label>
                        <input type="text" name="bank_branch" value="<?php echo e($settings['bank_branch']); ?>" class="w-full bg-white border border-slate-300 rounded-lg px-3.5 py-3 text-xs text-slate-800 focus:border-<?php echo e($currentTheme['accent']); ?> focus:outline-none transition-all">
                    </div>
                </div>

                <!-- Row 5: Account Type, Holder Name -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                    <div class="relative col-span-1">
                        <label class="absolute -top-2 left-3 bg-white px-1.5 text-[9px] text-slate-500 font-bold uppercase tracking-wider">Account Type</label>
                        <input type="text" name="bank_acc_type" value="<?php echo e($settings['bank_acc_type']); ?>" class="w-full bg-white border border-slate-300 rounded-lg px-3.5 py-3 text-xs text-slate-800 focus:border-<?php echo e($currentTheme['accent']); ?> focus:outline-none transition-all">
                    </div>
                    <div class="relative col-span-1 lg:col-span-2">
                        <label class="absolute -top-2 left-3 bg-white px-1.5 text-[9px] text-slate-500 font-bold uppercase tracking-wider">Holder Name</label>
                        <input type="text" name="bank_holder" value="<?php echo e($settings['bank_holder']); ?>" class="w-full bg-white border border-slate-300 rounded-lg px-3.5 py-3 text-xs text-slate-800 focus:border-<?php echo e($currentTheme['accent']); ?> focus:outline-none transition-all">
                    </div>
                </div>

                <!-- Active Promotion Codes -->
                <div class="space-y-4 pt-5 border-t border-slate-150">
                    <!-- Row 6: Promos 1 & 2 -->
                    <div class="grid grid-cols-1 lg:grid-cols-4 gap-4">
                        <div class="relative">
                            <label class="absolute -top-2 left-3 bg-white px-1.5 text-[9px] text-slate-550 font-bold uppercase tracking-wider">Promo Code Name 1</label>
                            <input type="text" name="promo_code_1" value="<?php echo e($settings['promo_code_1']); ?>" class="w-full bg-white border border-slate-300 rounded-lg px-3.5 py-3 text-xs text-slate-800 focus:border-<?php echo e($currentTheme['accent']); ?> focus:outline-none transition-all uppercase">
                        </div>
                        <div class="relative">
                            <label class="absolute -top-2 left-3 bg-white px-1.5 text-[9px] text-slate-550 font-bold uppercase tracking-wider">Promo Value 1</label>
                            <input type="text" name="promo_value_1" value="<?php echo e($settings['promo_value_1']); ?>" class="w-full bg-white border border-slate-300 rounded-lg px-3.5 py-3 text-xs text-slate-800 focus:border-<?php echo e($currentTheme['accent']); ?> focus:outline-none transition-all">
                        </div>
                        <div class="relative">
                            <label class="absolute -top-2 left-3 bg-white px-1.5 text-[9px] text-slate-550 font-bold uppercase tracking-wider">Promo Code Name 2</label>
                            <input type="text" name="promo_code_2" value="<?php echo e($settings['promo_code_2']); ?>" class="w-full bg-white border border-slate-300 rounded-lg px-3.5 py-3 text-xs text-slate-800 focus:border-<?php echo e($currentTheme['accent']); ?> focus:outline-none transition-all uppercase">
                        </div>
                        <div class="relative">
                            <label class="absolute -top-2 left-3 bg-white px-1.5 text-[9px] text-slate-550 font-bold uppercase tracking-wider">Promo Value 2</label>
                            <input type="text" name="promo_value_2" value="<?php echo e($settings['promo_value_2']); ?>" class="w-full bg-white border border-slate-300 rounded-lg px-3.5 py-3 text-xs text-slate-800 focus:border-<?php echo e($currentTheme['accent']); ?> focus:outline-none transition-all">
                        </div>
                    </div>
                    
                    <!-- Row 7: Promos 3 & 4 -->
                    <div class="grid grid-cols-1 lg:grid-cols-4 gap-4">
                        <div class="relative">
                            <label class="absolute -top-2 left-3 bg-white px-1.5 text-[9px] text-slate-555 font-bold uppercase tracking-wider">Promo Code Name 3</label>
                            <input type="text" name="promo_code_3" value="<?php echo e($settings['promo_code_3']); ?>" class="w-full bg-white border border-slate-300 rounded-lg px-3.5 py-3 text-xs text-slate-800 focus:border-<?php echo e($currentTheme['accent']); ?> focus:outline-none transition-all uppercase">
                        </div>
                        <div class="relative">
                            <label class="absolute -top-2 left-3 bg-white px-1.5 text-[9px] text-slate-555 font-bold uppercase tracking-wider">Promo Value 3</label>
                            <input type="text" name="promo_value_3" value="<?php echo e($settings['promo_value_3']); ?>" class="w-full bg-white border border-slate-300 rounded-lg px-3.5 py-3 text-xs text-slate-800 focus:border-<?php echo e($currentTheme['accent']); ?> focus:outline-none transition-all">
                        </div>
                        <div class="relative">
                            <label class="absolute -top-2 left-3 bg-white px-1.5 text-[9px] text-slate-555 font-bold uppercase tracking-wider">Promo Code Name 4</label>
                            <input type="text" name="promo_code_4" value="<?php echo e($settings['promo_code_4']); ?>" class="w-full bg-white border border-slate-300 rounded-lg px-3.5 py-3 text-xs text-slate-800 focus:border-<?php echo e($currentTheme['accent']); ?> focus:outline-none transition-all uppercase">
                        </div>
                        <div class="relative">
                            <label class="absolute -top-2 left-3 bg-white px-1.5 text-[9px] text-slate-555 font-bold uppercase tracking-wider">Promo Value 4</label>
                            <input type="text" name="promo_value_4" value="<?php echo e($settings['promo_value_4']); ?>" class="w-full bg-white border border-slate-300 rounded-lg px-3.5 py-3 text-xs text-slate-800 focus:border-<?php echo e($currentTheme['accent']); ?> focus:outline-none transition-all">
                        </div>
                    </div>

                    <!-- Row 8: Promo 5 -->
                    <div class="grid grid-cols-1 lg:grid-cols-4 gap-4">
                        <div class="relative">
                            <label class="absolute -top-2 left-3 bg-white px-1.5 text-[9px] text-slate-555 font-bold uppercase tracking-wider">Promo Code Name 5</label>
                            <input type="text" name="promo_code_5" value="<?php echo e($settings['promo_code_5']); ?>" class="w-full bg-white border border-slate-300 rounded-lg px-3.5 py-3 text-xs text-slate-800 focus:border-<?php echo e($currentTheme['accent']); ?> focus:outline-none transition-all uppercase">
                        </div>
                        <div class="relative">
                            <label class="absolute -top-2 left-3 bg-white px-1.5 text-[9px] text-slate-555 font-bold uppercase tracking-wider">Promo Value 5</label>
                            <input type="text" name="promo_value_5" value="<?php echo e($settings['promo_value_5']); ?>" class="w-full bg-white border border-slate-300 rounded-lg px-3.5 py-3 text-xs text-slate-800 focus:border-<?php echo e($currentTheme['accent']); ?> focus:outline-none transition-all">
                        </div>
                        <!-- Spacer columns -->
                        <div class="hidden lg:block lg:col-span-2"></div>
                    </div>
                </div>
            </div>

            <!-- Custom Controls (Theme & Banner Scroller) -->
            <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm space-y-6">
                <h3 class="text-xs font-bold text-slate-700 uppercase tracking-widest border-b border-slate-200 pb-3 flex items-center gap-1.5">
                    <i class="fa-solid fa-palette text-<?php echo e($currentTheme['accent']); ?>"></i> Console Skin & Announce Scrollers
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="space-y-1.5">
                        <label class="block text-[9px] font-bold text-slate-500 uppercase tracking-wider mb-1 px-0.5">Admin Theme</label>
                        <select name="admin_theme" class="w-full bg-slate-50 border border-slate-200 focus:border-<?php echo e($currentTheme['accent']); ?> focus:bg-white rounded-xl px-3.5 py-2.5 text-slate-700 focus:outline-none transition-all">
                            <option value="gold" <?php echo e($settings['admin_theme'] === 'gold' ? 'selected' : ''); ?>>Gold</option>
                            <option value="blue" <?php echo e($settings['admin_theme'] === 'blue' ? 'selected' : ''); ?>>Blue</option>
                            <option value="crimson" <?php echo e($settings['admin_theme'] === 'crimson' ? 'selected' : ''); ?>>Crimson</option>
                            <option value="emerald" <?php echo e($settings['admin_theme'] === 'emerald' ? 'selected' : ''); ?>>Emerald</option>
                        </select>
                    </div>
                    <div class="space-y-1.5 md:col-span-2">
                        <label class="block text-[9px] font-bold text-slate-500 uppercase tracking-wider mb-1 px-0.5">Banner Scroller</label>
                        <input type="text" name="banner_scroller" value="<?php echo e($settings['banner_scroller']); ?>" placeholder="Hurry, stock is running out!" class="w-full bg-slate-50 border border-slate-200 focus:border-<?php echo e($currentTheme['accent']); ?> focus:bg-white rounded-xl px-3.5 py-2.5 text-slate-700 focus:outline-none transition-all">
                    </div>
                </div>
            </div>

            <!-- Rich Text Terms & Conditions -->
            <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm space-y-3">
                <h3 class="text-xs font-bold text-slate-700 uppercase tracking-widest border-b border-slate-200 pb-3 flex items-center gap-1.5">
                    <i class="fa-solid fa-scale-balanced text-<?php echo e($currentTheme['accent']); ?>"></i> Terms & Conditions Settings
                </h3>
                
                <label class="block text-[9px] font-bold text-slate-500 uppercase tracking-wider mb-1 px-0.5">Add Terms and Conditions</label>
                <!-- Editor Container -->
                <div class="rounded-xl overflow-hidden border border-slate-200">
                    <div id="terms-editor" class="h-64 bg-slate-50/20 text-xs font-semibold">
                        <?php echo $settings['terms_conditions']; ?>

                    </div>
                </div>
                <input type="hidden" name="terms_conditions" id="terms-input">
            </div>

            <!-- Rich Text About Us -->
            <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm space-y-3">
                <h3 class="text-xs font-bold text-slate-700 uppercase tracking-widest border-b border-slate-200 pb-3 flex items-center gap-1.5">
                    <i class="fa-solid fa-user-tie text-<?php echo e($currentTheme['accent']); ?>"></i> About Us Settings
                </h3>
                
                <label class="block text-[9px] font-bold text-slate-500 uppercase tracking-wider mb-1 px-0.5">Add About Us</label>
                <!-- Editor Container -->
                <div class="rounded-xl overflow-hidden border border-slate-200">
                    <div id="about-editor" class="h-64 bg-slate-50/20 text-xs font-semibold">
                        <?php echo $settings['about_us']; ?>

                    </div>
                </div>
                <input type="hidden" name="about_us" id="about-input">
            </div>

            <!-- Save Form Button -->
            <div class="flex justify-end pt-4">
                <button type="submit" class="bg-gradient-to-r from-<?php echo e($currentTheme['accent']); ?> to-<?php echo e($currentTheme['accent']); ?>/85 hover:opacity-90 text-white font-extrabold px-8 py-3.5 rounded-full text-xs uppercase tracking-wider shadow transform active:scale-95 transition-all flex items-center gap-1.5">
                    <i class="fa-solid fa-cloud-arrow-up text-sm"></i>
                    <span>Save All Parameters</span>
                </button>
            </div>

        </form>
        
    </div>

    <!-- TAB 2: Image Upload -->
    <div x-show="activeTab === 'images'" class="space-y-8" style="display: none;">
        
        <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm space-y-6">
            <div class="bg-slate-50 border border-slate-200 text-slate-500 p-4 rounded-xl text-[10px] uppercase font-bold flex gap-2 items-center">
                <i class="fa-solid fa-circle-exclamation text-amber-500 text-xs"></i>
                <div>
                    <span>Upload Requirements:</span> Images must be in <strong>png, jpg, jpeg, webp</strong> format, with a maximum size of <strong>3MB</strong>.
                </div>
            </div>
        </div>

        <?php
            $assetSections = [
                'slider' => [
                    'title' => 'Home Slider Images',
                    'icon' => 'fa-images',
                    'prefix' => 'slider_image_',
                ],
                'banner' => [
                    'title' => 'Banner Images',
                    'icon' => 'fa-scroll',
                    'prefix' => 'banner_image_',
                ],
                'about' => [
                    'title' => 'About Us Images',
                    'icon' => 'fa-address-card',
                    'prefix' => 'aboutus_image_',
                ],
                'offer' => [
                    'title' => 'Offer Images',
                    'icon' => 'fa-tags',
                    'prefix' => 'offer_image_',
                ]
            ];
        ?>

        <?php $__currentLoopData = $assetSections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sectionKey => $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm space-y-6">
            <h3 class="text-xs font-bold text-slate-700 uppercase tracking-widest border-b border-slate-200 pb-3 flex items-center gap-1.5">
                <i class="fa-solid <?php echo e($section['icon']); ?> text-<?php echo e($currentTheme['accent']); ?>"></i> Add <?php echo e($section['title']); ?>

            </h3>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-xs font-semibold">
                <?php for($slot = 1; $slot <= 3; $slot++): ?>
                <?php
                    $field = $section['prefix'] . $slot;
                    $path = $settings[$field];
                ?>
                
                <form action="<?php echo e(route('admin.branding.update')); ?>" method="POST" enctype="multipart/form-data" class="space-y-4 border border-slate-150 p-4 rounded-2xl bg-slate-50/50 flex flex-col justify-between">
                    <?php echo csrf_field(); ?>
                    
                    <div class="space-y-3">
                        <span class="text-[9px] uppercase tracking-wider font-extrabold text-slate-400 block border-b border-slate-200 pb-1.5">
                            Image Slot #0<?php echo e($slot); ?>

                        </span>
                        
                        <!-- Image Preview Slot -->
                        <div class="w-full aspect-video rounded-xl bg-white border border-slate-200 overflow-hidden flex items-center justify-center text-slate-350 shadow-inner relative group">
                            <?php if($path && file_exists(public_path($path))): ?>
                                <img src="/<?php echo e($path); ?>" alt="<?php echo e($section['title']); ?> Slot <?php echo e($slot); ?>" class="object-cover w-full h-full">
                                <div class="absolute inset-0 bg-slate-900/60 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-[10px] text-white font-extrabold uppercase tracking-widest">
                                    Slot <?php echo e($slot); ?>

                                </div>
                            <?php else: ?>
                                <div class="text-center p-4">
                                    <i class="fa-solid fa-mountain-sun text-lg text-slate-300 block mb-1"></i>
                                    <span class="text-[8px] uppercase tracking-wider text-slate-400">No Image Uploaded</span>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Choose file control -->
                        <div class="space-y-1">
                            <label class="text-[8px] font-bold text-slate-500 uppercase tracking-wider block px-0.5">Select image file</label>
                            <input type="file" name="<?php echo e($field); ?>" required class="w-full bg-white border border-slate-200 focus:border-<?php echo e($currentTheme['accent']); ?> rounded-xl px-2.5 py-1.5 text-[10px] text-slate-500 focus:outline-none transition-all">
                        </div>
                    </div>

                    <!-- Action Save per slot -->
                    <button type="submit" class="w-full bg-slate-50 hover:bg-<?php echo e($currentTheme['accent']); ?> border border-slate-200 hover:border-<?php echo e($currentTheme['accent']); ?> hover:text-white text-slate-700 font-extrabold py-2.5 rounded-xl text-[10px] uppercase tracking-wider shadow-sm transform active:scale-95 transition-all flex items-center justify-center gap-1">
                        <i class="fa-solid fa-floppy-disk text-[9px]"></i> Save Slot
                    </button>
                </form>
                <?php endfor; ?>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </div>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<!-- Load Quill Editor Libraries -->
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // 1. Initialize Terms editor
        var termsQuill = new Quill('#terms-editor', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{ 'font': [] }],
                    ['bold', 'italic', 'underline'],
                    [{ 'color': [] }, { 'background': [] }],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    [{ 'align': [] }],
                    ['clean']
                ]
            }
        });

        // 2. Initialize About editor
        var aboutQuill = new Quill('#about-editor', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{ 'font': [] }],
                    ['bold', 'italic', 'underline'],
                    [{ 'color': [] }, { 'background': [] }],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    [{ 'align': [] }],
                    ['clean']
                ]
            }
        });

        // 3. Sync Quill rich text content with hidden inputs upon submission
        var form = document.getElementById("branding-form");
        if (form) {
            form.addEventListener("submit", function(e) {
                var termsHTML = document.querySelector('#terms-editor .ql-editor').innerHTML;
                var aboutHTML = document.querySelector('#about-editor .ql-editor').innerHTML;
                
                // If it is just empty paragraph, don't store raw empty quill tags
                if (termsHTML === '<p><br></p>') termsHTML = '';
                if (aboutHTML === '<p><br></p>') aboutHTML = '';

                document.getElementById('terms-input').value = termsHTML;
                document.getElementById('about-input').value = aboutHTML;
            });
        }
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Athi\OneDrive\Desktop\crackers\resources\views/admin/branding.blade.php ENDPATH**/ ?>