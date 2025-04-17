<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Item;
use App\Models\User;
use App\Models\Owner;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        $this->call([
            BrandSeeder::class,
            FuelTypeSeeder::class,
            VehicleModelSeeder::class,
        ]);

        Owner::factory(10)->create();

        //create 10 vehicles with 5 services each
        \App\Models\Vehicle::factory(3)

            ->has(
                \App\Models\Service::factory(3)
                ->hasAttached(
                    Item::factory(2)
                    ->create([
                        'company_id' => 1,
                    ]),
                    [
                        'price' => 100,
                        'quantity' => 1,
                    ]
                )

            )
            ->create([
                'vehicle_model_id' => \App\Models\VehicleModel::first()->id,
                'fuel_type_id' => \App\Models\FuelType::first()->id,
                'owner_id' => Owner::first()->id,
            ]);


    }
}
