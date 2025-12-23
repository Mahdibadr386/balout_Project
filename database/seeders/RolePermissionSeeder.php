<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

        $permissions = [
            // Categories
            'category.index',
            'category.show',
            'category.store',
            'category.update',
            'category.delete',
            'category.options',

            // Products
            'product.index',
            'product.show',
            'product.store',
            'product.update',
            'product.delete',
            'product.change_status',
            'product.pin',

            // Options
            'option.index',
            'option.show',
            'option.store',
            'option.update',
            'option.delete',

            'option.detail.store',
            'option.detail.update',
            'option.detail.delete',

            // Feedbacks
            'feedback.index',
            'feedback.show',
            'feedback.approve',
            'feedback.delete',

            // ContactUs
            'contact_us.index',
            'contact_us.show',
            'contact_us.delete',

            // Users
            'user.index',
            'user.show',
            'user.store',
            'user.update',
            'user.delete',
            'user.change_status',
            'user.send_sms',

            // Orders
            'order.index',
            'order.show',
            'order.store',
            'order.delete',
            'order.update_status',

            // Permissions
            'permission.index',
            'permission.show',

            // Roles
            'role.index',
            'role.show',
            'role.store',
            'role.update',
            'role.delete',
            'role.assign',

            // Payments
            'payment.index',
            'payment.show',

            // Customers
            'customer.index',
            'customer.show',
            'customer.store',
            'customer.update',
            'customer.delete',
            'customer.change_status',
            'customer.send_sms',

            //Discount
            'discount.index',
            'discount.show',
            'discount.store',
            'discount.update',
            'discount.delete',
            'discount.usages',
            'discount.codes',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'api',
            ]);
        }

        // Roles
        $superAdmin = Role::firstOrCreate([
            'name' => 'super_admin',
            'guard_name' => 'api',
        ]);

        $admin = Role::firstOrCreate([
            'name' => 'admin',
            'guard_name' => 'api',
        ]);

        $superAdmin->syncPermissions(Permission::all());

        $admin->syncPermissions([
            // Categories
            'category.index',
            'category.show',
            'category.store',
            'category.update',
            'category.delete',
            'category.options',

            // Products
            'product.index',
            'product.show',
            'product.store',
            'product.update',
            'product.delete',
            'product.change_status',
            'product.pin',

            // Options
            'option.index',
            'option.show',
            'option.store',
            'option.update',
            'option.delete',

            'option.detail.store',
            'option.detail.update',
            'option.detail.delete',

            // Feedbacks
            'feedback.index',
            'feedback.show',
            'feedback.approve',
            'feedback.delete',

            // ContactUs
            'contact_us.index',
            'contact_us.show',
            'contact_us.delete',

            // Payments
            'payment.index',
            'payment.show',

            // Customers
            'customer.index',
            'customer.show',
            'customer.store',
            'customer.update',
            'customer.delete',
            'customer.change_status',
            'customer.send_sms',

            //Discount
            'discount.index',
            'discount.show',
            'discount.store',
            'discount.update',
            'discount.delete',
            'discount.usages',
            'discount.codes',
        ]);

        // Super Admin User
        $user = User::firstOrCreate(
            ['tel' => '09120000000'],
            [
                'first_name' => 'مدیر',
                'last_name'  => 'اصلی',
                'password'   => Hash::make('123456'),
                'is_active'  => 1,
            ]
        );

        $user->assignRole($superAdmin);

        //Admin User
        $adminUser = User::firstOrCreate(
            ['tel' => '09120000001'],
            [
                'first_name' => 'ادمین',
                'last_name'  => 'اول',
                'password'   => Hash::make('123456'),
                'is_active'  => 1,
            ]
        );

        $adminUser->assignRole($admin);

        app()->make(\Spatie\Permission\PermissionRegistrar::class)
            ->forgetCachedPermissions();
    }
}

