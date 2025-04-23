<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\Item;
use App\Models\Owner;
use App\Models\Service;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReportControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_user_can_see_own_company_services(): void
    {
        $this->withoutExceptionHandling();

        // user factory
        $company = Company::factory()->create();
        $user = User::factory()->create(['company_id' => $company->id]);
        $vehicle = Vehicle::factory()->create(['owner_id' => Owner::factory()->create()->id]);
        $items = Item::factory()->count(3)->create(['company_id' => $company->id]);

        // create services with items
        $this->createServicesWithItems($user, $vehicle, $items, 3);

        // another user factory
        $anotherCompany = Company::factory()->create();
        $anotherUser = User::factory()->create(['company_id' => $anotherCompany->id]);
        $anotherVehicle = Vehicle::factory()->create(['owner_id' => Owner::factory()->create()->id]);
        $otherItems = Item::factory()->count(3)->create(['company_id' => $anotherCompany->id]);

        // create services with items
        $this->createServicesWithItems($anotherUser, $anotherVehicle, $otherItems, 2);

        $this->actingAs($user);

        $response = $this->postJson(route('reports.generate'), [
            'started_at' => now()->subDays(30)->toDateString(),
            'finished_at' => now()->toDateString(),
        ]);

        $response->assertOk()->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'user' => [
                        'id', 'name', 'company_id',
                    ],
                    'vehicle' => [
                        'id', 'vehicle_model_id', 'license_plate',
                        'mileage', 'owner_id', 'fuel_type_id',
                    ],
                    'items' => [
                        '*' => [
                            'id', 'name', 'price',
                        ],
                    ],
                ],
            ],
        ]);
    }

    private function createServicesWithItems($user, $vehicle, $items, int $count): void
    {
        Service::factory()->count($count)->create([
            'user_id' => $user->id,
            'vehicle_id' => $vehicle->id,
        ])->each(function ($service) use ($items) {
            $service->items()->attach(
                $items->pluck('id')->toArray(),
                ['price' => 100.00, 'quantity' => 1]
            );
        });
    }

}
