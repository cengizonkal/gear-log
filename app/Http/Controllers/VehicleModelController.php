<?php

namespace App\Http\Controllers;

use App\Models\VehicleModel;
use Illuminate\Http\Request;
use App\Http\Resources\VehicleModelResource;

class VehicleModelController extends Controller
{
    public function index()
    {
        $models = VehicleModel::all();
        return VehicleModelResource::collection($models);
    }
}
