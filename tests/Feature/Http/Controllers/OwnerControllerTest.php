<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Brand;
use App\Models\FuelType;
use App\Models\Owner;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OwnerControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_owner_can_created_with_valid_data(): void
    {
        $this->withoutExceptionHandling();

        $vehicles = Vehicle::factory()->create();

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

    public function test_owner_can_have_multiple_vehicles(): void
    {
        $this->withoutExceptionHandling();

        $owner = Owner::factory()->create();
        $vehicleModel = VehicleModel::factory()->create();
        $fuelType = FuelType::factory()->create();


        $vehicles = Vehicle::factory()->count(3)->create([
            'owner_id' => $owner->id,
            'vehicle_model_id' => $vehicleModel->id,
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
            ]
        ]);

        $this->assertDatabaseCount('vehicles', 3);

        foreach ($vehicles as $vehicle) {
            $this->assertEquals($vehicle->owner_id, $owner->id);
        }

        $this->assertCount(3, $owner->vehicles);
    }

}
