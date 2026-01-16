<?php

use App\Http\Controllers\staff\StaffController;
use App\Http\Controllers\staff\ProfileController;
use App\Http\Controllers\staff\ClientController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'staff'])->group(function () {

    // ================== Dashboard ==================
    Route::get('/staff/dashboard', [StaffController::class, 'dashboard'])->name('staff.dashboard');

    // ================== Profile ==================
    Route::get('/staff/profile', [ProfileController::class, 'edit'])->name('staff.profile.edit');

    // ================== Client Management ==================
    Route::get('/staff/client/index', [ClientController::class, 'index'])->name('staff.client.index');
    Route::get('/staff/client/view/{id}', [ClientController::class, 'show'])->name('staff.client.view');

});
require __DIR__ . '/auth.php';
