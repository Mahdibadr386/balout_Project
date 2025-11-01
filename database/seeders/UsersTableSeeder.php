<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        // ==========================
        // 🔹 USERS
        // ==========================
        DB::table('users')->insert([
            [
                'is_admin' => true,
                'is_active' => true,
                'password' => Hash::make('admin123'),
                'first_name' => 'مدیر',
                'last_name' => 'اصلی',
                'name_en' => 'Admin User',
                'tel' => '09120000000',
                'national_code' => '1234567890',
                'description' => 'کاربر مدیر سیستم',
                'code' => 'ADM001',
                'birth_date' => '1990-01-01',
                'marriage_date' => null,
                'last_login_date' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'is_admin' => false,
                'is_active' => true,
                'password' => Hash::make('user123'),
                'first_name' => 'کاربر',
                'last_name' => 'نمونه',
                'name_en' => 'Sample User',
                'tel' => '09121111111',
                'national_code' => '9876543210',
                'description' => 'کاربر تستی برای بررسی عملکرد سیستم',
                'code' => 'USR001',
                'birth_date' => '1995-05-15',
                'marriage_date' => null,
                'last_login_date' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // ==========================
        // 🔹 USER ADDRESSES
        // ==========================
        DB::table('user_addresses')->insert([
            [
                'address' => 'تهران، خیابان ولیعصر، کوچه نوفل لوشاتو، پلاک ۲۳',
                'tel' => '02188330000',
                'user_id' => 1,
                'city_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'address' => 'اصفهان، خیابان چهارباغ عباسی، پلاک ۱۰',
                'tel' => '03133330000',
                'user_id' => 2,
                'city_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);


        // ==========================
        // 🔹 USER PERMISSIONS (Pivot)
        // ==========================
        DB::table('user_permissions')->insert([
            [
                'user_id' => 1,
                'permission_id' => 1,
            ],
            [
                'user_id' => 1,
                'permission_id' => 2,
            ],
            [
                'user_id' => 1,
                'permission_id' => 3,
            ],
            [
                'user_id' => 2,
                'permission_id' => 3,
            ],
        ]);

    }
}
