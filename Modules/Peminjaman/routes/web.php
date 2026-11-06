<?php

use Illuminate\Support\Facades\Route;
use Modules\Peminjaman\Http\Controllers\PeminjamanController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('peminjamen', PeminjamanController::class)->names('peminjaman');
});
