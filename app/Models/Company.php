<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
}
