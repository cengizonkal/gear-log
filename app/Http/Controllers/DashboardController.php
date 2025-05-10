<?php

namespace App\Http\Controllers;

use App\Http\Resources\ServiceResource;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function show()
    {
        //total services done in start of the month
        $totalServices = \App\Models\Service::where('created_at', '>=', now()->startOfMonth())->count();

        //total services that are still open in this month if finished_at is null
        $totalOpenServices = \App\Models\Service::whereNotIn('status_id', [3,7])
            ->where('created_at', '>=', now()->startOfMonth())
            ->count();

        //total services that are finished in this month
        $totalFinishedServices = \App\Models\Service::where('status_id', 3)
            ->where('created_at', '>=', now()->startOfMonth())
            ->count();

        $last3Services = \App\Models\Service::with(['vehicle', 'user', 'status'])
            ->where('status_id', '!=', 7)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();


        return response()->json([
            'totalServices' => (int)$totalServices,
            'totalOpenServices' => (int)$totalOpenServices,
            'totalFinishedServices' => (int)$totalFinishedServices,
            'last3Services' => ServiceResource::collection($last3Services),
        ]);
    }
}
