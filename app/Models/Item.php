<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    /** @use HasFactory<\Database\Factories\ItemFactory> */
    use HasFactory;

    protected $fillable = [
        'company_id',
        'price',
        'name',
        'description',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    
}
