<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Use 'web' guard to match User model default
        $guardName = 'web';

        // Define roles
        $roles = [
            User::ROLE_DELEGATE => 'Délégué Médical',
            User::ROLE_MANAGER => 'Manager',
            User::ROLE_PRO_SANTÉ => 'Professionnel de Santé',
        ];

        foreach ($roles as $roleKey => $roleLabel) {
            Role::firstOrCreate(
                ['name' => $roleKey, 'guard_name' => $guardName],
                ['guard_name' => $guardName]
            );
        }

        // Define permissions
        $permissions = [
            // User management
            'view_users' => 'View Users',
            'create_users' => 'Create Users',
            'edit_users' => 'Edit Users',
            'delete_users' => 'Delete Users',

            // Visits
            'view_visits' => 'View Visits',
            'create_visits' => 'Create Visits',
            'edit_visits' => 'Edit Visits',
            'delete_visits' => 'Delete Visits',

            // Reports
            'view_reports' => 'View Reports',
            'create_reports' => 'Create Reports',

            // System
            'view_audit_logs' => 'View Audit Logs',
            'manage_settings' => 'Manage Settings',
        ];

        foreach ($permissions as $permissionKey => $permissionLabel) {
            Permission::firstOrCreate(
                ['name' => $permissionKey, 'guard_name' => $guardName],
                ['guard_name' => $guardName]
            );
        }

        // Assign permissions to roles
        $delegateRole = Role::findByName(User::ROLE_DELEGATE, $guardName);
        $delegateRole->syncPermissions([
            'view_visits',
            'create_visits',
            'edit_visits',
        ]);

        $managerRole = Role::findByName(User::ROLE_MANAGER, $guardName);
        $managerRole->syncPermissions([
            'view_users',
            'create_users',
            'edit_users',
            'view_visits',
            'create_visits',
            'edit_visits',
            'delete_visits',
            'view_reports',
            'create_reports',
            'view_audit_logs',
        ]);

        $proSanteRole = Role::findByName(User::ROLE_PRO_SANTÉ, $guardName);
        $proSanteRole->syncPermissions([
            'view_visits',
            'create_visits',
            'edit_visits',
        ]);

        // Create admin user
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@medical.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('admin123'),
                'phone' => '+33612345678',
                'role' => User::ROLE_MANAGER,
                'is_active' => true,
            ]
        );

        $adminUser->assignRole(User::ROLE_MANAGER);

        // Create test users for each role
        $this->createTestUser('delegate@medical.com', 'Delegate User', User::ROLE_DELEGATE);
        $this->createTestUser('manager@medical.com', 'Manager User', User::ROLE_MANAGER);
        $this->createTestUser('pro@medical.com', 'Pro Santé User', User::ROLE_PRO_SANTÉ);
    }

    private function createTestUser(string $email, string $name, string $role): void
    {
        $user = User::firstOrCreate(
            ['email' => $email],
            [
                'name' => $name,
                'password' => Hash::make('password123'),
                'phone' => '+33612345678',
                'role' => $role,
                'is_active' => true,
            ]
        );
        
        $user->assignRole($role);
    }
}
