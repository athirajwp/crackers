<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Display the public price list / quick order storefront.
     */
    public function index()
    {
        $categories = Category::active()
            ->with(['products' => function ($query) {
                $query->active();
            }])
            ->orderBy('sort_order', 'asc')
            ->get();

        // Load specific configuration settings
        $settings = [
            'min_order_value' => Setting::get('min_order_value', 3800),
            'discount_percent' => Setting::get('discount_percent', 60),
            'store_whatsapp' => Setting::get('store_whatsapp', '919998887776'),
            'store_phone' => Setting::get('store_phone', '+91 9998887776'),
            'store_email' => Setting::get('store_email', 'crackerdemo@gmail.com'),
            'store_address' => Setting::get('store_address', 'Virudhunagar to Sivakasi Main Road, Sivakasi'),
        ];

        return view('storefront', compact('categories', 'settings'));
    }
}
