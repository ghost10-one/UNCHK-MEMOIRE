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
            User::ROLE_ADMIN => 'Administrateur',
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

            // Doctors & Establishments
            'view_doctors' => 'View Doctors',
            'manage_doctors' => 'Manage Doctors',
            'manage_establishments' => 'Manage Establishments',

            // Visits
            'view_visits' => 'View Visits',
            'create_visits' => 'Create Visits',
            'edit_visits' => 'Edit Visits',
            'delete_visits' => 'Delete Visits',

            // Reports
            'view_reports' => 'View Reports',
            'create_reports' => 'Create Reports',
            'validate_reports' => 'Validate Reports',

            // Campaigns
            'manage_campaigns' => 'Manage Campaigns',

            // Analytics
            'view_analytics' => 'View Analytics',

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
            'create_reports',
            'view_reports',
        ]);

        $managerRole = Role::findByName(User::ROLE_MANAGER, $guardName);
        $managerRole->syncPermissions([
            'view_users',
            'create_users',
            'edit_users',
            'manage_doctors',
            'manage_establishments',
            'view_visits',
            'create_visits',
            'edit_visits',
            'delete_visits',
            'view_reports',
            'create_reports',
            'validate_reports',
            'manage_campaigns',
            'view_analytics',
            'view_audit_logs',
        ]);

        $proSanteRole = Role::findByName(User::ROLE_PRO_SANTÉ, $guardName);
        $proSanteRole->syncPermissions([
            'view_reports',
        ]);

        $adminRole = Role::findByName(User::ROLE_ADMIN, $guardName);
        $adminRole->syncPermissions(Permission::all());

        // Create admin user
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@medical.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('admin123'),
                'phone' => '+33612345678',
                'role' => User::ROLE_ADMIN,
                'is_active' => true,
            ]
        );

        $adminUser->assignRole(User::ROLE_ADMIN);
        

        // Create 2 managers
        for ($i = 1; $i <= 2; $i++) {
            $this->createTestUser("manager{$i}@medical.com", "Manager User {$i}", User::ROLE_MANAGER);
        }

        // Create 3 delegues
        for ($i = 1; $i <= 3; $i++) {
            $this->createTestUser("delegate{$i}@medical.com", "Delegate User {$i}", User::ROLE_DELEGATE, $i);
        }

        // Create 5 praticiens
        for ($i = 1; $i <= 5; $i++) {
            $this->createTestUser("pro{$i}@medical.com", "Pro Santé User {$i}", User::ROLE_PRO_SANTÉ, ($i % 5) + 1);
        }
    }

    private function createTestUser(string $email, string $name, string $role, ?int $zoneId = null): void
    {
        $user = User::firstOrCreate(
            ['email' => $email],
            [
                'name' => $name,
                'password' => Hash::make('password123'),
                'phone' => '+33612345678',
                'role' => $role,
                'is_active' => true,
                'zone_id' => $zoneId,
                'registration_number' => 'MAT-' . rand(1000, 9999),
            ]
        );
        
        $user->assignRole($role);
    }
}
