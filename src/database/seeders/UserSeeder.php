<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin user
        $admin = User::updateOrCreate(
            ['email' => 'admin@medical.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'role' => User::ROLE_ADMIN,
                'is_active' => true,
            ]
        );
        $admin->syncRoles([User::ROLE_ADMIN]);

        // Manager user
        $manager = User::updateOrCreate(
            ['email' => 'manager@medical.com'],
            [
                'name' => 'Manager User',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'role' => User::ROLE_MANAGER,
                'is_active' => true,
            ]
        );
        $manager->syncRoles([User::ROLE_MANAGER]);

        // Delegate user
        $delegate = User::updateOrCreate(
            ['email' => 'delegue@medical.com'],
            [
                'name' => 'Delegate User',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'role' => User::ROLE_DELEGATE,
                'is_active' => true,
            ]
        );
        $delegate->syncRoles([User::ROLE_DELEGATE]);

        // Praticien / Pro Santé user
        $praticien = User::updateOrCreate(
            ['email' => 'praticien@medical.com'],
            [
                'name' => 'Praticien User',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'role' => User::ROLE_PRO_SANTÉ,
                'is_active' => true,
            ]
        );
        $praticien->syncRoles([User::ROLE_PRO_SANTÉ]);
    }
}
