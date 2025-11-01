<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MediaTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('media')->insert([
            [
                'model_type' => 'App\\Models\\Product',
                'model_id' => 1,
                'collection_name' => 'product_images',
                'name' => 'pistachio_main',
                'file_name' => 'pistachio_main.jpg',
                'mime_type' => 'image/jpeg',
                'disk' => 'public',
                'size' => 245678,
                'manipulations' => json_encode([]),
                'custom_properties' => json_encode(['alt' => 'پسته تازه ایرانی']),
                'responsive_images' => json_encode([]),
                'order_column' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'model_type' => 'App\\Models\\Product',
                'model_id' => 2,
                'collection_name' => 'product_images',
                'name' => 'almond_main',
                'file_name' => 'almond_main.jpg',
                'mime_type' => 'image/jpeg',
                'disk' => 'public',
                'size' => 212340,
                'manipulations' => json_encode([]),
                'custom_properties' => json_encode(['alt' => 'بادام تازه ارگانیک']),
                'responsive_images' => json_encode([]),
                'order_column' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'model_type' => 'App\\Models\\User',
                'model_id' => 1,
                'collection_name' => 'avatars',
                'name' => 'admin_avatar',
                'file_name' => 'admin.jpg',
                'mime_type' => 'image/jpeg',
                'disk' => 'public',
                'size' => 98234,
                'manipulations' => json_encode([]),
                'custom_properties' => json_encode(['alt' => 'عکس پروفایل مدیر']),
                'responsive_images' => json_encode([]),
                'order_column' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'model_type' => 'App\\Models\\Category',
                'model_id' => 1,
                'collection_name' => 'category_icons',
                'name' => 'dry_fruits_icon',
                'file_name' => 'dry_fruits_icon.png',
                'mime_type' => 'image/png',
                'disk' => 'public',
                'size' => 51234,
                'manipulations' => json_encode([]),
                'custom_properties' => json_encode(['alt' => 'آیکن خشکبار']),
                'responsive_images' => json_encode([]),
                'order_column' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
