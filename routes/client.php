<?php

use App\Http\Controllers\client\ClientController;
use App\Http\Controllers\client\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'client'])->group(function () {

    // ================== Dashboard ==================
    Route::get('/client/dashboard', [ClientController::class, 'dashboard'])->name('client.dashboard');

    // ================== Profile ==================
    Route::get('/client/profile', [ProfileController::class, 'edit'])->name('client.profile.edit');

});
require __DIR__ . '/auth.php';
