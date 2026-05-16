<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

uses(RefreshDatabase::class);

test('admin can access admin dashboard', function () {
    $admin = User::factory()->create();
    // Re-seed roles for testing as RefreshDatabase wipes them
    $adminRole = Role::firstOrCreate(['name' => 'admin']);
    $admin->assignRole('admin');

    $this->actingAs($admin)
        ->get(route('admin.dashboard'))
        ->assertStatus(200);
});

test('manager cannot access admin dashboard', function () {
    $manager = User::factory()->create();
    Role::firstOrCreate(['name' => 'admin']);
    $managerRole = Role::firstOrCreate(['name' => 'manager']);
    $manager->assignRole('manager');

    $this->actingAs($manager)
        ->get(route('admin.dashboard'))
        ->assertStatus(403);
});

test('manager can access manager dashboard', function () {
    $manager = User::factory()->create();
    $managerRole = Role::firstOrCreate(['name' => 'manager']);
    $manager->assignRole('manager');

    $this->actingAs($manager)
        ->get(route('manager.dashboard'))
        ->assertStatus(200);
});
