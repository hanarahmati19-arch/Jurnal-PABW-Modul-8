<?php

use Illuminate\Support\Facades\Route;
use Modules\UserManagement\Http\Controllers\UserManagementController;

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/usermanagement', [UserManagementController::class, 'index'])->name('usermanagement.index');
    Route::put('/usermanagement/{id}', [UserManagementController::class, 'update'])->name('usermanagement.update');
    Route::delete('/usermanagement/{id}', [UserManagementController::class, 'destroy'])->name('usermanagement.destroy');
});
