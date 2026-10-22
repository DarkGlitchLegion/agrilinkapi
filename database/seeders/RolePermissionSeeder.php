<?php

namespace Database\Seeders;

use App\Models\Identity\Permission;
use App\Models\Identity\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['name' => 'Administrator', 'slug' => 'admin', 'description' => 'Development administrator role.'],
            ['name' => 'Farmer', 'slug' => 'farmer', 'description' => 'Manages farms and product listings.'],
            ['name' => 'Buyer', 'slug' => 'buyer', 'description' => 'Browses products and places orders.'],
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(['slug' => $role['slug']], $role);
        }

        $permissions = [
            ['name' => 'Manage Users', 'slug' => 'manage-users', 'description' => 'Manage user accounts.'],
            ['name' => 'Manage Roles', 'slug' => 'manage-roles', 'description' => 'Manage roles and permissions.'],
            ['name' => 'Manage Products', 'slug' => 'manage-products', 'description' => 'Moderate commodities and listings.'],
            ['name' => 'Create Listing', 'slug' => 'create-listing', 'description' => 'Create and manage farm listings.'],
            ['name' => 'Manage Farm', 'slug' => 'manage-farm', 'description' => 'Manage farms, members, and crops.'],
            ['name' => 'Place Order', 'slug' => 'place-order', 'description' => 'Submit product inquiries and orders.'],
            ['name' => 'Manage Content', 'slug' => 'manage-content', 'description' => 'Manage knowledge and assistance content.'],
            ['name' => 'Manage Market Data', 'slug' => 'manage-market-data', 'description' => 'Manage market prices and imports.'],
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(['slug' => $permission['slug']], $permission);
        }

        $permissionIdsBySlug = Permission::query()->pluck('id', 'slug');
        $roleIdsBySlug = Role::query()->pluck('id', 'slug');

        $permissionsByRole = [
            'admin' => array_keys($permissionIdsBySlug->all()),
            'farmer' => ['create-listing', 'manage-farm'],
            'buyer' => ['place-order'],
        ];

        foreach ($permissionsByRole as $roleSlug => $permissionSlugs) {
            foreach ($permissionSlugs as $permissionSlug) {
                DB::table('permission_role')->updateOrInsert(
                    [
                        'role_id' => $roleIdsBySlug[$roleSlug],
                        'permission_id' => $permissionIdsBySlug[$permissionSlug],
                    ]
                );
            }
        }
    }
}
