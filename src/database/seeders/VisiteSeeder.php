<?php

namespace Database\Seeders;

use App\Models\Praticien;
use App\Models\Establishment;
use App\Models\User;
use App\Models\Visite;
use Illuminate\Database\Seeder;

class VisiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::where('email', 'admin@medical.com')->first();
        if (!$admin) return;

        // Create some establishments and doctors (praticiens)
        $establishments = Establishment::factory(5)->create();
        
        foreach ($establishments as $est) {
            Praticien::factory(3)->create(['establishment_id' => $est->id]);
        }

        $praticiens = Praticien::all();

        // Create visits for the admin
        foreach ($praticiens as $praticien) {
            Visite::factory()->create([
                'delegue_id' => $admin->id,
                'praticien_id' => $praticien->id,
            ]);
        }
    }
}
