<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 *@mixin \App\Models\Vehicle
 */
class VehcileWithDetailsResource extends JsonResource
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
            'plate_number' => $this->plate_number,
            'fuel_type' => $this->fuelType->name,
            'vehicle_model' => $this->vehicleModel->name,
            'brand' => $this->vehicleModel->brand->name,
            'owner' => new OwnerResource($this->owner),
            'vin' => $this->vin,
            'mileage' => $this->mileage,
            

        ];
    }
}
