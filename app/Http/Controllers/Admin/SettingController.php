<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Show general settings panel.
     */
    public function index()
    {
        $settings = [
            'store_name' => Setting::get('store_name', 'Cracker Demo'),
            'min_order_value' => Setting::get('min_order_value', 3800),
            'discount_percent' => Setting::get('discount_percent', 60),
            'store_whatsapp' => Setting::get('store_whatsapp', '919998887776'),
            'store_phone' => Setting::get('store_phone', '+91 9998887776'),
            'store_email' => Setting::get('store_email', 'crackerdemo@gmail.com'),
            'store_address' => Setting::get('store_address', 'Virudhunagar to Sivakasi Main Road, Sivakasi'),
            'store_upi' => Setting::get('store_upi', 'aathishacrackers@okaxis'),
            'bank_name' => Setting::get('bank_name', 'State Bank of India'),
            'bank_acc_no' => Setting::get('bank_acc_no', '1234567890'),
            'bank_ifsc' => Setting::get('bank_ifsc', 'SBIN0000123'),
            'bank_holder' => Setting::get('bank_holder', 'Cracker Demo'),
        ];

        return view('admin.settings', compact('settings'));
    }

    /**
     * Update settings.
     */
    public function update(Request $request)
    {
        $rules = [
            'store_name' => 'required|string|max:255',
            'min_order_value' => 'required|numeric|min:0',
            'discount_percent' => 'required|numeric|min:0|max:100',
            'store_whatsapp' => 'required|string|max:20',
            'store_phone' => 'required|string|max:20',
            'store_email' => 'required|email|max:255',
            'store_address' => 'required|string',
            'store_upi' => 'required|string|max:255',
            'bank_name' => 'required|string|max:255',
            'bank_acc_no' => 'required|string|max:255',
            'bank_ifsc' => 'required|string|max:255',
            'bank_holder' => 'required|string|max:255',
        ];

        $request->validate($rules);

        // Update each setting statically
        Setting::set('store_name', $request->store_name, 'text');
        Setting::set('min_order_value', $request->min_order_value, 'number');
        Setting::set('discount_percent', $request->discount_percent, 'number');
        Setting::set('store_whatsapp', $request->store_whatsapp, 'text');
        Setting::set('store_phone', $request->store_phone, 'text');
        Setting::set('store_email', $request->store_email, 'text');
        Setting::set('store_address', $request->store_address, 'textarea');
        Setting::set('store_upi', $request->store_upi, 'text');
        Setting::set('bank_name', $request->bank_name, 'text');
        Setting::set('bank_acc_no', $request->bank_acc_no, 'text');
        Setting::set('bank_ifsc', $request->bank_ifsc, 'text');
        Setting::set('bank_holder', $request->bank_holder, 'text');

        return redirect()->route('admin.settings.index')->with('success', 'Store settings updated successfully!');
    }
}
