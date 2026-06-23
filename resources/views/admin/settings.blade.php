@php
    $activeTheme = $currentCompany?->theme ?? 'Theme_1';
    
    $isLightTheme = in_array(strtolower($activeTheme), ['theme_1']);
    
    if ($isLightTheme) {
        $currentTheme = [
            'active' => 'bg-gold-500 text-slate-950',
            'accent' => 'gold-500'
        ];
    } else {
        $currentTheme = [
            'active' => 'bg-crimson-600 text-white shadow-md shadow-crimson-500/20',
            'accent' => 'crimson-600'
        ];
    }
@endphp
@extends('layouts.admin')

@section('title', 'Store Settings | Admin Console')

@section('content')
<div class="space-y-8 select-none text-xs font-semibold">
    
    <!-- Header -->
    <div>
        <h2 class="text-xl font-extrabold text-slate-900 tracking-tight">Store Configurations Console</h2>
        <p class="text-[10px] text-slate-500 uppercase tracking-widest leading-normal font-semibold font-sans mt-2">Modify client-side booking values, payment profiles, and support details</p>
    </div>

    <!-- Error blocks -->
    @if(isset($errors) && $errors->any())
    <div class="bg-crimson-50 border border-crimson-200 text-crimson-700 p-4 rounded-2xl text-xs space-y-1 shadow-sm font-semibold">
        <strong class="block font-bold"><i class="fa-solid fa-circle-exclamation mr-1 text-crimson-600"></i> Please correct the following errors:</strong>
        <ul class="list-disc pl-4 space-y-0.5">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Main Config Form -->
    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-2 gap-8 text-xs font-semibold">
        @csrf
        
        <!-- Left: General Configurations & Support -->
        <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm space-y-6">
            <h3 class="text-xs font-bold text-slate-700 uppercase tracking-widest border-b border-slate-200 pb-3 flex items-center gap-1.5"><i class="fa-solid fa-gears text-{{ $currentTheme['accent'] }}"></i> General Configuration</h3>
            
            <div class="space-y-1.5">
                <label class="block text-[9px] font-bold text-slate-500 uppercase tracking-wider mb-1 px-0.5">Website / Store Name</label>
                <input type="text" name="store_name" required value="{{ $settings['store_name'] }}" class="w-full bg-slate-50 border border-slate-200 focus:border-{{ $currentTheme['accent'] }} focus:bg-white rounded-xl px-3.5 py-2.5 text-xs text-slate-800 focus:outline-none transition-all">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label class="block text-[9px] font-bold text-slate-500 uppercase tracking-wider mb-1 px-0.5">Minimum Order Amount (₹)</label>
                    <input type="number" name="min_order_value" required value="{{ $settings['min_order_value'] }}" class="w-full bg-slate-50 border border-slate-200 focus:border-{{ $currentTheme['accent'] }} focus:bg-white rounded-xl px-3.5 py-2.5 text-xs text-slate-800 focus:outline-none transition-all">
                </div>
                <div class="space-y-1.5">
                    <label class="block text-[9px] font-bold text-slate-500 uppercase tracking-wider mb-1 px-0.5">Global Discount Rate (%)</label>
                    <input type="number" min="0" max="100" name="discount_percent" required value="{{ $settings['discount_percent'] }}" class="w-full bg-slate-50 border border-slate-200 focus:border-{{ $currentTheme['accent'] }} focus:bg-white rounded-xl px-3.5 py-2.5 text-xs text-slate-800 focus:outline-none transition-all font-mono">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 border-t border-slate-200 pt-4">
                <div class="space-y-1.5">
                    <label class="block text-[9px] font-bold text-slate-500 uppercase tracking-wider mb-1 px-0.5">WhatsApp Booking Mobile</label>
                    <input type="text" name="store_whatsapp" required value="{{ $settings['store_whatsapp'] }}" placeholder="91..." class="w-full bg-slate-50 border border-slate-200 focus:border-{{ $currentTheme['accent'] }} focus:bg-white rounded-xl px-3.5 py-2.5 text-xs text-slate-800 focus:outline-none transition-all font-mono">
                </div>
                <div class="space-y-1.5">
                    <label class="block text-[9px] font-bold text-slate-500 uppercase tracking-wider mb-1 px-0.5">Support Call Phone</label>
                    <input type="text" name="store_phone" required value="{{ $settings['store_phone'] }}" class="w-full bg-slate-50 border border-slate-200 focus:border-{{ $currentTheme['accent'] }} focus:bg-white rounded-xl px-3.5 py-2.5 text-xs text-slate-800 focus:outline-none transition-all font-mono">
                </div>
            </div>

            <div class="space-y-1.5">
                <label class="block text-[9px] font-bold text-slate-500 uppercase tracking-wider mb-1 px-0.5">Support Email Address</label>
                <input type="email" name="store_email" required value="{{ $settings['store_email'] }}" class="w-full bg-slate-50 border border-slate-200 focus:border-{{ $currentTheme['accent'] }} focus:bg-white rounded-xl px-3.5 py-2.5 text-xs text-slate-800 focus:outline-none transition-all">
            </div>

            <div class="space-y-1.5">
                <label class="block text-[9px] font-bold text-slate-500 uppercase tracking-wider mb-1 px-0.5">Store Retail Address</label>
                <textarea name="store_address" required rows="3" class="w-full bg-slate-50 border border-slate-200 focus:border-{{ $currentTheme['accent'] }} focus:bg-white rounded-xl px-3.5 py-2.5 text-xs text-slate-800 focus:outline-none transition-all resize-none">{{ $settings['store_address'] }}</textarea>
            </div>

            <!-- Cart & Feature Toggles -->
            <div class="border-t border-slate-200 pt-5 space-y-4">
                <h4 class="text-xs font-bold text-slate-700 uppercase tracking-wider flex items-center gap-1.5">
                    <i class="fa-solid fa-toggle-on text-{{ $currentTheme['accent'] }}"></i> Cart & Checkout Features
                </h4>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="block text-[9px] font-bold text-slate-500 uppercase tracking-wider mb-1 px-0.5">Enforce Min Order Value</label>
                        <select name="enable_min_order" class="w-full bg-slate-50 border border-slate-200 focus:border-{{ $currentTheme['accent'] }} focus:bg-white rounded-xl px-3.5 py-2.5 text-xs text-slate-800 focus:outline-none transition-all">
                            <option value="yes" {{ ($settings['enable_min_order'] ?? 'yes') === 'yes' ? 'selected' : '' }}>Yes (Enforced)</option>
                            <option value="no" {{ ($settings['enable_min_order'] ?? 'yes') === 'no' ? 'selected' : '' }}>No (Disabled)</option>
                        </select>
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-[9px] font-bold text-slate-500 uppercase tracking-wider mb-1 px-0.5">Enable Promo Code Input</label>
                        <select name="enable_promo_codes" class="w-full bg-slate-50 border border-slate-200 focus:border-{{ $currentTheme['accent'] }} focus:bg-white rounded-xl px-3.5 py-2.5 text-xs text-slate-800 focus:outline-none transition-all">
                            <option value="yes" {{ ($settings['enable_promo_codes'] ?? 'yes') === 'yes' ? 'selected' : '' }}>Yes (Show Coupons)</option>
                            <option value="no" {{ ($settings['enable_promo_codes'] ?? 'yes') === 'no' ? 'selected' : '' }}>No (Hide Coupons)</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="space-y-1.5">
                        <label class="block text-[9px] font-bold text-slate-500 uppercase tracking-wider mb-1 px-0.5">Enable Tax & Delivery</label>
                        <select name="enable_tax_delivery" class="w-full bg-slate-50 border border-slate-200 focus:border-{{ $currentTheme['accent'] }} focus:bg-white rounded-xl px-3.5 py-2.5 text-xs text-slate-800 focus:outline-none transition-all">
                            <option value="yes" {{ ($settings['enable_tax_delivery'] ?? 'no') === 'yes' ? 'selected' : '' }}>Yes (Calculate)</option>
                            <option value="no" {{ ($settings['enable_tax_delivery'] ?? 'no') === 'no' ? 'selected' : '' }}>No (Free / Exclude)</option>
                        </select>
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-[9px] font-bold text-slate-500 uppercase tracking-wider mb-1 px-0.5">GST Rate (%)</label>
                        <input type="number" min="0" max="100" name="tax_percent" value="{{ $settings['tax_percent'] ?? 18 }}" class="w-full bg-slate-50 border border-slate-200 focus:border-{{ $currentTheme['accent'] }} focus:bg-white rounded-xl px-3.5 py-2.5 text-xs text-slate-800 focus:outline-none transition-all font-mono">
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-[9px] font-bold text-slate-500 uppercase tracking-wider mb-1 px-0.5">Delivery Fee (₹)</label>
                        <input type="number" min="0" name="delivery_charge" value="{{ $settings['delivery_charge'] ?? 150 }}" class="w-full bg-slate-50 border border-slate-200 focus:border-{{ $currentTheme['accent'] }} focus:bg-white rounded-xl px-3.5 py-2.5 text-xs text-slate-800 focus:outline-none transition-all font-mono">
                    </div>
                </div>
            </div>

        </div>

        <!-- Right: Payment UPI Profiles & Direct Bank details -->
        <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm flex flex-col justify-between gap-6">
            
            <div class="space-y-6">
                <h3 class="text-xs font-bold text-slate-700 uppercase tracking-widest border-b border-slate-200 pb-3 flex items-center gap-1.5"><i class="fa-solid fa-qrcode text-{{ $currentTheme['accent'] }}"></i> Payment Gateways & Banking</h3>
                
                <div class="space-y-1.5">
                    <label class="block text-[9px] font-bold text-slate-500 uppercase tracking-wider mb-1 px-0.5">Active UPI Payment ID (VPA)</label>
                    <input type="text" name="store_upi" required value="{{ $settings['store_upi'] }}" placeholder="username@bank" class="w-full bg-slate-50 border border-slate-200 focus:border-{{ $currentTheme['accent'] }} focus:bg-white rounded-xl px-3.5 py-2.5 text-xs text-slate-800 focus:outline-none transition-all font-mono">
                    <span class="text-[9px] text-slate-450 block leading-normal px-0.5 font-semibold"><i class="fa-solid fa-circle-info text-{{ $currentTheme['accent'] }}"></i> Used for generating the dynamic GPay/PhonePe scan-to-pay QR codes. Make sure this ID is correct.</span>
                </div>

                <div class="space-y-1.5 border-t border-slate-200 pt-4">
                    <label class="block text-[9px] font-bold text-slate-500 uppercase tracking-wider mb-1 px-0.5">UPI QR Code Image (Custom Upload)</label>
                    <div class="flex items-center gap-4">
                        @if(!empty($settings['store_upi_qr']))
                            <div class="w-16 h-16 rounded-xl bg-slate-50 border border-slate-200 overflow-hidden flex items-center justify-center text-slate-300 flex-shrink-0 shadow-sm relative group">
                                <img src="/{{ $settings['store_upi_qr'] }}" class="object-cover w-full h-full">
                            </div>
                        @endif
                        <input type="file" name="store_upi_qr" class="w-full bg-slate-50 border border-slate-200 focus:border-{{ $currentTheme['accent'] }} focus:bg-white rounded-xl px-3.5 py-2 text-xs text-slate-800 focus:outline-none transition-all">
                    </div>
                    <span class="text-[9px] text-slate-450 block leading-normal px-0.5 font-semibold"><i class="fa-solid fa-circle-info text-{{ $currentTheme['accent'] }}"></i> Upload your custom static QR code image to replace the Google Charts auto-generated UPI QR code.</span>
                </div>

                <div class="grid grid-cols-2 gap-4 border-t border-slate-200 pt-4">
                    <div class="space-y-1.5">
                        <label class="block text-[9px] font-bold text-slate-500 uppercase tracking-wider mb-1 px-0.5">Bank Name</label>
                        <input type="text" name="bank_name" required value="{{ $settings['bank_name'] }}" class="w-full bg-slate-50 border border-slate-200 focus:border-{{ $currentTheme['accent'] }} focus:bg-white rounded-xl px-3.5 py-2.5 text-xs text-slate-800 focus:outline-none transition-all">
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-[9px] font-bold text-slate-500 uppercase tracking-wider mb-1 px-0.5">Account Holder Name</label>
                        <input type="text" name="bank_holder" required value="{{ $settings['bank_holder'] }}" class="w-full bg-slate-50 border border-slate-200 focus:border-{{ $currentTheme['accent'] }} focus:bg-white rounded-xl px-3.5 py-2.5 text-xs text-slate-800 focus:outline-none transition-all">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="block text-[9px] font-bold text-slate-500 uppercase tracking-wider mb-1 px-0.5">Bank Account Number</label>
                        <input type="text" name="bank_acc_no" required value="{{ $settings['bank_acc_no'] }}" class="w-full bg-slate-50 border border-slate-200 focus:border-{{ $currentTheme['accent'] }} focus:bg-white rounded-xl px-3.5 py-2.5 text-xs text-slate-800 focus:outline-none transition-all font-mono">
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-[9px] font-bold text-slate-500 uppercase tracking-wider mb-1 px-0.5">Bank IFSC Code</label>
                        <input type="text" name="bank_ifsc" required value="{{ $settings['bank_ifsc'] }}" class="w-full bg-slate-50 border border-slate-200 focus:border-{{ $currentTheme['accent'] }} focus:bg-white rounded-xl px-3.5 py-2.5 text-xs text-slate-800 focus:outline-none transition-all font-mono font-bold">
                    </div>
                </div>
            </div>

            <!-- Submit action -->
            <div class="pt-6 lg:pt-0">
                <button type="submit" class="w-full bg-gradient-to-r from-{{ $currentTheme['accent'] }} to-{{ $currentTheme['accent'] }}/90 hover:opacity-95 text-white font-extrabold py-3.5 rounded-full text-xs uppercase tracking-wider shadow transform active:scale-95 transition-all flex items-center justify-center gap-1.5">
                    <i class="fa-solid fa-floppy-disk text-[11px]"></i>
                    <span>Save All Settings</span>
                </button>
            </div>

        </div>

    </form>

</div>
@endsection
