<?php

namespace Database\Seeders;

use App\Models\Discount;
use App\Models\DiscountCode;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Product
        Discount::create([
            'name' => '۲۰٪ تخفیف روی محصول X',
            'scope' => 'product',
            'discountable_type' => \App\Models\Product::class,
            'discountable_id' => 1,
            'type' => 'percent',
            'value' => 20,
            'max_amount' => 50000,
            'starts_at' => now(),
            'ends_at' => now()->addDays(3),
            'is_active' => true,
        ]);

        //campaign
        Discount::create([
            'name' => 'کمپین جمعه سیاه',
            'scope' => 'order',
            'type' => 'percent',
            'value' => 10,
            'starts_at' => now(),
            'ends_at' => now()->addWeek(),
            'max_amount' => 300000,
            'is_active' => true,
        ]);


        $discount = Discount::create([
            'name' => 'هدیه تولد کاربر',
            'scope' => 'personal',
            'is_personal' => true,
            'type' => 'amount',
            'value' => 50000,
            'starts_at' => now(),
            'ends_at' => now()->addMonth(),
            'is_active' => true,
        ]);

        DiscountCode::create([
            'discount_id' => $discount->id,
            'user_id' => 1, // یا factory
            'code' => 'BIRTHDAY-500',
        ]);

    }

}
