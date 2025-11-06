<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Main categories
        $categories = [
            [
                'name' => 'Cakes',
                'slug' => Str::slug('Cakes'),
                'parent_id' => null,
                'description' => 'All kinds of cakes',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Cookies',
                'slug' => Str::slug('Cookies'),
                'parent_id' => null,
                'description' => 'Delicious cookies',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Pastries',
                'slug' => Str::slug('Pastries'),
                'parent_id' => null,
                'description' => 'Various pastries',
                'is_active' => true,
                'sort_order' => 3,
            ],
        ];

        // Insert main categories and get their IDs
        foreach ($categories as $category) {
            $categoryId = DB::table('categories')->insertGetId([
                'name' => $category['name'],
                'slug' => $category['slug'],
                'parent_id' => $category['parent_id'],
                'description' => $category['description'],
                'is_active' => $category['is_active'],
                'sort_order' => $category['sort_order'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Example: Adding subcategories
            if ($category['name'] === 'Cakes') {
                $subcategories = [
                    ['name' => 'Chocolate Cakes', 'slug' => Str::slug('Chocolate Cakes')],
                    ['name' => 'Fruit Cakes', 'slug' => Str::slug('Fruit Cakes')],
                    ['name' => 'Cheesecakes', 'slug' => Str::slug('Cheesecakes')],
                ];

                foreach ($subcategories as $sub) {
                    DB::table('categories')->insert([
                        'name' => $sub['name'],
                        'slug' => $sub['slug'],
                        'parent_id' => $categoryId,
                        'description' => $sub['name'] . ' description',
                        'is_active' => true,
                        'sort_order' => 0,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }
}
