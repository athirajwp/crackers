<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategoryAndProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Seed Store Settings
        $settings = [
            'store_name' => ['value' => 'Cracker Demo', 'type' => 'text'],
            'min_order_value' => ['value' => '3800', 'type' => 'number'],
            'discount_percent' => ['value' => '60', 'type' => 'number'],
            'store_whatsapp' => ['value' => '919998887776', 'type' => 'text'],
            'store_phone' => ['value' => '+91 9998887776', 'type' => 'text'],
            'store_email' => ['value' => 'crackerdemo@gmail.com', 'type' => 'text'],
            'store_address' => ['value' => 'Virudhunagar to Sivakasi Main Road, Sivakasi', 'type' => 'textarea'],
            'store_upi' => ['value' => 'aathishacrackers@okaxis', 'type' => 'text'],
            'bank_name' => ['value' => 'State Bank of India', 'type' => 'text'],
            'bank_acc_no' => ['value' => '1234567890', 'type' => 'text'],
            'bank_ifsc' => ['value' => 'SBIN0000123', 'type' => 'text'],
            'bank_holder' => ['value' => 'Cracker Demo', 'type' => 'text'],
        ];

        foreach ($settings as $key => $data) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $data['value'], 'type' => $data['type']]
            );
        }

        // 2. Seed Categories and Products
        $inventory = [
            'Sparklers' => [
                'sort_order' => 1,
                'products' => [
                    ['name' => '7cm Electric Sparklers', 'pack_size' => '1 Box (10 Pcs)', 'mrp' => 150.00],
                    ['name' => '7cm Green Sparklers', 'pack_size' => '1 Box (10 Pcs)', 'mrp' => 160.00],
                    ['name' => '7cm Red Sparklers', 'pack_size' => '1 Box (10 Pcs)', 'mrp' => 180.00],
                    ['name' => '10cm Electric Sparklers', 'pack_size' => '1 Box (10 Pcs)', 'mrp' => 240.00],
                    ['name' => '10cm Green Sparklers', 'pack_size' => '1 Box (10 Pcs)', 'mrp' => 260.00],
                    ['name' => '10cm Red Sparklers', 'pack_size' => '1 Box (10 Pcs)', 'mrp' => 280.00],
                    ['name' => '12cm Electric Sparklers', 'pack_size' => '1 Box (10 Pcs)', 'mrp' => 300.00],
                    ['name' => '15cm Multi-Color Sparklers', 'pack_size' => '1 Box (10 Pcs)', 'mrp' => 450.00],
                    ['name' => '30cm Electric Sparklers', 'pack_size' => '1 Box (5 Pcs)', 'mrp' => 900.00],
                    ['name' => '30cm Color Sparklers', 'pack_size' => '1 Box (5 Pcs)', 'mrp' => 1000.00],
                ]
            ],
            'Ground Chakkars' => [
                'sort_order' => 2,
                'products' => [
                    ['name' => 'Ground Chakkars Baby', 'pack_size' => '1 Box (10 Pcs)', 'mrp' => 120.00],
                    ['name' => 'Ground Chakkars Big', 'pack_size' => '1 Box (10 Pcs)', 'mrp' => 180.00],
                    ['name' => 'Ground Chakkars Special', 'pack_size' => '1 Box (10 Pcs)', 'mrp' => 240.00],
                    ['name' => 'Ground Chakkars Deluxe', 'pack_size' => '1 Box (5 Pcs)', 'mrp' => 320.00],
                    ['name' => 'Disco Wheel (Spinning)', 'pack_size' => '1 Box (5 Pcs)', 'mrp' => 400.00],
                ]
            ],
            'Flower Pots' => [
                'sort_order' => 3,
                'products' => [
                    ['name' => 'Flower Pots Small', 'pack_size' => '1 Box (10 Pcs)', 'mrp' => 160.00],
                    ['name' => 'Flower Pots Big', 'pack_size' => '1 Box (10 Pcs)', 'mrp' => 240.00],
                    ['name' => 'Flower Pots Special', 'pack_size' => '1 Box (10 Pcs)', 'mrp' => 360.00],
                    ['name' => 'Flower Pots Deluxe', 'pack_size' => '1 Box (5 Pcs)', 'mrp' => 480.00],
                    ['name' => 'Flower Pots Giant', 'pack_size' => '1 Box (5 Pcs)', 'mrp' => 600.00],
                    ['name' => 'Flower Pots Ashoora (Tri-color)', 'pack_size' => '1 Box (2 Pcs)', 'mrp' => 800.00],
                ]
            ],
            'Fountains & Novelties' => [
                'sort_order' => 4,
                'products' => [
                    ['name' => 'Twinkling Stars', 'pack_size' => '1 Packet (10 Pcs)', 'mrp' => 150.00],
                    ['name' => 'Pencil Small', 'pack_size' => '1 Box (10 Pcs)', 'mrp' => 160.00],
                    ['name' => 'Pencil Deluxe', 'pack_size' => '1 Box (5 Pcs)', 'mrp' => 320.00],
                    ['name' => 'Magic Fountain (Multi Color)', 'pack_size' => '1 Box (2 Pcs)', 'mrp' => 500.00],
                    ['name' => 'Peacock Fountain', 'pack_size' => '1 Box (1 Pc)', 'mrp' => 600.00],
                    ['name' => 'Butterfly Novelty (Flying)', 'pack_size' => '1 Box (5 Pcs)', 'mrp' => 450.00],
                ]
            ],
            'Rockets' => [
                'sort_order' => 5,
                'products' => [
                    ['name' => 'Baby Rockets', 'pack_size' => '1 Box (10 Pcs)', 'mrp' => 180.00],
                    ['name' => 'Lunik Rockets (Sounding)', 'pack_size' => '1 Box (10 Pcs)', 'mrp' => 280.00],
                    ['name' => 'Whistling Rockets', 'pack_size' => '1 Box (10 Pcs)', 'mrp' => 400.00],
                    ['name' => 'Space Rocket Deluxe', 'pack_size' => '1 Box (3 Pcs)', 'mrp' => 700.00],
                ]
            ],
            'Sound Crackers' => [
                'sort_order' => 6,
                'products' => [
                    ['name' => '2/8\" Lakshmi Crackers', 'pack_size' => '1 Packet (10 Pcs)', 'mrp' => 30.00],
                    ['name' => '3/5\" Lakshmi Crackers', 'pack_size' => '1 Packet (10 Pcs)', 'mrp' => 40.00],
                    ['name' => '4\" Lakshmi Crackers (Big)', 'pack_size' => '1 Packet (10 Pcs)', 'mrp' => 60.00],
                    ['name' => '4\" Deluxe Lakshmi', 'pack_size' => '1 Packet (10 Pcs)', 'mrp' => 80.00],
                    ['name' => '5\" Super Deluxe Lakshmi', 'pack_size' => '1 Packet (10 Pcs)', 'mrp' => 120.00],
                    ['name' => 'Bullet Crackers', 'pack_size' => '1 Packet (10 Pcs)', 'mrp' => 100.00],
                ]
            ],
            'Fancy Aerial Shots' => [
                'sort_order' => 7,
                'products' => [
                    ['name' => '7 Shot Crackers', 'pack_size' => '1 Box (5 Pcs)', 'mrp' => 350.00],
                    ['name' => '12 Shot Chhota Fancy', 'pack_size' => '1 Box (1 Pc)', 'mrp' => 450.00],
                    ['name' => '30 Shot Multi-Color', 'pack_size' => '1 Box (1 Pc)', 'mrp' => 1200.00],
                    ['name' => '60 Shot Royal Aerial', 'pack_size' => '1 Box (1 Pc)', 'mrp' => 2400.00],
                    ['name' => '120 Shot Grand Finale', 'pack_size' => '1 Box (1 Pc)', 'mrp' => 4800.00],
                ]
            ],
            'Bombs' => [
                'sort_order' => 8,
                'products' => [
                    ['name' => 'Hydro Bomb Green', 'pack_size' => '1 Box (10 Pcs)', 'mrp' => 200.00],
                    ['name' => 'Atom Bomb Classic', 'pack_size' => '1 Box (10 Pcs)', 'mrp' => 280.00],
                    ['name' => 'King Kong Bomb (Super Loud)', 'pack_size' => '1 Box (5 Pcs)', 'mrp' => 400.00],
                    ['name' => 'Classic Paper Bomb', 'pack_size' => '1 Box (5 Pcs)', 'mrp' => 350.00],
                ]
            ],
            'Gift Boxes' => [
                'sort_order' => 9,
                'products' => [
                    ['name' => 'Anand 20-Items Gift Box', 'pack_size' => '1 Box', 'mrp' => 1200.00],
                    ['name' => 'Deepavali Special 35-Items Box', 'pack_size' => '1 Box', 'mrp' => 2500.00],
                    ['name' => 'Family Delight 50-Items Box', 'pack_size' => '1 Box', 'mrp' => 4000.00],
                    ['name' => 'Aathisha Royal Premium 75-Items Box', 'pack_size' => '1 Box', 'mrp' => 6500.00],
                ]
            ],
        ];

        $discountPercent = Setting::get('discount_percent', 60);

        foreach ($inventory as $catName => $catDetails) {
            // Create Category
            $category = Category::updateOrCreate(
                ['slug' => Str::slug($catName)],
                [
                    'name' => $catName,
                    'sort_order' => $catDetails['sort_order'],
                    'status' => 'active'
                ]
            );

            // Create Products in Category
            foreach ($catDetails['products'] as $prod) {
                // Selling price is calculated based on the general discount percent (e.g. 60% off printed MRP)
                $sellingPrice = $prod['mrp'] * (1 - ($discountPercent / 100));

                Product::updateOrCreate(
                    [
                        'category_id' => $category->id,
                        'name' => $prod['name']
                    ],
                    [
                        'pack_size' => $prod['pack_size'],
                        'mrp' => $prod['mrp'],
                        'selling_price' => $sellingPrice,
                        'status' => 'active'
                    ]
                );
            }
        }
    }
}
