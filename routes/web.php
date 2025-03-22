<?php

use App\Http\Controllers\FilteringController;
use App\Http\Controllers\LocationController;
use Illuminate\Support\Facades\Route;





Route::get('/', [FilteringController::class, 'dashboard'])->name('admin.dashboard');

Route::get('/activate-location', [LocationController::class, 'activateLocation'])->name('activate.location');
Route::get('/deactivate-location', [LocationController::class, 'deactivateLocation'])->name('deactivate.location');