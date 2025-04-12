<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleModel extends Model
{
    /** @use HasFactory<\Database\Factories\VehicleModelFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'brand_id',
        'year',
        'engine_capacity',
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
