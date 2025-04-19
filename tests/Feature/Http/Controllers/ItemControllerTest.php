<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Company;
use App\Models\Item;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ItemControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;
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
                'default_price',
            ]
        ]);
    }

    public function test_user_can_update_their_own_item(): void
    {
        $this->withoutExceptionHandling();
        $company = Company::factory()->create();

        $item = Item::factory()->create(['company_id' => $company->id]);

        $user = User::factory()->create(['company_id' => $company->id]);
        $this->actingAs($user);

        $itemData = [
            'name' => 'Updated Item',
            'description' => 'Updated Description',
            'default_price' => 100.00,
            'company_id' => $company->id,
        ];

        $response = $this->putJson(route('companies.items.update', ['company' => $company->id, 'item' => $item->id]), $itemData);

        $response->assertOk()->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'description',
                'default_price',
            ]
        ]);
    }

    public function test_user_cannot_update_another_companies_item(): void
    {
        $company = Company::factory()->create();
        $anotherCompany = Company::factory()->create();

        $user = User::factory()->create(['company_id' => $company->id]);
        $this->actingAs($user);

        $item = Item::factory()->create(['company_id' => $anotherCompany->id]);

        $response = $this->putJson(route('companies.items.update', [
            'company' => $anotherCompany->id,
            'item' => $item->id,
        ]), [
            'name' => 'Updated Item',
            'description' => 'Updated Description',
            'default_price' => 100.00,
        ]);
        $response->assertForbidden();

    }

    public function test_user_can_delete_their_own_item(): void
    {
        $this->withoutExceptionHandling();
        $company = Company::factory()->create();

        $item = Item::factory()->for($company)->create();

        $user = User::factory()->create(['company_id' => $company->id]);
        $this->actingAs($user);


        $response = $this->deleteJson(route('companies.items.delete', [
            'company' => $company->id,
            'item' => $item->id]
        ));

        $response->assertNoContent();
    }

    public function test_user_cannot_delete_another_users_item(): void
    {
        $company = Company::factory()->create();
        $user = User::factory()->create(['company_id' => $company->id]);

        $this->actingAs($user);

        $anotherCompany = Company::factory()->create();
        $anotherItem = Item::factory()->for($anotherCompany)->create();

        $response = $this->deleteJson(route('companies.items.delete', [
            'company' => $company->id,
            'item' => $anotherItem->id
        ]));

        $response->assertForbidden();
    }
}
