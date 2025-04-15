<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthController;



Route::post('/login', [AuthController::class, 'login'])
    ->name('login');

//vehicle routes
//jwt auth middleware
Route::get('/vehicles/{vehicle}', [\App\Http\Controllers\VehicleController::class, 'show'])
    ->name('vehicles.show')->middleware('auth:api');

Route::get('/user', [AuthController::class, 'me'])
    ->name('user.show')->middleware('auth:api');







