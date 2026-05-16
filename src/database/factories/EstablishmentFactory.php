<?php

namespace Database\Factories;

use App\Models\Establishment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Establishment>
 */
class EstablishmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company() . ' ' . $this->faker->randomElement(['Hôpital', 'Clinique', 'Centre Médical']),
            'type' => $this->faker->randomElement(['Hôpital', 'Clinique', 'Cabinet']),
            'city' => $this->faker->city(),
        ];
    }
}
