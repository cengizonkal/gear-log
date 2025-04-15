<?php

namespace App\Http\Controllers;

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
}
