<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            UsersTableSeeder::class,
            CategoriesTableSeeder::class,
            ProductsTableSeeder::class,
            FeedbacksTableSeeder::class,
            RolePermissionSeeder::class,
            OptionSeeder::class,
            OptionDetailSeeder::class,
            BranchSeeder::class,
            TimeSeeder::class,
            DiscountSeeder::class,
        ]);


    }
}
