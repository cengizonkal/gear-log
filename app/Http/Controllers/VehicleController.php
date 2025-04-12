<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Http\Resources\VehcileWithDetailsResource;

class VehicleController extends Controller
{
    public function show(Vehicle $vehicle)
    {
        return new VehcileWithDetailsResource($vehicle->load(['vehicleModel.brand', 'owner', 'fuelType']));
        
    }
}
