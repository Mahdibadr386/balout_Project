<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'category_id' => 1,
                'name' => 'پسته اکبری ممتاز',
                'name_en' => 'Premium Akbari Pistachio',
                'description' => 'پسته تازه و درجه یک مناسب برای پذیرایی',
                'price_number' => '250000',
                'price_kilo' => '1800000',
                'price_discounted' => 1600000,
                'unit' => 'کیلوگرم',
                'rate' => 5,
                'minimum_weight' => 1,
                'maximum_weight' => 10,
                'preparation_time' => 2,
                'batch_id' => 'PIS-001',
                'available' => true,
                'avg_weight' => '1kg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 1,
                'name' => 'بادام خام',
                'name_en' => 'Raw Almond',
                'description' => 'بادام تازه و خوش‌طعم مناسب برای رژیم غذایی',
                'price_number' => '200000',
                'price_kilo' => '1400000',
                'price_discounted' => 1200000,
                'unit' => 'کیلوگرم',
                'rate' => 4,
                'minimum_weight' => 1,
                'maximum_weight' => 20,
                'preparation_time' => 1,
                'batch_id' => 'ALM-002',
                'available' => true,
                'avg_weight' => '1kg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 2,
                'name' => 'گلدان سفالی لعاب‌دار',
                'name_en' => 'Glazed Clay Pot',
                'description' => 'دست‌ساز با طرح سنتی، مناسب دکور خانه',
                'price_number' => '350000',
                'price_kilo' => null,
                'price_discounted' => 320000,
                'unit' => 'عدد',
                'rate' => 5,
                'minimum_number' => 1,
                'maximum_number' => 10,
                'preparation_time' => 3,
                'batch_id' => 'CER-101',
                'available' => true,
                'avg_weight' => '1.2kg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 3,
                'name' => 'زردچوبه درجه یک',
                'name_en' => 'Premium Turmeric',
                'description' => 'ادویه طبیعی و خالص با رنگ طلایی زیبا',
                'price_number' => '150000',
                'price_kilo' => '1000000',
                'price_discounted' => 950000,
                'unit' => 'کیلوگرم',
                'rate' => 5,
                'minimum_weight' => 1,
                'maximum_weight' => 15,
                'preparation_time' => 2,
                'batch_id' => 'SPI-030',
                'available' => true,
                'avg_weight' => '1kg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
