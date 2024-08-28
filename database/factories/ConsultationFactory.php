<?php

namespace Database\Factories;

use App\Models\Professional;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Consultation>
 */
class ConsultationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(), // Creates a user if one doesn’t exist
            'professional_id' => Professional::factory(), // Creates a professional if one doesn’t exist
            'date' => $this->faker->date(), // Random date
            'time' => $this->faker->time(), // Random time
            'status' => $this->faker->randomElement(['pending', 'completed', 'cancelled', 'scheduled']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
