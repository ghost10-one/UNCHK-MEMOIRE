<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Establishment;
use App\Models\User;
use App\Models\Visit;
use Illuminate\Database\Seeder;

class VisitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::where('email', 'admin@medical.com')->first();
        if (!$admin) return;

        // Create some establishments and doctors
        $establishments = Establishment::factory(5)->create();
        
        foreach ($establishments as $est) {
            Doctor::factory(3)->create(['establishment_id' => $est->id]);
        }

        $doctors = Doctor::all();

        // Create visits for the admin
        foreach ($doctors as $doctor) {
            Visit::factory()->create([
                'user_id' => $admin->id,
                'doctor_id' => $doctor->id,
            ]);
        }
    }
}
