<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'vehicle_model_id' => \App\Models\VehicleModel::factory(),
            'license_plate' => $this->faker->unique()->bothify('??###?'),
            'mileage' => $this->faker->numberBetween(0, 200000),
            'owner_id' => \App\Models\Owner::factory(),
            'fuel_type_id' => \App\Models\FuelType::factory(),
            'vin' => $this->faker->unique()->bothify('1HGCM82633A#######'),
            'year' => $this->faker->year(),
            'engine_capacity' => $this->faker->numberBetween(1000, 5000),
            'weight' => $this->faker->numberBetween(1000, 3000),
        ];
    }
}
