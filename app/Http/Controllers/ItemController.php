<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemRequest;
use App\Http\Resources\ItemResource;
use App\Models\Company;
use App\Models\Item;
use Illuminate\Http\JsonResponse;

class ItemController extends Controller
{
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
        if ($item->company_id !== $company->id) {
            return response()->json(['message' => 'Bu ürün bu şirkete ait değil.'], 403);
        }
        return new ItemResource($item->load('company'));
    }

    public function update(ItemRequest $request, Item $item, Company $company)
    {
        if ($item->company_id !== $company->id) {
            return response()->json(['message' => 'Bu ürün bu şirkete ait değil.'], 403);
        }

        $item->update($request->validated());
        return new ItemResource($item->load('company'));
    }

    public function delete(Item $item, Company $company)
    {
        if ($item->company_id !== $company->id) {
            return response()->json(['message' => 'Bu ürün bu şirkete ait değil.'], 403);
        }
        $item->delete();
        return response()->json(['message' => 'Ürün başarıyla silindi.'], 200);
    }
}
