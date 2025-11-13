<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Fetch existing categories to link products
        $categories = DB::table('categories')->pluck('id', 'name');

        // Example products
        $products = [
            [
                'name' => 'Chocolate Cake',
                'slug' => Str::slug('Chocolate Cake'),
                'description' => 'Rich and moist chocolate cake.',
                'price_base' => 45.50,
                'discount_percentage' => 10,
                'unit' => 'piece',
                'quantity' => 10,
                'minimum' => 1,
                'maximum' => 20,
                'preparation_time' => 60, // minutes
                'available' => true,
                'rate' => 4.8,
                'batch_code' => 'BCH-001',
                'matin_code' => 'MAT-001',
                'category_id' => $categories['Chocolate Cakes'] ?? null,
            ],
            [
                'name' => 'Fruit Cake',
                'slug' => Str::slug('Fruit Cake'),
                'description' => 'Delicious cake with fresh fruits.',
                'price_base' => 50.00,
                'discount_percentage' => 5,
                'unit' => 'piece',
                'quantity' => 11,
                'minimum' => 1,
                'maximum' => 15,
                'preparation_time' => 70,
                'available' => true,
                'rate' => 4.6,
                'batch_code' => 'BCH-002',
                'matin_code' => 'MAT-002',
                'category_id' => $categories['Fruit Cakes'] ?? null,
            ],
            [
                'name' => 'Cheesecake',
                'slug' => Str::slug('Cheesecake'),
                'description' => 'Classic creamy cheesecake.',
                'price_base' => 55.00,
                'discount_percentage' => 0,
                'unit' => 'piece',
                'quantity' => 5,
                'minimum' => 1,
                'maximum' => 10,
                'preparation_time' => 90,
                'available' => true,
                'rate' => 4.9,
                'batch_code' => 'BCH-003',
                'matin_code' => 'MAT-003',
                'category_id' => $categories['Cheesecakes'] ?? null,
            ],
        ];

        // Insert products into the database
        foreach ($products as $product) {
            DB::table('products')->insert(array_merge(
                $product,
                [
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ));
        }
    }
}
