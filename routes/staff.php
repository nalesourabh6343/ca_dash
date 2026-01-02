<?php

use App\Http\Controllers\staff\StaffController;
use App\Http\Controllers\staff\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'staff'])->group(function () {

    // ================== Dashboard ==================
    Route::get('/staff/dashboard', [StaffController::class, 'dashboard'])->name('staff.dashboard');

    // ================== Profile ==================
    Route::get('/staff/profile', [ProfileController::class, 'edit'])->name('staff.profile.edit');

});
require __DIR__ . '/auth.php';
