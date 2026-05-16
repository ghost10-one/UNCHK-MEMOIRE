<?php

namespace Database\Factories;

use App\Models\Doctor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Doctor>
 */
class DoctorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'specialty' => $this->faker->randomElement(['Cardiologie', 'Pédiatrie', 'Généraliste', 'Dermatologie']),
            'establishment_id' => \App\Models\Establishment::factory(),
        ];
    }
}
