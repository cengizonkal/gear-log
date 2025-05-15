<?php

namespace App\Http\Controllers\Vehicle;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Resources\ServiceResource;
use App\Models\Vehicle;
use App\Models\Service;
use Dedoc\Scramble\Attributes\Group;
use Illuminate\Http\Request;

#[Group('Vehicle\Service')]
class ServiceController extends Controller
{
    public function index(Vehicle $vehicle)
    {
        return ServiceResource::collection($vehicle->services()->with('status')->get());
    }

    public function show(Vehicle $vehicle, Service $service)
    {
        return new ServiceResource($service->load(['items', 'user.company', 'vehicle', 'status']));
    }

    public function store(Vehicle $vehicle, StoreServiceRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;
        $service = Service::create($data);
        $vehicle->services()->save($service);
        return new ServiceResource($service);
    }

}
