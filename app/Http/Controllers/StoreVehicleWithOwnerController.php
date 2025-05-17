<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVehicleWithOwnerRequest;
use App\Models\Owner;
use Illuminate\Http\Request;

class StoreVehicleWithOwnerController extends Controller
{
    public function store(StoreVehicleWithOwnerRequest $request)
    {

        try {
            \DB::beginTransaction();
            $owner = Owner::create($request->input('owner'));
            $owner->vehicles()->create($request->input('vehicle'));
            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollBack();
            return response()->json(['message' => 'Araç ve Sahibi oluşturulamadı', 'error' => $e->getMessage()], 500);
        }
        return response()->json(['message' => 'Araç ve Sahibi oluşturuldu'], 201);
    }
}
