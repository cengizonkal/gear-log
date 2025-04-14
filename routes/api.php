<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;



Route::post('/login',[AuthController::class, 'login'])
    ->name('login');

//vehicle routes
//jwt auth middleware
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {

    Route::get('/vehicles/{vehicle}', [\App\Http\Controllers\VehicleController::class, 'show'])
        ->name('vehicles.show');

});


