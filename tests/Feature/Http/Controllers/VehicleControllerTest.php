<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VehicleControllerTest extends LoggedIn
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
}
