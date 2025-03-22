<?php

use App\Http\Controllers\LocationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/locations', [LocationController::class, 'store']);
Route::get('/get', [LocationController::class, 'getLocationStatus'])->name('get.location.status');
