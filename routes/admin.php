<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\ProfileController;
use App\Http\Controllers\admin\ServiceController;
use App\Http\Controllers\admin\BusinessController;
use App\Http\Controllers\admin\ClientController;
use App\Http\Controllers\admin\TaskController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'admin'])->group(function () {

    // ================== Dashboard ==================
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // ================== Profile ==================
    // ================== Profile ==================
    Route::get('/admin/profile', [ProfileController::class, 'edit'])->name('admin.profile.edit');

    // ================== Service Routes ==================
    Route::get('/admin/service/index', [ServiceController::class, 'index'])->name('admin.service.index');
    Route::get('/admin/service/create', [ServiceController::class, 'create'])->name('admin.service.create');
    Route::post('/admin/service/create', [ServiceController::class, 'store'])->name('admin.service.store');
    Route::get('/admin/service/edit/{id}', [ServiceController::class, 'edit'])->name('admin.service.edit');
    Route::post('/admin/service/update/{id}', [ServiceController::class, 'update'])->name('admin.service.update');
    Route::get('/admin/service/delete/{id}', [ServiceController::class, 'destroy'])->name('admin.service.delete');
    Route::get('/admin/service/trash', [ServiceController::class, 'trash'])->name('admin.service.trash');
    Route::get('/admin/service/restore/{id}', [ServiceController::class, 'restore'])->name('admin.service.restore');
    Route::get('/admin/service/force-delete/{id}', [ServiceController::class, 'forceDelete'])->name('admin.service.forceDelete');

    // Add here client route


    // ================== Business Routes ==================
    Route::get('/admin/business/index', [BusinessController::class, 'index'])->name('admin.business.index');
    Route::get('/admin/business/create', [BusinessController::class, 'create'])->name('admin.business.create');
    Route::post('/admin/business/create', [BusinessController::class, 'store'])->name('admin.business.store');
    Route::get('/admin/business/edit/{id}', [BusinessController::class, 'edit'])->name('admin.business.edit');
    Route::post('/admin/business/update/{id}', [BusinessController::class, 'update'])->name('admin.business.update');
    Route::get('/admin/business/delete/{id}', [BusinessController::class, 'destroy'])->name('admin.business.delete');
    Route::get('/admin/business/trash', [BusinessController::class, 'trash'])->name('admin.business.trash');
    Route::get('/admin/business/restore/{id}', [BusinessController::class, 'restore'])->name('admin.business.restore');
    Route::get('/admin/business/force-delete/{id}', [BusinessController::class, 'forceDelete'])->name('admin.business.forceDelete');

    // ================== Client Routes (Admin View) ==================
    Route::get('/admin/client/index', [ClientController::class, 'index'])->name('admin.client.index');
    Route::get('/admin/client/create', [ClientController::class, 'create'])->name('admin.client.create');
    Route::post('/admin/client/create', [ClientController::class, 'store'])->name('admin.client.store');
    Route::get('/admin/client/view/{id}', [ClientController::class, 'show'])->name('admin.client.view');
    Route::get('/admin/client/edit/{id}', [ClientController::class, 'edit'])->name('admin.client.edit');
    Route::post('/admin/client/update/{id}', [ClientController::class, 'update'])->name('admin.client.update');
    Route::get('/admin/client/delete/{id}', [ClientController::class, 'destroy'])->name('admin.client.delete');
    Route::get('/admin/client/trash', [ClientController::class, 'trash'])->name('admin.client.trash');
    Route::get('/admin/client/restore/{id}', [ClientController::class, 'restore'])->name('admin.client.restore');
    Route::get('/admin/client/force-delete/{id}', [ClientController::class, 'forceDelete'])->name('admin.client.forceDelete');

    // ================== Task Routes ==================
    Route::get('/admin/tasks/index', [TaskController::class, 'index'])->name('admin.tasks.index');
    Route::get('/admin/tasks/create', [TaskController::class, 'create'])->name('admin.tasks.create');
    Route::post('/admin/tasks/create', [TaskController::class, 'store'])->name('admin.tasks.store');
    Route::get('/admin/tasks/view/{id}', [TaskController::class, 'show'])->name('admin.tasks.view');
    Route::get('/admin/tasks/edit/{id}', [TaskController::class, 'edit'])->name('admin.tasks.edit');
    Route::post('/admin/tasks/update/{id}', [TaskController::class, 'update'])->name('admin.tasks.update');
    Route::get('/admin/tasks/delete/{id}', [TaskController::class, 'destroy'])->name('admin.tasks.delete');
    Route::get('/admin/tasks/trash', [TaskController::class, 'trash'])->name('admin.tasks.trash');
    Route::get('/admin/tasks/restore/{id}', [TaskController::class, 'restore'])->name('admin.tasks.restore');
    Route::get('/admin/tasks/force-delete/{id}', [TaskController::class, 'forceDelete'])->name('admin.tasks.forceDelete');

});
require __DIR__ . '/auth.php';
