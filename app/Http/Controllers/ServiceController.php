<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Http\Resources\ServiceResource;
use App\Models\Service;
use Barryvdh\DomPDF\Facade\Pdf;

class ServiceController extends Controller
{
    public function index()
    {
        $services = auth()->user()->company->services()
            ->with(['items', 'user.company', 'vehicle', 'status'])
            ->latest()
            ->paginate(10);
        return ServiceResource::collection($services);
    }

    public function store(StoreServiceRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;
        $service = Service::create($data);
        return new ServiceResource($service);
    }

    public function show(Service $service)
    {
        return new ServiceResource($service->load(['items', 'user.company', 'vehicle', 'status']));
    }

    public function update(UpdateServiceRequest $request, Service $service)
    {
        $service->update($request->validated());
        return new ServiceResource($service->load(['vehicle', 'user.company', 'status']));
    }

    public function download(Service $service)
    {
        $service = $service->load(['items', 'user.company', 'vehicle', 'status']);
        $file_name = $service->vehicle->license_plate . '-servis.pdf';
        $pdf = Pdf::loadView('services.pdf.index', ['service' => $service]);

        return response($pdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $file_name . '"',
            'X-FileName' => $file_name,
        ]);
    }


    public function delete(Service $service)
    {
        $service->delete();
        return response()->json(['message' => 'Servis başarıyla silindi.']);
    }
}
