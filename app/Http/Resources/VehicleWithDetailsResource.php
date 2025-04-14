<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 *@mixin \App\Models\Vehicle
 */
class VehicleWithDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'license_plate' => $this->license_plate,
            'fuel_type' => $this->fuelType->name,
            'vehicle_model' => $this->vehicleModel->name,
            'brand' => $this->vehicleModel->brand->name,
            'owner' => new OwnerResource($this->owner),
            'vin' => $this->vin,
            'mileage' => $this->mileage,
            'services' => ServiceResource::collection($this->services()->with(['user.company'])->latest()->take(3)->get()),
    
        ];
    }
}
