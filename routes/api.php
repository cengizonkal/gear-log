<?php

use App\Http\Controllers\OwnerController;
use App\Http\Controllers\ServiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthController;


Route::post('/login',  [AuthController::class, 'login'])
    ->name('login');

//vehicle routes
//jwt auth middleware
Route::get('/vehicles/{vehicle}', [\App\Http\Controllers\VehicleController::class, 'show'])
    ->name('vehicles.show')->middleware('auth:api');

Route::get('/user', [AuthController::class, 'me'])
    ->name('user.show')->middleware('auth:api');





Route::middleware(['auth:api'])->group(function () {

    Route::get('/vehicles/{vehicle}', [\App\Http\Controllers\VehicleController::class, 'show'])
        ->name('vehicles.show');

    // Services
    Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
    Route::post('/services', [ServiceController::class, 'store'])->name('services.store');
    Route::get('/services/{service}', [ServiceController::class, 'show'])->name('services.show');
    Route::put('/services/{service}', [ServiceController::class, 'update'])->name('services.update');
    Route::delete('/services/{service}', [ServiceController::class, 'delete'])->name('services.delete');

    // Owner
    Route::get('/owners', [OwnerController::class, 'index'])->name('owners.index');
    Route::post('/owners', [OwnerController::class, 'store'])->name('owners.store');
    Route::get('/owners/{owner}', [OwnerController::class, 'show'])->name('owners.show');
    Route::put('/owners/{owner}', [OwnerController::class, 'update'])->name('owners.update');
    Route::delete('/owners/{owner}', [OwnerController::class, 'delete'])->name('owners.delete');


});


