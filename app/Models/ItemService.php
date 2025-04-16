<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ItemService extends Pivot
{
    /** @use HasFactory<\Database\Factories\ItemServiceFactory> */
    use HasFactory;
    protected $table = 'item_service';

    protected $fillable = [
        'service_id',
        'item_id',
        'price',
        'quantity',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
