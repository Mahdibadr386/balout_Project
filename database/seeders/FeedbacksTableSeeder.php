<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeedbacksTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('feedbacks')->insert([
            [
                'product_id' => 1,
                'user_id' => 2,
                'comment' => 'کیفیت پسته خیلی عالی بود، تازه و خوش‌طعم.',
                'rate' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 2,
                'user_id' => 2,
                'comment' => 'بادام کمی خشک بود ولی طعم خوبی داشت.',
                'rate' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 3,
                'user_id' => 1,
                'comment' => 'گلدان سفالی خیلی زیباست، لعابش واقعا خاصه.',
                'rate' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 4,
                'user_id' => 2,
                'comment' => 'زردچوبه عطر خیلی خوبی داره و کاملا طبیعی بود.',
                'rate' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
