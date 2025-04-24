<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReportResource;
use App\Models\Service;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function generate(Request $request)
    {
        $request->validate([
            'started_at' => ['required', 'date'],
            'finished_at' => ['required', 'date', 'after_or_equal:started_at'],
        ]);

        $userCompanyId = auth()->user()->company_id;

        $services = Service::whereBetween('created_at', [$request->started_at, $request->finished_at])
            ->whereHas('user', function ($query) use ($userCompanyId) {
                $query->where('company_id', $userCompanyId);
            })
            ->whereHas('items', function ($query) use ($userCompanyId) {
                $query->where('company_id', $userCompanyId);
            })
            ->with([
                'items' => function ($query) use ($userCompanyId) {
                    $query->select('id', 'name', 'price')
                        ->where('company_id', $userCompanyId);
                },
                'vehicle' => function ($query) {
                    $query->select('id', 'vehicle_model_id', 'license_plate', 'mileage', 'owner_id', 'fuel_type_id')
                        ->withDetails();
                },
                'user' => function ($query) {
                    $query->select('id', 'name', 'company_id');
                },
            ])
            ->get();

        return ReportResource::collection($services);
    }
}
