<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeedbacksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Fetch some users and products to link feedbacks
        $users = DB::table('users')->pluck('id');
        $products = DB::table('products')->pluck('id');

        // Example feedbacks
        $feedbacks = [
            [
                'user_id' => $users->random(),
                'product_id' => $products->random(),
                'comment' => 'Absolutely loved this cake! Very rich and tasty.',
                'rate' => 5,
            ],
            [
                'user_id' => $users->random(),
                'product_id' => $products->random(),
                'comment' => 'Good, but a bit too sweet for my taste.',
                'rate' => 4,
            ],
            [
                'user_id' => $users->random(),
                'product_id' => $products->random(),
                'comment' => 'Not fresh enough, disappointed.',
                'rate' => 2,
            ],
        ];

        // Insert feedbacks
        foreach ($feedbacks as $feedback) {
            DB::table('feedbacks')->insert(array_merge(
                $feedback,
                [
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ));
        }
    }
}
