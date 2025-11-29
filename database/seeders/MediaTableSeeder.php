<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MediaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Fetch models
        $users = DB::table('users')->pluck('id');
        $products = DB::table('products')->pluck('id');
        $categories = DB::table('categories')->pluck('id');

        $mediaItems = [];

        // Example: attach a profile image to users
        foreach ($users as $userId) {
            $mediaItems[] = [
                'model_id' => $userId,
                'model_type' => 'App\\Models\\User',
                'type' => 'image',
                'collection_name' => 'profile',
                'file_name' => "user_{$userId}_avatar.jpg",
                'disk' => 'public',
                'path' => "uploads/users/user_{$userId}_avatar.jpg",
                'url' => "/storage/uploads/users/user_{$userId}_avatar.jpg",
                'size' => 102400,
                'alt' => 'media',
                'order_column' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Example: attach gallery images to products
        foreach ($products as $productId) {
            for ($i = 1; $i <= 3; $i++) {
                $mediaItems[] = [
                    'model_id' => $productId,
                    'model_type' => 'App\\Models\\Product',
                    'type' => 'image',
                    'collection_name' => 'gallery',
                    'file_name' => "product_{$productId}_img{$i}.jpg",
                    'disk' => 'public',
                    'path' => "uploads/products/product_{$productId}_img{$i}.jpg",
                    'url' => "/storage/uploads/products/product_{$productId}_img{$i}.jpg",
                    'size' => 204800,
                    'alt' => 'media',
                    'order_column' => $i,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        // Example: attach banner images to categories
        foreach ($categories as $categoryId) {
            $mediaItems[] = [
                'model_id' => $categoryId,
                'model_type' => 'App\\Models\\Category',
                'type' => 'image',
                'collection_name' => 'banner',
                'file_name' => "category_{$categoryId}_banner.jpg",
                'disk' => 'public',
                'path' => "uploads/categories/category_{$categoryId}_banner.jpg",
                'url' => "/storage/uploads/categories/category_{$categoryId}_banner.jpg",
                'size' => 512000,
                'alt' => 'media',
                'order_column' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Bulk insert media items
        DB::table('media')->insert($mediaItems);
    }
}
