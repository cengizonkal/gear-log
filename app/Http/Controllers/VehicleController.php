<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVehicleRequest;
use App\Http\Requests\UpdateVehicleRequest;
use App\Http\Resources\VehicleResource;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Http\Resources\VehicleWithDetailsResource;

class VehicleController extends Controller
{
    /**
     * Display the specified vehicle with its details.
     */
    public function show(Vehicle $vehicle)
    {
        return new VehicleWithDetailsResource($vehicle->load(['vehicleModel.brand', 'owner', 'fuelType']));
    }

    public function store(StoreVehicleRequest $request)
    {
        $vehicle = Vehicle::create($request->all());

        return response()
            ->json([
                'message' => 'Araç başarıyla eklendi.',
                'vehicle' => new VehicleResource($vehicle),
            ]);
    }

    public function update(UpdateVehicleRequest $request, Vehicle $vehicle)
    {
        $vehicle->update($request->all());

        return response()
            ->json([
                'message' => 'Araç başarıyla güncellendi.',
                'vehicle' => new VehicleResource($vehicle),
            ]);
    }
}
