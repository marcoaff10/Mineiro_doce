<?php

use App\Http\Controllers\Main;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [Main::class, 'login'])->name('auth.login');

Route::middleware('auth')->group(function () {

    // dashbord
    Route::get('/dashboard', [Main::class, 'dashboard'])->name('dashboard');
    // Compras
    Route::get('/compras', [Main::class, 'compras'])->name('compras');

    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
