<?php

namespace Database\Seeders;

use App\Models\FuelType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FuelTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fuelTypes = [
            'Benzin',
            'Diesel',
            'Hibrit',
            'Elektrik',
        ];

        foreach ($fuelTypes as $type) {
            FuelType::create([
                'name' => $type,
            ]);
        }
    }
}
