<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 *@property mixed $id
 *@property mixed $vehicle_model_id
 *@property mixed $license_plate
 *@property mixed $mileage
 *@property mixed $owner_id
 *@property mixed $fuel_type_id
 *@property mixed $vin
 *@property mixed $created_at
 *@property mixed $updated_at
 */
class VehicleModel extends Model
{
    /** @use HasFactory<\Database\Factories\VehicleModelFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'brand_id',
        
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
