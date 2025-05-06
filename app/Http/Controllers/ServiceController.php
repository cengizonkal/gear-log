<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceRequest;
use App\Http\Resources\ServiceResource;
use App\Models\Service;
class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::with(['vehicle', 'user','status'])->get();;
        return ServiceResource::collection($services);
    }

    public function store(ServiceRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;
        $service = Service::create($data);
        return new ServiceResource($service);
    }

    public function show(Service $service)
    {
        return new ServiceResource($service->load(['items','user.company','vehicle','status']));
    }

    public function update(ServiceRequest $request, Service $service)
    {
        $service->update($request->validated());
        return new ServiceResource($service->load(['vehicle', 'user.company','status']));
    }

    public function delete(Service $service)
    {
        $service->delete();
        return response()->json(['message' => 'Servis başarıyla silindi.']);
    }
}
