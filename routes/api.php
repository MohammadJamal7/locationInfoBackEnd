<?php

use App\Http\Controllers\LocationController;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


// Authentication routes
Route::post('/logout', [AuthController::class, 'logout']);
Route::post('/locations', [LocationController::class, 'store']);
Route::get('/get', [LocationController::class, 'getLocationStatus'])->name('get.location.status');