<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FilteringController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;



Route::get('/dash', function () {
    return redirect()->route('dashboard');
})->middleware(['auth', 'verified'])->name('admin.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});



Route::get('/', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::middleware('auth')->get('/dashboard', [filteringController::class, 'dashboard'])->name('admin.dashboard');

Route::get('/activate-location', [LocationController::class, 'activateLocation'])->name('activate.location');
Route::get('/deactivate-location', [LocationController::class, 'deactivateLocation'])->name('deactivate.location');
Route::get('/delete-locations', [LocationController::class, 'deleteAll'])->name('delete.location');
Route::post('/insrt-email', [filteringController::class, 'storeAdminEmail'])->name('insert.email.admin');
Route::post('/store-email', [EmailController::class, 'set_email'])->name('set.email');




require __DIR__.'/auth.php';
