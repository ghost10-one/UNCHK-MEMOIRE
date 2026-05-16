<?php

namespace Database\Factories;

use App\Models\Visit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Visit>
 */
class VisitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'doctor_id' => \App\Models\Doctor::factory(),
            'visit_date' => $this->faker->dateTimeBetween('-1 month', '+1 month')->format('Y-m-d'),
            'visit_time' => $this->faker->time('H:i'),
            'status' => $this->faker->randomElement(['planifiée', 'confirmée', 'réalisée', 'annulée']),
            'purpose' => $this->faker->sentence(),
        ];
    }
}
