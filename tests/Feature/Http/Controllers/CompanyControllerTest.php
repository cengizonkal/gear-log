<?php

namespace Tests\Feature\Http\Controllers;


use App\Models\Company;
use App\Models\Item;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CompanyControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;
    public function test_it_should_give_company_details_and_all_items(): void
    {
        $this->withoutExceptionHandling();
        $company = Company::factory()->create();

        $items = Item::factory()->count(3)->create(['company_id' => $company->id]);

        $user = User::factory()->create([
            'company_id' => $company->id,
        ]);
        $this->actingAs($user);

        $response = $this->getJson(route('companies.show', $company->id));
        $response->assertOk()->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'phone',
                'items' => [
                    '*' => [
                        'id',
                        'name',
                        'description',
                    ]
                ]
            ]
        ])->assertJsonCount(3, "data.items");
    }
}
