@extends('layouts.admin')

@section('title', 'Store Settings | Admin Console')

@section('content')
<div class="space-y-8 select-none">
    
    <!-- Header -->
    <div>
        <h2 class="text-xl font-extrabold text-slate-900 tracking-tight">Store Configurations Console</h2>
        <p class="text-[10px] text-slate-500 uppercase tracking-widest leading-none font-semibold">Modify client-side booking values, payment profiles, and support details</p>
    </div>

    <!-- Error blocks -->
    @if($errors->any())
    <div class="bg-crimson-50 border border-crimson-200 text-crimson-700 p-4 rounded-2xl text-xs space-y-1 shadow-sm">
        <strong class="block font-bold"><i class="fa-solid fa-circle-exclamation mr-1 text-crimson-600"></i> Please correct the following errors:</strong>
        <ul class="list-disc pl-4 space-y-0.5">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Main Config Form -->
    <form action="{{ route('admin.settings.update') }}" method="POST" class="grid grid-cols-1 lg:grid-cols-2 gap-8 text-xs">
        @csrf
        
        <!-- Left: General Configurations & Support -->
        <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm space-y-6">
            <h3 class="text-xs font-bold text-slate-700 uppercase tracking-widest border-b border-slate-200 pb-3 flex items-center gap-1.5"><i class="fa-solid fa-gears text-gold-500"></i> General Configuration</h3>
            
            <div class="space-y-1.5">
                <label class="block text-[9px] font-bold text-slate-500 uppercase tracking-wider mb-1 px-0.5">Website / Store Name</label>
                <input type="text" name="store_name" required value="{{ $settings['store_name'] }}" class="w-full bg-slate-50 border border-slate-200 focus:border-gold-500 focus:bg-white rounded-xl px-3.5 py-2.5 text-xs text-slate-800 focus:outline-none transition-all">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label class="block text-[9px] font-bold text-slate-500 uppercase tracking-wider mb-1 px-0.5">Minimum Order Amount (₹)</label>
                    <input type="number" name="min_order_value" required value="{{ $settings['min_order_value'] }}" class="w-full bg-slate-50 border border-slate-200 focus:border-gold-500 focus:bg-white rounded-xl px-3.5 py-2.5 text-xs text-slate-800 focus:outline-none transition-all">
                </div>
                <div class="space-y-1.5">
                    <label class="block text-[9px] font-bold text-slate-500 uppercase tracking-wider mb-1 px-0.5">Global Discount Rate (%)</label>
                    <input type="number" min="0" max="100" name="discount_percent" required value="{{ $settings['discount_percent'] }}" class="w-full bg-slate-50 border border-slate-200 focus:border-gold-500 focus:bg-white rounded-xl px-3.5 py-2.5 text-xs text-slate-800 focus:outline-none transition-all">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 border-t border-slate-200 pt-4">
                <div class="space-y-1.5">
                    <label class="block text-[9px] font-bold text-slate-500 uppercase tracking-wider mb-1 px-0.5">WhatsApp Booking Mobile</label>
                    <input type="text" name="store_whatsapp" required value="{{ $settings['store_whatsapp'] }}" placeholder="91..." class="w-full bg-slate-50 border border-slate-200 focus:border-gold-500 focus:bg-white rounded-xl px-3.5 py-2.5 text-xs text-slate-800 focus:outline-none transition-all font-mono">
                </div>
                <div class="space-y-1.5">
                    <label class="block text-[9px] font-bold text-slate-500 uppercase tracking-wider mb-1 px-0.5">Support Call Phone</label>
                    <input type="text" name="store_phone" required value="{{ $settings['store_phone'] }}" class="w-full bg-slate-50 border border-slate-200 focus:border-gold-500 focus:bg-white rounded-xl px-3.5 py-2.5 text-xs text-slate-800 focus:outline-none transition-all font-mono">
                </div>
            </div>

            <div class="space-y-1.5">
                <label class="block text-[9px] font-bold text-slate-500 uppercase tracking-wider mb-1 px-0.5">Support Email Address</label>
                <input type="email" name="store_email" required value="{{ $settings['store_email'] }}" class="w-full bg-slate-50 border border-slate-200 focus:border-gold-500 focus:bg-white rounded-xl px-3.5 py-2.5 text-xs text-slate-800 focus:outline-none transition-all">
            </div>

            <div class="space-y-1.5">
                <label class="block text-[9px] font-bold text-slate-500 uppercase tracking-wider mb-1 px-0.5">Store Retail Address</label>
                <textarea name="store_address" required rows="3" class="w-full bg-slate-50 border border-slate-200 focus:border-gold-500 focus:bg-white rounded-xl px-3.5 py-2.5 text-xs text-slate-800 focus:outline-none transition-all resize-none">{{ $settings['store_address'] }}</textarea>
            </div>

        </div>

        <!-- Right: Payment UPI Profiles & Direct Bank details -->
        <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm flex flex-col justify-between gap-6">
            
            <div class="space-y-6">
                <h3 class="text-xs font-bold text-slate-700 uppercase tracking-widest border-b border-slate-200 pb-3 flex items-center gap-1.5"><i class="fa-solid fa-qrcode text-gold-500"></i> Payment Gateways & Banking</h3>
                
                <div class="space-y-1.5">
                    <label class="block text-[9px] font-bold text-slate-500 uppercase tracking-wider mb-1 px-0.5">Active UPI Payment ID (VPA)</label>
                    <input type="text" name="store_upi" required value="{{ $settings['store_upi'] }}" placeholder="username@bank" class="w-full bg-slate-50 border border-slate-200 focus:border-gold-500 focus:bg-white rounded-xl px-3.5 py-2.5 text-xs text-slate-800 focus:outline-none transition-all font-mono">
                    <span class="text-[9px] text-slate-450 block leading-normal px-0.5"><i class="fa-solid fa-circle-info text-gold-500"></i> Used for generating the dynamic GPay/PhonePe scan-to-pay QR codes. Make sure this ID is correct.</span>
                </div>

                <div class="grid grid-cols-2 gap-4 border-t border-slate-200 pt-4">
                    <div class="space-y-1.5">
                        <label class="block text-[9px] font-bold text-slate-500 uppercase tracking-wider mb-1 px-0.5">Bank Name</label>
                        <input type="text" name="bank_name" required value="{{ $settings['bank_name'] }}" class="w-full bg-slate-50 border border-slate-200 focus:border-gold-500 focus:bg-white rounded-xl px-3.5 py-2.5 text-xs text-slate-800 focus:outline-none transition-all">
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-[9px] font-bold text-slate-500 uppercase tracking-wider mb-1 px-0.5">Account Holder Name</label>
                        <input type="text" name="bank_holder" required value="{{ $settings['bank_holder'] }}" class="w-full bg-slate-50 border border-slate-200 focus:border-gold-500 focus:bg-white rounded-xl px-3.5 py-2.5 text-xs text-slate-800 focus:outline-none transition-all">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="block text-[9px] font-bold text-slate-500 uppercase tracking-wider mb-1 px-0.5">Bank Account Number</label>
                        <input type="text" name="bank_acc_no" required value="{{ $settings['bank_acc_no'] }}" class="w-full bg-slate-50 border border-slate-200 focus:border-gold-500 focus:bg-white rounded-xl px-3.5 py-2.5 text-xs text-slate-800 focus:outline-none transition-all font-mono">
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-[9px] font-bold text-slate-500 uppercase tracking-wider mb-1 px-0.5">Bank IFSC Code</label>
                        <input type="text" name="bank_ifsc" required value="{{ $settings['bank_ifsc'] }}" class="w-full bg-slate-50 border border-slate-200 focus:border-gold-500 focus:bg-white rounded-xl px-3.5 py-2.5 text-xs text-slate-800 focus:outline-none transition-all font-mono">
                    </div>
                </div>
            </div>

            <!-- Submit action -->
            <div class="pt-6 lg:pt-0">
                <button type="submit" class="w-full bg-gradient-to-r from-gold-500 to-amber-500 hover:from-gold-600 hover:to-amber-600 text-slate-950 font-extrabold py-3.5 rounded-full text-xs uppercase tracking-wider shadow transform active:scale-95 transition-all flex items-center justify-center gap-1.5">
                    <i class="fa-solid fa-floppy-disk text-[11px]"></i>
                    <span>Save All Settings</span>
                </button>
            </div>

        </div>

    </form>

</div>
@endsection
