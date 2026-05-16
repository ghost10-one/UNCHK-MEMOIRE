<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create roles
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $manager = Role::firstOrCreate(['name' => 'manager']);
        $delegue = Role::firstOrCreate(['name' => 'delegue']);
        $praticien = Role::firstOrCreate(['name' => 'praticien']);

        // Define permissions
        $permissions = [
            // User & System
            'manage users',
            'manage roles',
            'access dashboard',
            
            // Medical Data
            'manage doctors',
            'manage establishments',
            
            // Visits & Reports
            'plan visits',
            'edit visits',
            'delete visits',
            'write reports',
            'view reports',
            'validate reports',
            
            // Analytics & Marketing
            'view analytics',
            'manage campaigns',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Assign permissions
        $admin->syncPermissions(Permission::all());

        $manager->syncPermissions([
            'access dashboard',
            'manage doctors',
            'manage establishments',
            'plan visits',
            'view reports',
            'validate reports',
            'view analytics',
            'manage campaigns',
        ]);

        $delegue->syncPermissions([
            'access dashboard',
            'plan visits',
            'edit visits',
            'write reports',
            'view reports',
        ]);

        $praticien->syncPermissions([
            'access dashboard',
            'view reports',
        ]);
    }
}