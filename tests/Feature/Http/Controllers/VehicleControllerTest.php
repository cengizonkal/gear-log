<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\FuelType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VehicleControllerTest extends AuthenticatedTestCase
{
    use RefreshDatabase, WithFaker;


    public function test_it_should_give_vehicle_with_details(): void
    {
        $this->withoutExceptionHandling();
        $vehicle = \App\Models\Vehicle::factory()->create();
        //add services to the vehicle
        $vehicle->services()->saveMany(\App\Models\Service::factory(10)->create([
            'vehicle_id' => $vehicle->id,
        ]));

        $response = $this->getJson(route('vehicles.show', $vehicle->license_plate));
        $response->assertOk()
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'license_plate',
                    'fuel_type',
                    'vehicle_model',
                    'brand',
                    'owner' => [
                        'id',
                        'name',
                        'email',
                        'phone'
                    ],
                    'vin',
                    'mileage',
                    'services' => [
                        '*' => [
                            'id',
                            'user' => [
                                'id',
                                'name',
                                'email',
                                'phone',
                                'company' => [
                                    'id',
                                    'name',
                                    'phone'
                                ]
                            ],
                            'started_at',
                            'finished_at'
                        ]
                    ]
                ]
            ])->assertJsonCount(3, "data.services");


    }

    public function test_it_should_show_all_fuel_types(): void
    {
        $this->withoutExceptionHandling();
        FuelType::factory(5)->create();

        $response = $this->getJson(route('fuel-types.index'));
        $response->assertOk()
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                    ]
                ]
            ]);
    }

    public function test_it_should_create_vehicle(): void
    {
        $this->withoutExceptionHandling();
        $vehicle = \App\Models\Vehicle::factory()->make();
        $response = $this->postJson(route('vehicles.store'), [
            'license_plate' => $vehicle->license_plate,
            'mileage' => $vehicle->mileage,
            'owner_id' => $vehicle->owner_id,
            'fuel_type_id' => $vehicle->fuel_type_id,
            'vin' => $vehicle->vin,
            'vehicle_model_id' => $vehicle->vehicle_model_id,
        ]);
        $response->assertOk()
            ->assertJsonStructure([
                'message',
                'vehicle' => [
                    'id',
                    'license_plate',
                    'fuel_type',
                    'vehicle_model',
                    'brand',
                    'vin',
                    'mileage'
                ]
            ]);
    }

    public function test_it_should_update_vehicle(): void
    {
        $this->withoutExceptionHandling();
        $vehicle = \App\Models\Vehicle::factory()->create();
        $response = $this->putJson(route('vehicles.update', $vehicle->license_plate), [
            'license_plate' => 'ABC1234',
            'mileage' => 10000,
            'owner_id' => $vehicle->owner_id,
            'fuel_type_id' => $vehicle->fuel_type_id,
            'vin' => $vehicle->vin.'1',
            'vehicle_model_id' => $vehicle->vehicle_model_id,
            'year' => 2020,
            'engine_capacity' => 2000,
            'weight' => 1500,
        ]);
        $response->assertOk()
            ->assertJsonStructure([
                'message',
                'vehicle' => [
                    'id',
                    'license_plate',
                    'fuel_type',
                    'vehicle_model',
                    'brand',
                    'vin',
                    'mileage',
                    'year',
                    'engine_capacity',
                    'weight'
                ]
            ])
            ->assertJson([
                'vehicle' => [
                    'license_plate' => 'ABC1234',
                    'mileage' => 10000,
                    'vin' => $vehicle->vin.'1',
                    'year' => 2020,
                    'engine_capacity' => 2000,
                    'weight' => 1500,
                ]
            ]);
    }

    public function test_it_should_search_vehicle_by_license_plate(): void
    {
        $this->withoutExceptionHandling();
        $vehicle = \App\Models\Vehicle::factory()->create();
        $response = $this->getJson(route('vehicles.search', [
            'plate' => $vehicle->license_plate,
        ]));
        $response->assertOk()
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'license_plate',
                        'fuel_type',
                        'vehicle_model',
                        'brand',
                        'vin',
                        'mileage'
                    ]
                ]
            ]);
    }

}
