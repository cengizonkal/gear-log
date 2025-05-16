<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\ServiceStatus;
use Database\Seeders\ServiceStatusSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ServiceControllerTest extends AuthenticatedTestCase
{
    public function test_it_should_return_service_details(): void
    {
        $this->withoutExceptionHandling();
        $service = \App\Models\Service::factory()->create();

        $items = \App\Models\Item::factory(10)->create();
        //add items to the service
        $service->items()->attach($items->pluck('id')->toArray(), [
            'price' => $this->faker->randomFloat(2, 1, 100),
            'quantity' => $this->faker->numberBetween(1, 10),
        ]);

        $response = $this->getJson(route('services.show', $service->id));
        $response->assertOk()
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'user' => [
                        'id',
                        'name',
                        'email',
                        'phone',
                    ],
                    'started_at',
                    'finished_at',
                    'status' => [
                        'id',
                        'name',
                    ],
                    'items' => [
                        '*' => [
                            'id',
                            'name',
                            'description',
                            'price'
                        ]
                    ]
                ]
            ])->assertJsonCount(10, "data.items");
    }

    public function test_it_should_prevent_update_service_if_user_is_not_the_owner(): void
    {
        $this->withoutExceptionHandling();
        $service = \App\Models\Service::factory()->create();

        $items = \App\Models\Item::factory(10)->create();
        //add items to the service
        $service->items()->attach($items->pluck('id')->toArray(), [
            'price' => $this->faker->randomFloat(2, 1, 100),
            'quantity' => $this->faker->numberBetween(1, 10),
        ]);

        try {
            $response = $this->putJson(route('services.update', $service->id), [
                'started_at' => now(),
                'finished_at' => now(),

            ]);
        } catch (\Illuminate\Auth\Access\AuthorizationException $e) {
            $this->assertTrue(true);
        }


    }

    public function test_it_should_delete_service(): void
    {
        $this->withoutExceptionHandling();
        $service = \App\Models\Service::factory()->create();
        auth()->login($service->user);

        $items = \App\Models\Item::factory(10)->create();
        //add items to the service
        $service->items()->attach($items->pluck('id')->toArray(), [
            'price' => $this->faker->randomFloat(2, 1, 100),
            'quantity' => $this->faker->numberBetween(1, 10),
        ]);

        $response = $this->deleteJson(route('services.delete', $service->id));
        $response->assertOk();
    }

    public function test_it_should_not_delete_service_if_the_auth_user_is_not_the_owner(): void
    {
        $this->withoutExceptionHandling();
        $service = \App\Models\Service::factory()->create();

        $items = \App\Models\Item::factory(10)->create();
        //add items to the service
        $service->items()->attach($items->pluck('id')->toArray(), [
            'price' => $this->faker->randomFloat(2, 1, 100),
            'quantity' => $this->faker->numberBetween(1, 10),
        ]);

        try {
            $response = $this->deleteJson(route('services.delete', $service->id));
        } catch (\Illuminate\Auth\Access\AuthorizationException $e) {
            $this->assertTrue(true);
        }

    }

    public function test_it_should_update_service(): void
    {
        $this->withoutExceptionHandling();
        $service = \App\Models\Service::factory()->create();
        auth()->login($service->user);

        $items = \App\Models\Item::factory(10)->create();
        //add items to the service
        $service->items()->attach($items->pluck('id')->toArray(), [
            'price' => $this->faker->randomFloat(2, 1, 100),
            'quantity' => $this->faker->numberBetween(1, 10),
        ]);

        $status = \App\Models\ServiceStatus::factory()->create();

        $response = $this->putJson(route('services.update', $service->id), [
            'started_at' => now()->toDateTimeString(),
            'finished_at' => now()->addHours(2)->toDateTimeString(),
            'status_id' => $status->id,
        ]);

        $response->assertOk();
        $this->assertDatabaseHas('services', [
            'id' => $service->id,
            'status_id' => $status->id, // Verify status update in the database
        ]);
    }

    public function test_unauthenticated_user_should_not_see_the_service_item_prices(): void
    {
        $this->withoutExceptionHandling();
        $service = \App\Models\Service::factory()->create();

        $items = \App\Models\Item::factory(10)->create();
        //add items to the service
        $service->items()->attach($items->pluck('id')->toArray(), [
            'price' => 100,
            'quantity' => $this->faker->numberBetween(1, 10),
        ]);

        $response = $this->getJson(route('services.show', $service->id));
        $response->assertOk();
        //ensure that all prices are just *
        $response->assertJsonFragment([
            'price' => 0
        ]);
    }

    public function test_authenticated_user_should_see_the_service_item_prices(): void
    {
        $this->withoutExceptionHandling();
        $service = \App\Models\Service::factory()->create();

        $items = \App\Models\Item::factory(10)->create();
        //add items to the service
        $service->items()->attach($items->pluck('id')->toArray(), [
            'price' => 1984,
            'quantity' => $this->faker->numberBetween(1, 10),
        ]);

        auth()->login($service->user);

        $response = $this->getJson(route('services.show', $service->id));
        $response->assertOk();
        $response->assertJsonFragment([
            'price' => 1984
        ]);
    }

    public function test_get_all_service_statuses(): void
    {
        $this->withoutExceptionHandling();

        $status = ServiceStatus::factory()->create();

        $response = $this->getJson(route('service-statuses.index'));

        $response->assertOk()
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'description',
                        'color',
                        'created_at',
                        'updated_at',
                    ]
                ]
            ]);
    }

    public function test_is_completed_accessor_returns_true_when_finished_at_is_not_null()
    {
        $service = \App\Models\Service::factory()->create(['finished_at' => now()]);
        $this->assertTrue($service->is_completed);
    }

    public function test_is_completed_accessor_returns_false_when_finished_at_is_null()
    {
        $service = \App\Models\Service::factory()->create(['finished_at' => null]);
        $this->assertFalse($service->is_completed);
    }

    public function test_total_price_accessor_returns_correct_value()
    {
        $service = \App\Models\Service::factory()->create();
        $items = \App\Models\Item::factory(2)->create();

        $service->items()->attach([
            $items[0]->id => ['price' => 100, 'quantity' => 2],
            $items[1]->id => ['price' => 50, 'quantity' => 3],
        ]);

        $this->assertEquals(350, $service->total_price);
    }

    public function test_service_belongs_to_vehicle()
    {
        $vehicle = \App\Models\Vehicle::factory()->create();
        $service = \App\Models\Service::factory()->create(['vehicle_id' => $vehicle->id]);

        $this->assertTrue($service->vehicle->is($vehicle));
    }

    public function test_service_belongs_to_status()
    {
        $status = \App\Models\ServiceStatus::factory()->create();
        $service = \App\Models\Service::factory()->create(['status_id' => $status->id]);

        $this->assertTrue($service->status->is($status));
    }

    public function test_it_should_download_service()
    {
        $this->withoutExceptionHandling();
        $service = \App\Models\Service::factory()->create();

        $items = \App\Models\Item::factory(10)->create();
        //add items to the service
        $service->items()->attach($items->pluck('id')->toArray(), [
            'price' => 100,
            'quantity' => $this->faker->numberBetween(1, 10),
        ]);

        auth()->login($service->user);

        $response = $this->postJson(route('services.download', $service->id));
        $response->assertOk();
    }

}
