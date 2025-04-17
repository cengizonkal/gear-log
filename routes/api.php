<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\BrandController;

Route::post('/login',  [AuthController::class, 'login'])
    ->name('login');

//vehicle routes
//jwt auth middleware
Route::get('/vehicles/{vehicle}', [VehicleController::class, 'show'])
    ->name('vehicles.show')->middleware('auth:api');

Route::get('/user', [AuthController::class, 'me'])
    ->name('user.show')->middleware('auth:api');





Route::middleware(['auth:api'])->group(function () {

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

    // Company
    Route::prefix('companies/{company}')->group(function () {
        Route::get('/', [CompanyController::class, 'show'])->name('companies.show');

        // Item Routes (Nested under the Company)
        Route::prefix('items')->group(function () {
            Route::get('/', [ItemController::class, 'index'])->name('companies.items.index');
            Route::post('/', [ItemController::class, 'store'])->name('companies.items.store');
            Route::get('/{item}', [ItemController::class, 'show'])->name('companies.items.show');
            Route::put('/{item}', [ItemController::class, 'update'])->name('companies.items.update');
            Route::delete('/{item}', [ItemController::class, 'delete'])->name('companies.items.delete');
        });
    });

    // User
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'delete'])->name('users.delete');

    // Vehicle
    Route::get('/vehicles/{vehicle}', [VehicleController::class, 'show'])->name('vehicles.show');
    Route::get('/vehicles/{vehicle}/services', [\App\Http\Controllers\Vehicle\ServiceController::class, 'index'])->name('vehicles.services.index');
    Route::get('/vehicles/{vehicle}/services/{service}', [\App\Http\Controllers\Vehicle\ServiceController::class, 'show'])->name('vehicles.services.show');
    Route::post('/vehicles/{vehicle}/services/', [\App\Http\Controllers\Vehicle\ServiceController::class, 'store'])->name('vehicles.services.store');

    
    //user
    Route::get('/user', [AuthController::class, 'me'])->name('user.show');

    //brands
    Route::get('/brands', [BrandController::class, 'index'])->name('brands.index');
    Route::post('/brands', [BrandController::class, 'store'])->name('brands.store')->middleware('admin');

    //dashboard
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'show'])->name('dashboard.show');


});




