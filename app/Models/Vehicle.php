<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $id
 * @property mixed $vehicle_model_id
 * @property mixed $license_plate
 * @property mixed $mileage
 * @property mixed $owner_id
 * @property mixed $fuel_type_id
 * @property mixed $vin
 * @property mixed $created_at
 * @property mixed $updated_at
 */
class Vehicle extends Model
{
    /** @use HasFactory<\Database\Factories\VehicleFactory> */
    use HasFactory;

    protected $fillable = [
        'vehicle_model_id',
        'license_plate',
        'mileage',
        'owner_id',
        'fuel_type_id',
        'vin',
    ];

    public function getRouteKeyName(): string
    {
        return 'license_plate';
    }

    public function vehicleModel()
    {
        return $this->belongsTo(VehicleModel::class);
    }

    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }

    public function fuelType()
    {
        return $this->belongsTo(FuelType::class);
    }
    public function services()
    {
        return $this->hasMany(Service::class);
    }
    public function scopeWithDetails($query)
    {
        return $query->with(['vehicleModel.brand', 'owner', 'fuelType']);
    }
    

}
