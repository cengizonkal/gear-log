<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\FuelTypeController;
use App\Http\Controllers\Company\ItemController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServiceStatusController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\BrandController;

Route::post('/login', [AuthController::class, 'login'])
    ->name('login');

//vehicle routes
//jwt auth middleware
Route::get('/vehicles/{vehicle}', [VehicleController::class, 'show'])
    ->name('vehicles.show')->middleware('auth:api');

Route::post('/vehicles', [VehicleController::class, 'store'])
    ->name('vehicles.store')->middleware('auth:api');

Route::put('/vehicles/{vehicle}', [VehicleController::class, 'update'])
    ->name('vehicles.update')->middleware('auth:api');


Route::get('/user', [AuthController::class, 'me'])
    ->name('user.show')->middleware('auth:api');

//Route::post('/services/{service}/download', [ServiceController::class, 'download'])
//    ->name('services.download')
//    ->middleware('can:download,service');

Route::get('/services/{service}/download', [ServiceController::class, 'download']);






Route::middleware(['auth:api'])->group(function () {

    // Services
    Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
    Route::post('/services', [ServiceController::class, 'store'])->name('services.store');
    Route::get('/services/{service}', [ServiceController::class, 'show'])->name('services.show');

    // Service Statuses
    Route::get('/service-statuses', [ServiceStatusController::class, 'index'])->name('service-statuses.index');

    Route::put('/services/{service}', [ServiceController::class, 'update'])
        ->name('services.update')
        ->middleware('can:update,service');

    Route::delete('/services/{service}', [ServiceController::class, 'delete'])
        ->name('services.delete')
        ->middleware('can:delete,service');



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
            Route::get('/', [ItemController::class, 'index'])->name('companies.items.index')->middleware('can:update,company');
            Route::post('/', [ItemController::class, 'store'])->name('companies.items.store')->middleware('can:update,company');

            Route::get('/{item}', [ItemController::class, 'show'])->name('companies.items.show')
                ->middleware('can:update,item')
                ->middleware('can:update,company');

            Route::put('/{item}', [ItemController::class, 'update'])->name('companies.items.update')
                ->middleware('can:update,item')
                ->middleware('can:update,company');

            Route::delete('/{item}', [ItemController::class, 'delete'])->name('companies.items.delete')
                ->middleware('can:update,item')
                ->middleware('can:update,company');
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
    Route::post('/vehicles/{vehicle}/services', [\App\Http\Controllers\Vehicle\ServiceController::class, 'store'])->name('vehicles.services.store');
    Route::get('/vehicles/search/{plate}', [VehicleController::class, 'search'])->name('vehicles.search'); // Vehicle search by plate
    //items
    Route::get('/vehicles/{vehicle}/services/{service}/items', [\App\Http\Controllers\Vehicle\Service\ItemController::class, 'index'])->name('vehicles.services.items.index');
    Route::post('/vehicles/{vehicle}/services/{service}/items', [\App\Http\Controllers\Vehicle\Service\ItemController::class, 'store'])->name('vehicles.services.items.store');


    //user
    Route::get('/user', [AuthController::class, 'me'])->name('user.show');

    //brands
    Route::get('/brands', [BrandController::class, 'index'])->name('brands.index');
    Route::post('/brands', [BrandController::class, 'store'])->name('brands.store')->middleware('admin');

    // Fuel Types
    Route::get('/fuel-types', [FuelTypeController::class, 'index'])->name('fuel-types.index');

    // Report
    Route::post('/reports', [ReportController::class, 'generate'])->name('reports.generate');


    //dashboard
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'show'])->name('dashboard.show');


});




