<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Company;
use App\Models\Item;
use App\Models\User;
use Tests\TestCase;

class ItemControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_it_should_give_item_details(): void
    {
        $this->withoutExceptionHandling();
        $company = Company::factory()->create();

        $item = Item::factory()->create(['company_id' => $company->id]);

        $user = User::factory()->create(['company_id' => $company->id]);
        $this->actingAs($user);

        $response = $this->getJson(route('companies.items.show', ['company' => $company->id, 'item' => $item->id]));


        $response->assertOk()->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'description',
                'price',
            ]
        ]);
    }
}
