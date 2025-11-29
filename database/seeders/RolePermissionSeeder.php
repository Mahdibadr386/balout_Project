<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {

        app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();


        $permissions = [

            'auth.login','auth.logout',
            'profile.view.self','profile.update.self','profile.view.others','profile.update.others','profile.delete.self',


            'user.view','user.view.own','user.create','user.update','user.update.own','user.delete','user.restore','user.force_delete',
            'user.ban','user.assign.roles','user.manage.sessions','user.manage.tokens',
            'user_address.view','user_address.create','user_address.update','user_address.delete',


            'Category.view','Category.create','Category.update','Category.delete','Category.restore','Category.manage.tree',


            'product.view','product.create','product.update','product.delete','product.restore','product.force_delete',
            'product.manage.images','product.toggle.available','product.update.pricing','product.update.stock',


            'feedback.view','feedback.create','feedback.delete','feedback.moderate',


            'media.upload','media.view','media.delete','media.convert','media.manage.collections',


            'jobs.view','jobs.retry','jobs.delete',
            'job_batches.view','job_batches.cancel',
            'failed_jobs.view','failed_jobs.delete',


            'cache.view','cache.clear','cache.lock.view','cache.lock.release',


            'sessions.view','sessions.revoke',


            'oauth.clients.view','oauth.clients.create','oauth.clients.update','oauth.clients.delete',
            'oauth.tokens.view','oauth.tokens.revoke',
            'oauth.device_codes.view','oauth.device_codes.revoke',


            'admin.dashboard.view','admin.audit.view',
            'settings.view','settings.update',
            'system.maintenance','system.deploy','system.impersonate','system.rollback','system.db.migrate',


            'reports.view','reports.export',
        ];


        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm, 'guard_name' => 'api']);
        }

        // ====== roles ======
        $roleUser = Role::firstOrCreate(['name' => 'user', 'guard_name' => 'api']);
        $roleAdmin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'api']);
        $roleSuper = Role::firstOrCreate(['name' => 'super_admin', 'guard_name' => 'api']);


        $roleUser->syncPermissions([
            'auth.login','auth.logout',
            'profile.view.self','profile.update.self','profile.delete.self',
            'product.view','Category.view','feedback.view','feedback.create',
            'user.view.own','user_address.view','user_address.create','user_address.update','user_address.delete',
            'sessions.view'
        ]);


        $roleAdmin->syncPermissions([

            'auth.login','auth.logout','profile.view.self','profile.update.self','profile.view.others',


            'user.view','user.update','user.ban','user.manage.sessions','user.manage.tokens','user_address.view','user_address.update',


            'product.view','product.create','product.update','product.delete','product.manage.images','product.toggle.available','product.update.pricing','product.update.stock','product.restore',


            'Category.view','Category.create','Category.update','Category.delete','Category.manage.tree',


            'feedback.view','feedback.delete','feedback.moderate',


            'media.upload','media.view','media.delete','media.convert','media.manage.collections',


            'jobs.view','jobs.retry','failed_jobs.view','failed_jobs.delete','job_batches.view',


            'cache.view','cache.clear','sessions.view','sessions.revoke',


            'oauth.tokens.view','oauth.tokens.revoke','oauth.clients.view',


            'reports.view','reports.export','admin.dashboard.view','admin.audit.view',


            'settings.view'
        ]);


        $roleSuper->syncPermissions(Permission::all());

        $superAdmin = User::firstOrCreate(
            ['tel' => '09120000000'],
            [
                'first_name' => 'مدیر',
                'last_name'  => 'اصلی',
                'password'   => Hash::make('123456'),
                'is_active'  => 1,
            ]
        );
        $superAdmin->assignRole($roleSuper);


        $admin1 = User::firstOrCreate(
            ['tel' => '09120000001'],
            [
                'first_name' => 'ادمین',
                'last_name'  => 'اول',
                'password'   => Hash::make('123456'),
                'is_active'  => 1,
            ]
        );
        $admin1->assignRole($roleAdmin);

        $admin2 = User::firstOrCreate(
            ['tel' => '09120000002'],
            [
                'first_name' => 'ادمین',
                'last_name'  => 'دوم',
                'password'   => Hash::make('123456'),
                'is_active'  => 1,
            ]
        );
        $admin2->assignRole($roleAdmin);


        app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
    }
}
