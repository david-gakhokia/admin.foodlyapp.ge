<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // 1. დავქმნათ ყველა საჭირო უფლება
        $permissions = [
            'view dashboard',
            'manage users',
            'manage roles',
            'manage permissions',

            'view customers',
            'create customers',
            'edit customers',
            'delete customers',

            'view products',
            'create products',
            'edit products',
            'delete products',

            'view kiosks',
            'create kiosks',
            'edit kiosks',
            'delete kiosks',

            'view restaurants',
            'create restaurants',
            'edit restaurants',
            'delete restaurants',

            'view spaces',
            'create spaces',
            'edit spaces',
            'delete spaces',

            'view tables',
            'create tables',
            'edit tables',
            'delete tables',

            'view dishes',
            'create dishes',
            'edit dishes',
            'delete dishes',

            'view spots',
            'create spots',
            'edit spots',
            'delete spots',

            'view cuisines',
            'create cuisines',
            'edit cuisines',
            'delete cuisines',

            'view places',
            'create places',
            'edit places',
            'delete places',

            'view menu_categories',
            'create menu_categories',
            'edit menu_categories',
            'delete menu_categories',

            'view menu_items',
            'create menu_items',
            'edit menu_items',
            'delete menu_items',

            'view reservations',
            'create reservations',
            'edit reservations',
            'delete reservations',

            
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // 2. Admin როლი ყველა უფლებით
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->syncPermissions($permissions);

        // 3. Editor როლი მხოლოდ customers და products მართვის უფლებით
        $editor = Role::firstOrCreate(['name' => 'editor']);
        $editor->syncPermissions([
            'view products',
            'create products',
            'edit products',
            'delete products',
            'view customers',
            'create customers',
            'edit customers',
            'delete customers',
        ]);

        // 4. User როლი მხოლოდ Dashboard-ის ნახვის უფლებით
        $user = Role::firstOrCreate(['name' => 'user']);
        $user->syncPermissions(['view dashboard']);
    }
}
