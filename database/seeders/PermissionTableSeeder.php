<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            //For roll and permission
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',

            //For Role and permission
            'role-and-permission-list',

            //For User
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',

            //For Category
            'category-list',
            'category-create',
            'category-edit',
            'category-delete',

            //For Item
            'item-list',
            'item-create',
            'item-edit',
            'item-delete',

            //For Order
            'sale-list',
            'order-list',
            'manage-order',

            //Dashboard
            'login-log-list',
            'inventory-list',


        ];
        foreach ($permissions as $permission) {
            if (!Permission::where('name', $permission)->exists()) {
                Permission::create(['name' => $permission]);
            }
        }
    }
}
