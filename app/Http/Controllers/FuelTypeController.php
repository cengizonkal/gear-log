<?php

namespace App\Http\Controllers;

use App\Http\Resources\FuelTypeResource;
use App\Models\FuelType;
use Illuminate\Http\Request;

class FuelTypeController extends Controller
{
    public function index()
    {
        $fuelTypes = FuelType::all();
        return FuelTypeResource::collection($fuelTypes);
    }
}
