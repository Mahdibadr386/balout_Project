<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // مدل کاربر
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {

        $userRole = Role::firstOrCreate(
            ['name' => 'user', 'guard_name' => 'api']
        );


        $user = User::create([
            'is_active' => true,
            'password' => Hash::make('user123'),
            'first_name' => 'کاربر',
            'last_name' => 'نمونه',
            'name_en' => 'Sample User',
            'tel' => '09121111111',
            'national_code' => '9876543210',
            'description' => 'کاربر تستی برای بررسی عملکرد سیستم',
            'code' => 'USR001',
            'status' => 1,
            'birth_date' => '1995-05-15',
        ],[
            'is_active' => true,
            'password' => Hash::make('user123'),
            'first_name' => 'مهدی',
            'last_name' => 'بدرخانی',
            'name_en' => 'Sample User',
            'tel' => '09121111111',
            'national_code' => '9876543210',
            'description' => 'کاربر تستی برای بررسی عملکرد سیستم',
            'code' => 'USR001',
            'status' => 1,
            'birth_date' => '1995-05-15',
        ]);


        $user->assignRole($userRole);



        $user->addresses()->create([
            'address' => 'اصفهان، خیابان چهارباغ عباسی، پلاک ۱۰',
            'tel' => '03133330000',
            'city_id' => 2,
        ],[
            'address' => 'تهران، خیابان چهارباغ عباسی، پلاک ۱۰',
            'tel' => '03133330000',
            'city_id' => 2,
        ]);

    }
}
