<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VehicleModel>
 */
class VehicleModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'brand_id' => \App\Models\Brand::factory(),
            'year' => $this->faker->year(),
            'engine_capacity' => $this->faker->numberBetween(1000, 5000),
        ];
    }
}
