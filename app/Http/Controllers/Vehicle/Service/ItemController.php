<?php

namespace App\Http\Controllers\Vehicle\Service;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddItemToServiceRequest;
use App\Http\Resources\ItemResource;
use App\Models\Vehicle;
use App\Models\Service;
use Illuminate\Http\Request;
use Dedoc\Scramble\Attributes\Group;

#[Group('Vehicle\Service\Item')]
class ItemController extends Controller
{
    public function index(Vehicle $vehicle, Service $service)
    {
        return ItemResource::collection($service->items);
    }

    public function store(Vehicle $vehicle, Service $service, AddItemToServiceRequest $request)
    {
        $item = $service->items()->attach($request->item_id, [
            'quantity' => $request->quantity,
            'price' => $request->price,     
        ]);

        return response()->json([
            'message' => 'Ürün servise eklendi.',
        ]);
    }
}
