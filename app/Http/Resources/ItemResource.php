<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
/**
 * @mixin \App\Models\Item
 */
class ItemResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'default_price' => $this->price,
            'quantity' => $this->whenPivotLoaded('item_service', function () {
                return $this->pivot->quantity;
            }),
            'price' => $this->whenPivotLoaded('item_service', function () {
                return $this->pivot->price;
            }),
        ];
    }
}
