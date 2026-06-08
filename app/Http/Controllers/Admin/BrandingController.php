<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class BrandingController extends Controller
{
    /**
     * Display the site branding customization console.
     */
    public function index()
    {
        $keys = [
            'instagram_link', 'whatsapp_link', 'youtube_link', 'twitter_link', 'facebook_link',
            'promo_code_1', 'promo_value_1',
            'promo_code_2', 'promo_value_2',
            'promo_code_3', 'promo_value_3',
            'promo_code_4', 'promo_value_4',
            'promo_code_5', 'promo_value_5',
            'admin_theme', 'banner_scroller',
            'terms_conditions', 'about_us',
            'slider_image_1', 'slider_image_2', 'slider_image_3',
            'banner_image_1', 'banner_image_2', 'banner_image_3',
            'aboutus_image_1', 'aboutus_image_2', 'aboutus_image_3',
            'offer_image_1', 'offer_image_2', 'offer_image_3',
            'store_address', 'store_phone', 'store_email',
            'bank_name', 'bank_ifsc', 'bank_acc_no', 'bank_holder', 'bank_branch', 'bank_acc_type',
            'license_name', 'license_no', 'store_map_iframe',
        ];

        $settings = [];
        foreach ($keys as $key) {
            $settings[$key] = Setting::get($key, '');
        }

        // Apply fallback default
        if (empty($settings['admin_theme'])) {
            $settings['admin_theme'] = 'gold';
        }

        return view('admin.branding', compact('settings'));
    }

    /**
     * Update branding parameters and dynamic image assets.
     */
    public function update(Request $request)
    {
        // 1. Handle all text / text-area input fields
        $fields = $request->except(['_token', 'slider_image_1', 'slider_image_2', 'slider_image_3', 'banner_image_1', 'banner_image_2', 'banner_image_3', 'aboutus_image_1', 'aboutus_image_2', 'aboutus_image_3', 'offer_image_1', 'offer_image_2', 'offer_image_3']);

        foreach ($fields as $key => $value) {
            $type = 'text';
            if (in_array($key, ['terms_conditions', 'about_us', 'store_map_iframe'])) {
                $type = 'textarea';
            }
            Setting::set($key, $value, $type);
        }

        // 2. Handle all file uploads dynamically
        $imageFields = [
            'slider_image_1', 'slider_image_2', 'slider_image_3',
            'banner_image_1', 'banner_image_2', 'banner_image_3',
            'aboutus_image_1', 'aboutus_image_2', 'aboutus_image_3',
            'offer_image_1', 'offer_image_2', 'offer_image_3',
        ];

        foreach ($imageFields as $field) {
            if ($request->hasFile($field)) {
                $request->validate([
                    $field => 'image|mimes:jpeg,png,jpg,webp|max:3072'
                ]);

                $oldPath = Setting::get($field);
                if ($oldPath && file_exists(public_path($oldPath))) {
                    @unlink(public_path($oldPath));
                }

                $fileName = time() . '_' . $field . '_' . uniqid() . '.' . $request->file($field)->extension();
                $request->file($field)->move(public_path('uploads/branding'), $fileName);
                $filePath = 'uploads/branding/' . $fileName;

                Setting::set($field, $filePath, 'text');
            }
        }

        return redirect()->route('admin.branding.index')->with('success', 'Site branding customizations updated successfully!');
    }
}
