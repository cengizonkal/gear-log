<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $carBrands = [
            'Audi',
            'BMW',
            'Chevrolet',
            'Citroen',
            'Daihatsu',
            'Ferrari',
            'Fiat',
            'Ford',
            'Honda',
            'Hyundai',
            'Isuzu',
            'Jaguar',
            'Kia',
            'Lamborghini',
            'Lexus',
            'Maserati',
            'Mazda',
            'McLaren',
            'Mercedes-Benz',
            'MINI',
            'Mitsubishi',
            'Nissan',
            'Opel',
            'Peugeot',
            'Porsche',
            'Rolls-Royce',
            'Seat',
            'Skoda',
            'Smart',
            'Subaru',
            'Suzuki',
            'Tesla',
            'Toyota',
            'Volkswagen',
            'Volvo',
        ];

        foreach ($carBrands as $brand) {
            Brand::create([
                'name' => $brand,
            ]);
        }
    }
}
