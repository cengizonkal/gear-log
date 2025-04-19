<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemRequest;
use App\Http\Resources\ItemResource;
use App\Models\Company;
use App\Models\Item;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

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
        return new ItemResource($item);
    }

    public function show(Company $company, Item $item)
    {
        return new ItemResource($item->load('company'));
    }

    public function update(ItemRequest $request, Company $company, Item $item)
    {
        $item->update($request->validated());
        return new ItemResource($item->load('company'));
    }

    public function delete(Company $company, Item $item)
    {
        $this->authorize('delete', $item);
        $item->delete();
        return response()->noContent();
    }
}
