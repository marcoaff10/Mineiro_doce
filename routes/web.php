<?php

use App\Http\Controllers\Api\CnpjController;
use App\Http\Controllers\Categorias;
use App\Http\Controllers\Compras;
use App\Http\Controllers\Entradas;
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
    Route::post('/store_fornecedores', [Fornecedores::class, 'store'])->name('store.fornecedores');
    Route::get('/detalhes_fornecedor/{id}', [Fornecedores::class, 'detalhes'])->name('detalhes.fornecedores');
    Route::get('/update_fornecedor/{id}', [Fornecedores::class, 'update'])->name('update.fornecedores');
    Route::put('/update_submit_fornecedor', [Fornecedores::class, 'update_submit'])->name('update.submit.fornecedores');
    Route::put('/delete_fornecedor', [Fornecedores::class, 'delete'])->name('delete.fornecedores');

    //  Categorias
    Route::get('/show_categorias', [Categorias::class, 'show'])->name('show.categorias');
    Route::get('/create_categorias', [Categorias::class, 'create'])->name('create.categorias');
    Route::post('/store_categorias', [Categorias::class, 'store'])->name('store.categorias');
    Route::get('/detalhes_categorias/{id}', [Categorias::class, 'detalhes'])->name('detalhes.categorias');
    Route::get('/update_categorias/{id}', [Categorias::class, 'update'])->name('update.categorias');
    Route::put('/update_categorias', [Categorias::class, 'update_submit'])->name('update.submit.categorias');
    Route::put('/delete_categorias', [Categorias::class, 'delete'])->name('delete.categorias');

    // Produtos
    Route::get('/show_produtos', [Produtos::class, 'show'])->name('show.produtos');
    Route::get('/create_produtos', [Produtos::class, 'create'])->name('create.produtos');
    Route::post('/store_produtos', [Produtos::class, 'store'])->name('store.produtos');
    Route::get('/detalhes_produtos/{id}', [Produtos::class, 'detalhes'])->name('detalhes.produtos');
    Route::get('/update_produtos/{id}', [Produtos::class, 'update'])->name('update.produtos');
    Route::put('/update_produtos', [Produtos::class, 'update_submit'])->name('update.submit.produtos');
    Route::put('/delete_produtos', [Produtos::class, 'delete'])->name('delete.produtos');

    // Entradas Produtos
    Route::post('/entrada_produtos', [Entradas::class, 'store'])->name('entrada.produtos');


    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
