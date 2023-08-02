<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(AuthController::class)->prefix('auth')->group(function () {
    Route::post('/login', 'login');
    Route::post('/logout', 'logout')->middleware('auth:sanctum');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::controller(ProfileController::class)->prefix('profile')->group(function () {
        Route::get('/', 'show');
        Route::post('/', 'update');
    });

    // Example Resource
    // Route::controller(SomethingController::class)->prefix('something')->group(function () {
    //     Route::get('/', 'index');
    //     Route::get('/{id}', 'show');
    //     Route::post('/', 'store');
    //     Route::put('/{id}/cancel', 'cancel');
    // });
});
