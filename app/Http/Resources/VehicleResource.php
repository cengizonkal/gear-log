<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\Vehicle
 */
class VehicleResource extends JsonResource
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
            'mileage' => $this->mileage,
            'vin' => $this->vin,
            'fuel_type' => $this->fuelType->name,
            'vehicle_model' => $this->vehicleModel->name,
            'brand' => $this->vehicleModel->brand->name,
            'year' => $this->year,
            'engine_capacity' => $this->engine_capacity,
            'weight' => $this->weight,
        ];
    }
}
