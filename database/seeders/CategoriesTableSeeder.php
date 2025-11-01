<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    public function run(): void
    {

        DB::table('categories')->insert([
            [
                'name' => 'آجیل و خشکبار',
                'slug' => 'nuts-and-dried-fruits',
                'parent_id' => null,
                'description' => 'انواع خشکبار با کیفیت بالا',
                'image' => 'categories/nuts.jpg',
                'icon' => 'icons/nut.svg',
                'is_active' => true,
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'سفال و صنایع دستی',
                'slug' => 'handicrafts',
                'parent_id' => null,
                'description' => 'محصولات سفالی و دست‌ساز',
                'image' => 'categories/handicrafts.jpg',
                'icon' => 'icons/hand.svg',
                'is_active' => true,
                'sort_order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'ادویه‌جات',
                'slug' => 'spices',
                'parent_id' => null,
                'description' => 'ادویه‌جات تازه و خوش‌عطر',
                'image' => 'categories/spices.jpg',
                'icon' => 'icons/spice.svg',
                'is_active' => true,
                'sort_order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'ظروف سفالی خاص',
                'slug' => 'ceramic-wares',
                'parent_id' => 2,
                'description' => 'ظروف خاص برای دکور یا استفاده روزمره',
                'image' => 'categories/ceramic.jpg',
                'icon' => 'icons/ceramic.svg',
                'is_active' => true,
                'sort_order' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
