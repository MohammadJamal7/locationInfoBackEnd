<?php

use App\Http\Controllers\FilteringController;
use App\Http\Controllers\LocationController;
use Illuminate\Support\Facades\Route;





Route::get('/', [FilteringController::class, 'dashboard'])->name('admin.dashboard');