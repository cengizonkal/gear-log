<?php

namespace App\Http\Controllers;

use App\Http\Resources\ServiceResource;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function show()
    {

        $company = auth()->user()->company;
        return response()->json([
            'totalServices' => (int) $company->totalServicesThisMonth(),
            'totalOpenServices' => (int) $company->totalOpenServicesThisMonth(),
            'totalFinishedServices' => (int) $company->totalFinishedServicesThisMonth(),
            'last3Services' => ServiceResource::collection($company->last3Services()),
        ]);
    }
}
