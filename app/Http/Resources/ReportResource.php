<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReportResource extends JsonResource
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
            'started_at' => $this->started_at,
            'finished_at' => $this->finished_at,
            'vehicle' => new VehicleResource($this->whenLoaded('vehicle')),
            'user' => new UserResource($this->whenLoaded('user')),
            'owner' => new OwnerResource($this->whenLoaded('owner')),
            'items' => $canViewPrice ? ItemResource::collection($this->whenLoaded('items')) :
                ItemWithoutPriceResource::collection($this->whenLoaded('items')),
        ];
    }
}
