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
            ]
        );
        $admin->syncRoles(['admin']);

        // Manager user
        $manager = User::updateOrCreate(
            ['email' => 'manager@medical.com'],
            [
                'name' => 'Manager User',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        $manager->syncRoles(['manager']);

        // Delegue user
        $delegue = User::updateOrCreate(
            ['email' => 'delegue@medical.com'],
            [
                'name' => 'Delegue User',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        $delegue->syncRoles(['delegue']);
    }
}
