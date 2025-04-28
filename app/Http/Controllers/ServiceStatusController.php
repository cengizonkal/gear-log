<?php

namespace App\Http\Controllers;

use App\Models\ServiceStatus;
use Illuminate\Http\Request;

class ServiceStatusController extends Controller
{
    public function index()
    {
        $statuses = ServiceStatus::all();
        return response()->json([
            'data' => $statuses,
        ]);
    }
}
