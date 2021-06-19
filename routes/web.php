<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContainerTypeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\MediumController;
use App\Http\Controllers\PlantController;
use App\Http\Controllers\TransplantController;
use App\Http\Controllers\TaxonController;
use Illuminate\Support\Facades\Route;


# Home page
Route::redirect('/', '/home');
Route::get('/home', [HomeController::class, 'index'])->name('home');

# Auth
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/registration', [AuthController::class, 'registration'])->name('registration');
Route::post('/registration', [AuthController::class, 'register'])->name('register');

Route::middleware('auth')->group(function () {
    Route::resources([
        'plants' => PlantController::class,
        'taxa' => TaxonController::class,
        'media' => MediumController::class,
        'locations' => LocationController::class,
        'containers' => ContainerController::class,
        'container-types' => ContainerTypeController::class,
    ]);

    Route::resource('plants.transplant', TransplantController::class)->except(['index', 'show']);
    Route::resource('plants.death', DeathController::class)->except(['index', 'show']);

    // Route::name('plant.')->group(function () {
    // Route::get('/add/plant', [PlantController::class, 'create'])->name('create');

    // Route::prefix('plant')->group(function () {
    // Route::post('/', [PlantController::class, 'store'])->name('store');
    // Route::get('/{id}', [PlantController::class, 'index'])->name('index');
    // Route::get('/{id}/edit', [PlantController::class, 'edit'])->name('edit');
    // Route::put('/{id}/update', [PlantController::class, 'update'])->name('update');
    // Route::get('/{id}/died', [PlantController::class, 'died'])->name('died');
    // Route::post('/{id}/store-death', [PlantController::class, 'storeDeath'])->name('store-death');
    // Route::get('/{id}/transplant', [PlantController::class, 'transplant'])->name('transplant');
    // Route::post('/{id}/store-transplantation', [PlantController::class, 'storeTransplantation'])->name('store-transplantation');

    // });
    // });

    // # Таксон
    // Route::name('taxon.')->group(function () {
    //     Route::get('/add/taxon', [TaxonController::class, 'create'])->name('create');

    //     Route::prefix('taxon')->group(function () {
    //         Route::post('/', [TaxonController::class, 'store'])->name('store');
    //         Route::get('/{id}', [TaxonController::class, 'index'])->name('index');
    //     });
    // });

    // # Питательная среда
    // Route::name('medium.')->group(function () {
    //     Route::get('/add/medium', [MediumController::class, 'create'])->name('create');

    //     Route::prefix('medium')->group(function () {
    //         Route::post('/', [MediumController::class, 'store'])->name('store');
    //         Route::get('/{id}', [MediumController::class, 'index'])->name('index');
    //     });
    // });

    // # Локация
    // Route::name('location.')->group(function () {
    //     Route::get('/add/location', [LocationController::class, 'create'])->name('create');

    //     Route::prefix('location')->group(function () {
    //         Route::post('/', [LocationController::class, 'store'])->name('store');
    //         Route::get('/{id}', [LocationController::class, 'index'])->name('index');
    //     });
    // });

    // # Container Types
    // Route::name('container-type.')->group(function () {
    //     Route::get('/add/container-type', [ContainerTypeController::class, 'create'])->name('create');

    //     Route::prefix('container-type')->group(function () {
    //         Route::post('/', [ContainerTypeController::class, 'store'])->name('store');
    //         Route::get('/{id}', [ContainerTypeController::class, 'index'])->name('index');
    //     });
    // });
});
