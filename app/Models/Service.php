<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    /** @use HasFactory<\Database\Factories\ServiceFactory> */
    use HasFactory;

    protected $fillable = [
        'vehicle_id',
        'user_id',
        'status_id',
        'started_at',
        'finished_at',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function items()
    {
        return $this->belongsToMany(Item::class)
            ->withPivot('quantity', 'price')
            ->withTimestamps();
    }
    public function status()
    {
        return $this->belongsTo(ServiceStatus::class);
    }

    public function isCompleted():Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->finished_at !== null,
        );
    }

    public function totalPrice(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->items->sum(function ($item) {
                return $item->pivot->price * $item->pivot->quantity;
            }),
        );
    }


}
