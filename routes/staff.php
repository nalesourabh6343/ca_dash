<?php

use App\Http\Controllers\staff\StaffController;
use App\Http\Controllers\staff\ProfileController;
use App\Http\Controllers\staff\ClientController;
use App\Http\Controllers\staff\TaskController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'staff'])->group(function () {

    // ================== Dashboard ==================
    Route::get('/staff/dashboard', [StaffController::class, 'dashboard'])->name('staff.dashboard');

    // ================== Profile ==================
    Route::get('/staff/profile', [ProfileController::class, 'edit'])->name('staff.profile.edit');

    // ================== Client Management ==================
    Route::get('/staff/client/index', [ClientController::class, 'index'])->name('staff.client.index');
    Route::get('/staff/client/view/{id}', [ClientController::class, 'show'])->name('staff.client.view');

    // ================== Task Management ==================
    Route::get('/staff/tasks/index', [TaskController::class, 'index'])->name('staff.tasks.index');
    Route::post('/staff/tasks/update-status/{id}', [TaskController::class, 'updateStatus'])->name('staff.tasks.updateStatus');

});
require __DIR__ . '/auth.php';
