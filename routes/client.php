<?php

use App\Http\Controllers\client\ClientController;
use App\Http\Controllers\client\ProfileController;
use App\Http\Controllers\client\DocumentController;
use App\Http\Controllers\client\DocumentCategoryController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'client'])->group(function () {

    // ================== Dashboard ==================
    Route::get('/client/dashboard', [ClientController::class, 'dashboard'])->name('client.dashboard');

    // ================== Profile ==================
    // ================== Profile ==================
    Route::get('/client/profile', [ProfileController::class, 'edit'])->name('client.profile.edit');

    // ================== Document Routes ==================
    Route::get('/client/document/index', [DocumentController::class, 'index'])->name('client.document.index');
    Route::get('/client/document/create', [DocumentController::class, 'create'])->name('client.document.create');
    Route::post('/client/document/create', [DocumentController::class, 'store'])->name('client.document.store');
    Route::get('/client/document/view/{id}', [DocumentController::class, 'view'])->name('client.document.view');
    Route::get('/client/document/edit/{id}', [DocumentController::class, 'edit'])->name('client.document.edit');
    Route::post('/client/document/update/{id}', [DocumentController::class, 'update'])->name('client.document.update');
    Route::get('/client/document/delete/{id}', [DocumentController::class, 'destroy'])->name('client.document.delete');
    Route::get('/client/document/trash', [DocumentController::class, 'trash'])->name('client.document.trash');
    Route::get('/client/document/restore/{id}', [DocumentController::class, 'restore'])->name('client.document.restore');
    Route::get('/client/document/force-delete/{id}', [DocumentController::class, 'forceDelete'])->name('client.document.forceDelete');

    // ================== Document Category Routes ==================
    Route::get('/client/category/index', [DocumentCategoryController::class, 'index'])->name('client.category.index');
    Route::get('/client/category/create', [DocumentCategoryController::class, 'create'])->name('client.category.create');
    Route::post('/client/category/create', [DocumentCategoryController::class, 'store'])->name('client.category.store');
    Route::get('/client/category/edit/{id}', [DocumentCategoryController::class, 'edit'])->name('client.category.edit');
    Route::post('/client/category/update/{id}', [DocumentCategoryController::class, 'update'])->name('client.category.update');
    Route::get('/client/category/delete/{id}', [DocumentCategoryController::class, 'destroy'])->name('client.category.delete');
    Route::get('/client/category/trash', [DocumentCategoryController::class, 'trash'])->name('client.category.trash');
    Route::get('/client/category/restore/{id}', [DocumentCategoryController::class, 'restore'])->name('client.category.restore');
    Route::get('/client/category/force-delete/{id}', [DocumentCategoryController::class, 'forceDelete'])->name('client.category.forceDelete');

    // ================== Client Routes ==================
    Route::get('/client/client/index', [ClientController::class, 'index'])->name('client.client.index');
    Route::get('/client/client/create', [ClientController::class, 'create'])->name('client.client.create');
    Route::post('/client/client/create', [ClientController::class, 'store'])->name('client.client.store');
    Route::get('/client/client/view/{id}', [ClientController::class, 'view'])->name('client.client.view');
    Route::get('/client/client/edit/{id}', [ClientController::class, 'edit'])->name('client.client.edit');
    Route::post('/client/client/update/{id}', [ClientController::class, 'update'])->name('client.client.update');
    Route::get('/client/client/delete/{id}', [ClientController::class, 'destroy'])->name('client.client.delete');
    Route::get('/client/client/trash', [ClientController::class, 'trash'])->name('client.client.trash');
    Route::get('/client/client/restore/{id}', [ClientController::class, 'restore'])->name('client.client.restore');
    Route::get('/client/client/force-delete/{id}', [ClientController::class, 'forceDelete'])->name('client.client.forceDelete');

});
require __DIR__ . '/auth.php';
