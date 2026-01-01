<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'admin'])->group(function () {

    // ================== Dashboard ==================
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // ================== Profile ==================
    Route::get('/admin/profile', [ProfileController::class, 'edit'])->name('admin.profile.edit');

});
require __DIR__ . '/auth.php';
