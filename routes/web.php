<?php

use App\Http\Controllers\Api\CnpjController;
use App\Http\Controllers\Compras;
use App\Http\Controllers\Fornecedores;
use App\Http\Controllers\Main;
use App\Http\Controllers\Pedidos;
use App\Http\Controllers\Produtos;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function () {

    // dashbord
    Route::get('/', [Main::class, 'dashboard'])->name('dashboard');

    // Fornecedores
    Route::get('/show_fornecedores', [Fornecedores::class, 'show'])->name('show.fornecedores');
    Route::get('/create_fornecedores', [Fornecedores::class, 'create'])->name('create.fornecedores');

    

    // Compras
    Route::get('/show_compras', [Compras::class, 'show'])->name('show.compras');
    Route::get('/create_compras', [Compras::class, 'create'])->name('create.compras');

    // Pedidos
    Route::get('/show_pedidos', [Pedidos::class, 'show'])->name('show.pedidos');
    Route::get('/create_pedidos', [Pedidos::class, 'create'])->name('create.pedidos');

    // Produtos
    Route::get('/show_produtos', [Produtos::class, 'show'])->name('show.produtos');
    Route::get('/create_produtos', [Produtos::class, 'create'])->name('create.produtos');
    Route::post('/store_produtos', [Produtos::class, 'store'])->name('store.produtos');



    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
