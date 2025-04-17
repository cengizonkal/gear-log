<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Brand;
use App\Models\FuelType;
use App\Models\Owner;
use App\Models\User;
use App\Models\Vehicle;
use Tests\TestCase;

class OwnerControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function owner_can_created_with_valid_data(): void
    {
        $this->withoutExceptionHandling();

        $vehicle = Vehicle::factory()->create();

        $user = User::factory()->create();
        $this->actingAs($user);

        $ownerData = [
            'name' => 'JohnDoe',
            'phone' => '1234567890',
            'email' => 'test@test.com',
        ];

        $response = $this->postJson(route('owners.store'), $ownerData);

        $response->assertCreated()->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'phone',
                'email',
            ]
        ]);
    }

    public function owner_can_have_multiple_vehicles(): void
    {
        $this->withoutExceptionHandling();

        $owner = Owner::factory()->create();
        $brand = Brand::factory()->create();
        $fuelType = FuelType::factory()->create();

        $vehicles = Vehicle::factory(3)->create([
            'owner_id' => $owner->id,
            'brand_id' => $brand->id,
            'fuel_type_id' => $fuelType->id,
        ]);

        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->getJson(route('owners.show', $owner->id));
        $response->assertOk()->assertJsonStructure([
           'data' => [
               'id',
               'name',
               'phone',
               'email',
               'vehicles' => [
                   '*' => [
                       'id',
                       'vehicle_model_id',
                       'license_plate',
                       'mileage',
                       'owner_id',
                       'fuel_type_id',
                       'vin',
                   ]
               ]
           ]
        ]);

        $this->assertCount(3, $response->json('data.vehicles'));

    }
}
