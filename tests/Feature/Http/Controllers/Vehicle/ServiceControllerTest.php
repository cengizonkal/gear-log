<?php

namespace Tests\Feature\Http\Controllers\Vehicle;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Http\Controllers\AuthenticatedTestCase;

class ServiceControllerTest extends AuthenticatedTestCase
{
    use RefreshDatabase;
    public function test_it_should_get_all_services_of_a_vehicle(): void
    {
        $this->withoutExceptionHandling();
        $vehicle = \App\Models\Vehicle::factory()->create();
        $services = \App\Models\Service::factory(10)->create(['vehicle_id' => $vehicle->id]);
        $response = $this->getJson(route('vehicles.services.index', $vehicle->license_plate));
        $response->assertOk()
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'started_at',
                        'finished_at',
                    ]
                ]
            ])->assertJsonCount(10, "data");
    }
}
