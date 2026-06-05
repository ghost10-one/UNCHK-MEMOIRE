<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $zones = [
            ['name' => 'Dakar', 'region' => 'Dakar', 'postal_code' => '10000'],
            ['name' => 'Thiès', 'region' => 'Thiès', 'postal_code' => '21000'],
            ['name' => 'Diourbel', 'region' => 'Diourbel', 'postal_code' => '31000'],
            ['name' => 'Saint-Louis', 'region' => 'Saint-Louis', 'postal_code' => '32000'],
            ['name' => 'Kaolack', 'region' => 'Kaolack', 'postal_code' => '39000'],
        ];

        foreach ($zones as $zone) {
            \App\Models\Zone::firstOrCreate($zone);
        }
    }
}
