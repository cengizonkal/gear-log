<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'vehicle_id' => \App\Models\Vehicle::factory(),
            'user_id' => \App\Models\User::factory(),
            'finished_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'started_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'status_id' => \App\Models\ServiceStatus::factory(),
        ];
    }
}
