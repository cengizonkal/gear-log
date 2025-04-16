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
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'phone',
    ];

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
