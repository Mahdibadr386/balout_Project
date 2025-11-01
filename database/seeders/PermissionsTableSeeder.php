<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('permissions')->insert([
            [
                'name' => 'مدیریت کاربران',
                'name_en' => 'Manage Users',
                'category_name' => 'کاربران',
                'category_name_en' => 'Users',
                'slug' => 'manage-users',
            ],
            [
                'name' => 'مدیریت نقش‌ها',
                'name_en' => 'Manage Roles',
                'category_name' => 'دسترسی‌ها',
                'category_name_en' => 'Permissions',
                'slug' => 'manage-roles',
            ],
            [
                'name' => 'مدیریت محصولات',
                'name_en' => 'Manage Products',
                'category_name' => 'محصولات',
                'category_name_en' => 'Products',
                'slug' => 'manage-products',
            ],
            [
                'name' => 'مدیریت سفارش‌ها',
                'name_en' => 'Manage Orders',
                'category_name' => 'سفارشات',
                'category_name_en' => 'Orders',
                'slug' => 'manage-orders',
            ],
            [
                'name' => 'مشاهده گزارشات',
                'name_en' => 'View Reports',
                'category_name' => 'گزارشات',
                'category_name_en' => 'Reports',
                'slug' => 'view-reports',
            ],
            [
                'name' => 'مدیریت نظرات کاربران',
                'name_en' => 'Manage Feedbacks',
                'category_name' => 'نظرات',
                'category_name_en' => 'Feedbacks',
                'slug' => 'manage-feedbacks',
            ],
        ]);
    }
}
