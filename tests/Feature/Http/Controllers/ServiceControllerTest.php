<?php

namespace Tests\Feature\Http\Controllers;

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
    
}
