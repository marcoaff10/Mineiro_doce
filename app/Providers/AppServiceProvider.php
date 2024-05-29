<?php

namespace App\Providers;

use App\Repositories\Contracts\Categorias\CategoriasInterface;
use App\Repositories\Contracts\Fornecedores\FornecedoresInterface;
use App\Repositories\Contracts\Produtos\ProdutosInterface;
use App\Repositories\Eloquent\Categorias\CategoriasEloquent;
use App\Repositories\Eloquent\Fornecedores\FornecedoresEloquent;
use App\Repositories\Eloquent\Produtos\ProdutosEloquent;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ProdutosInterface::class, ProdutosEloquent::class);
        $this->app->bind(FornecedoresInterface::class, FornecedoresEloquent::class);
        $this->app->bind(CategoriasInterface::class, CategoriasEloquent::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
