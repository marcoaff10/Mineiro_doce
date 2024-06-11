<?php

use App\Http\Controllers\Api\CnpjController;
use App\Http\Controllers\Categorias;
use App\Http\Controllers\Clientes;
use App\Http\Controllers\Compras;
use App\Http\Controllers\Entradas;
use App\Http\Controllers\Fornecedores;
use App\Http\Controllers\Main;
use App\Http\Controllers\Pedidos;
use App\Http\Controllers\Produtos;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Saidas;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function () {

    // dashbord
    Route::get('/', [Main::class, 'dashboard'])->name('dashboard');

    // Compras
    Route::get('/show_compras', [Compras::class, 'show'])->name('show.compras');
    Route::get('/create_compras', [Compras::class, 'create'])->name('create.compras');
    Route::post('/store_compras', [Compras::class, 'store'])->name('store.compras');
    Route::get('/produtos_compra/{id}', [Compras::class, 'produtos_compra'])->name('produtos.compra');
    Route::post('/store_produtos_compra', [Compras::class, 'store_produtos_compra'])->name('store.produtos.compra');
    Route::get('/detalhes_compra/{id}', [Compras::class, 'detalhes'])->name('detalhes.compra');
    Route::get('/update_compra/{id}', [Compras::class, 'update'])->name('update.compra');
    Route::get('/itens_compra/{id}', [Compras::class, 'itens_compra'])->name('itens.compra');
    Route::put('/update_submit_compra', [Compras::class, 'update_submit'])->name('update.submit.compra');
    Route::put('/frete_compra', [Compras::class, 'frete_compra'])->name('frete.compra');
    Route::put('/desativar_compra', [Compras::class, 'desativar_compra'])->name('desativar.compra');
    Route::get('/compras_desativadas', [Compras::class, 'compras_desativadas'])->name('compras.desativadas');
    Route::put('/reativar_compras', [Compras::class, 'reativar_compras'])->name('reativar.compra');
    Route::get('/destroy_compra/{id}', [Compras::class, 'destroy'])->name('destroy.compras');


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
    Route::get('/estoque_produtos', [Produtos::class, 'estoque'])->name('estoque.produtos');
    Route::get('/create_produtos', [Produtos::class, 'create'])->name('create.produtos');
    Route::post('/store_produtos', [Produtos::class, 'store'])->name('store.produtos');
    Route::get('/movimentacao_produtos/{id}', [Produtos::class, 'movimentacao'])->name('movimentacao.produtos');
    Route::get('/update_produtos/{id}', [Produtos::class, 'update'])->name('update.produtos');
    Route::put('/update_submit_produtos', [Produtos::class, 'update_submit'])->name('update.submit.produtos');
    Route::put('/delete_produtos', [Produtos::class, 'delete'])->name('delete.produtos');

    // Entradas Produtos
    Route::post('/entrada_produtos', [Entradas::class, 'store'])->name('entrada.produtos');
    Route::post('/saida_produtos', [Saidas::class, 'store'])->name('saida.produtos');
    Route::get('/qtde_estoque/{id}', [Saidas::class, 'qtde_estoque'])->name('qtde.estoque');


    // Clientes
    Route::get('/show_clientes', [Clientes::class, 'show'])->name('show.clientes');
    Route::get('/create_clientes', [Clientes::class, 'create'])->name('create.clientes');
    Route::post('/store_clientes', [Clientes::class, 'store'])->name('store.clientes');
    Route::get('/detalhes_clientes/{id}', [Clientes::class, 'detalhes'])->name('detalhes.clientes');
    Route::get('/update_cliente/{id}', [Clientes::class, 'update'])->name('update.clientes');
    Route::put('/update_submit_clientes', [Clientes::class, 'update_submit'])->name('update.submit.clientes');
    Route::put('/delete_clientes', [Clientes::class, 'delete'])->name('delete.clientes');


    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
