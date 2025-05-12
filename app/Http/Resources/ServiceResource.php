<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\Service
 */
class ServiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $canViewPrice = $request->user()->can('viewPrice', $this->resource);

        return [
            'id' => $this->id,
            'vehicle' => new VehicleResource($this->whenLoaded('vehicle')),
            'user' => new UserResource($this->whenLoaded('user')),
            'started_at' => $this->started_at,
            'finished_at' => $this->finished_at,
            'status' => new ServiceStatusResource($this->whenLoaded('status')),
            'status_id' => $this->status_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'items' => $canViewPrice ? ItemResource::collection($this->whenLoaded('items')) :
                ItemWithoutPriceResource::collection($this->whenLoaded('items')),
            'description' => $this->description,
        ];
    }
}
