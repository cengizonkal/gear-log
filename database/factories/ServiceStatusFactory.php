<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ServiceStatus>
 */
class ServiceStatusFactory extends Factory
{
    protected $model = \App\Models\ServiceStatus::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'color' => $this->faker->hexColor,
        ];
    }
}
