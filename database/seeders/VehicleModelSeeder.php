<?php

namespace Database\Seeders;

use App\Models\VehicleModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VehicleModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $carModels = [
            // BMW
            ['name' => '3 Series', 'brand_id' => 2, 'year' => 2021, 'engine' => 2000],
            ['name' => '5 Series', 'brand_id' => 2, 'year' => 2021, 'engine' => 2000],
            ['name' => 'X3', 'brand_id' => 2, 'year' => 2021, 'engine' => 2000],
            ['name' => 'X5', 'brand_id' => 2, 'year' => 2021, 'engine' => 2000],
            ['name' => 'Z4', 'brand_id' => 2, 'year' => 2021, 'engine' => 2000],

            // Mercedes
            ['name' => 'A-Class', 'brand_id' => 19, 'year' => 2021, 'engine' => 2000],
            ['name' => 'C-Class', 'brand_id' => 19, 'year' => 2021, 'engine' => 2000],
            ['name' => 'E-Class', 'brand_id' => 19, 'year' => 2021, 'engine' => 2000],
            ['name' => 'GLC', 'brand_id' => 19, 'year' => 2021, 'engine' => 2000],
            ['name' => 'GLE', 'brand_id' => 19, 'year' => 2021, 'engine' => 2000],

            // Toyota
            ['name' => 'Corolla', 'brand_id' => 33, 'year' => 2021, 'engine' => 2000],
            ['name' => 'Camry', 'brand_id' => 33, 'year' => 2021, 'engine' => 2000],
            ['name' => 'RAV4', 'brand_id' => 33, 'year' => 2021, 'engine' => 2000],
            ['name' => 'Hilux', 'brand_id' => 33, 'year' => 2021, 'engine' => 2000],
            ['name' => 'Yaris', 'brand_id' => 33, 'year' => 2021, 'engine' => 2000],
        ];

        foreach ($carModels as $model) {
            VehicleModel::create([
                'name' => $model['name'],
                'brand_id' => $model['brand_id'],
            ]);
        }
    }
}
