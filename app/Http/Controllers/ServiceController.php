<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceRequest;
use App\Http\Resources\ServiceResource;
use App\Models\Service;
class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::with(['vehicle', 'user'])->get();;
        return ServiceResource::collection($services);
    }

    public function store(ServiceRequest $request)
    {
        $service = Service::create($request->validated());
        return new ServiceResource($service);
    }

    public function show(Service $service)
    {
        return new ServiceResource($service->load(['items','user']));
    }

    public function update(ServiceRequest $request, Service $service)
    {
        $service->update($request->validated());
        return new ServiceResource($service->load(['vehicle', 'user']));
    }

    public function delete(Service $service)
    {
        $service->delete();
        return response()->json(['message' => 'Servis başarıyla silindi.']);
    }
}
