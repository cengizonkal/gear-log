<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 *@property mixed $id
 *@property mixed $name
 *@property mixed $phone
 *@property mixed $created_at
 *@property mixed $updated_at
 */
class Company extends Model
{
    /** @use HasFactory<\Database\Factories\CompanyFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function services()
    {
        return $this->hasManyThrough(Service::class, User::class);
    }



    public function totalServicesThisMonth()
    {
        return $this->services()
            ->where('services.created_at', '>=', now()->startOfMonth())
            ->count();
    }

    public function totalOpenServicesThisMonth()
    {
        return $this->services()
            ->whereNotIn('status_id', [3, 7])
            ->where('services.created_at', '>=', now()->startOfMonth())
            ->count();
    }

    public function totalFinishedServicesThisMonth()
    {
        return $this->services()
            ->where('status_id', 3)
            ->where('services.created_at', '>=', now()->startOfMonth())
            ->count();
    }

    public function last3Services()
    {
        return $this->services()
            ->with(['vehicle', 'user', 'status'])
            ->where('services.status_id', '!=', 7)
            ->orderBy('services.created_at', 'desc')
            ->take(3)
            ->get();
    }
}
