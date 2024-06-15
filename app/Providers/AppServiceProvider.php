<?php

namespace App\Providers;

use App\Repositories\Contracts\Categorias\CategoriasInterface;
use App\Repositories\Contracts\Clientes\ClientesInterface;
use App\Repositories\Contracts\Compras\ComprasInterface;
use App\Repositories\Contracts\EntradaProdutos\EntradaProdutosInterface;
use App\Repositories\Contracts\Fornecedores\FornecedoresInterface;
use App\Repositories\Contracts\Home\HomeInterface;
use App\Repositories\Contracts\Produtos\ProdutosInterface;
use App\Repositories\Contracts\SaidaProdutos\SaidaProdutosInterface;
use App\Repositories\Contracts\Vendas\VendasInterface;
use App\Repositories\Eloquent\Categorias\CategoriasEloquent;
use App\Repositories\Eloquent\Clientes\ClientesEloquent;
use App\Repositories\Eloquent\Compras\ComprasEloquent;
use App\Repositories\Eloquent\EntradaProdutos\EntradaProdutosEloquent;
use App\Repositories\Eloquent\Fornecedores\FornecedoresEloquent;
use App\Repositories\Eloquent\Home\HomeEloquent;
use App\Repositories\Eloquent\Produtos\ProdutosEloquent;
use App\Repositories\Eloquent\SaidaProdutos\SaidaProdutosEloquent;
use App\Repositories\Eloquent\Vendas\VendasEloquent;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CategoriasInterface::class, CategoriasEloquent::class);
        $this->app->bind(ProdutosInterface::class, ProdutosEloquent::class);
        $this->app->bind(FornecedoresInterface::class, FornecedoresEloquent::class);
        $this->app->bind(ComprasInterface::class, ComprasEloquent::class);
        $this->app->bind(EntradaProdutosInterface::class, EntradaProdutosEloquent::class);
        $this->app->bind(ClientesInterface::class, ClientesEloquent::class);
        $this->app->bind(VendasInterface::class, VendasEloquent::class);
        $this->app->bind(SaidaProdutosInterface::class, SaidaProdutosEloquent::class);
        $this->app->bind(HomeInterface::class, HomeEloquent::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
