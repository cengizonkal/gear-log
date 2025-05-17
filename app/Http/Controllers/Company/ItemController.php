<?php

namespace App\Http\Controllers\Company;
use App\Http\Controllers\Controller;

use App\Http\Requests\ItemRequest;
use App\Http\Resources\ItemResource;
use App\Models\Company;
use App\Models\Item;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Dedoc\Scramble\Attributes\Group;

#[Group('Company\Item')]
class ItemController extends Controller
{
    use AuthorizesRequests;
    public function index(Company $company)
    {
        $items = $company->items()->get();
        return ItemResource::collection($items);
    }

    public function store(ItemRequest $request, Company $company)
    {
        $item = $company->items()->create($request->validated());
        return response()
            ->json([
                'message' => 'Başarıyla eklendi',
                'item' => new ItemResource($item->load('company')),
            ]);
    }

    public function show(Company $company, Item $item)
    {
        return new ItemResource($item->load('company'));
    }

    public function update(ItemRequest $request, Company $company, Item $item)
    {
        $item->update($request->validated());
        return response()
            ->json([
                'message' => 'Başarıyla güncellendi.',
                'item' => new ItemResource($item->load('company')),
            ]);
    }

    public function delete(Company $company, Item $item)
    {
        $this->authorize('delete', $item);
        $item->delete();
        return response()
            ->json([
                'message' => 'Başarıyla silindi.',
            ]);
    }
}
