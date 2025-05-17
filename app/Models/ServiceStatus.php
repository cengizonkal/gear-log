<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceStatus extends Model
{
    use HasFactory;

    const PENDING = 1;
    const IN_PROGRESS = 2;
    const COMPLETED = 3;
    const WAITING_FOR_PARTS = 4;

    

    protected $fillable = [
        'name',
        'description',
        'color',
    ];
}
