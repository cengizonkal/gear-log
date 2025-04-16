<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemRequest;
use App\Http\Resources\ItemResource;
use App\Models\Item;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all();
        return ItemResource::collection($items);
    }

    public function store(ItemRequest $request)
    {
        $item = Item::create($request->validated());
        return new ItemResource($item);
    }

    public function show(Item $item)
    {
        return new ItemResource($item->load('company'));
    }

    public function update(ItemRequest $request, Item $item)
    {
        $item->update($request->validated());
        return new ItemResource($item->load('company'));
    }

    public function delete(Item $item)
    {
        $item->delete();
        return response()->json(['message' => 'Ürün başarıyla silindi.'], 200);
    }
}
