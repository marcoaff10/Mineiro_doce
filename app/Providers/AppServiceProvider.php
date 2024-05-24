<?php

namespace App\Providers;

use App\Repositories\Contracts\ProdutosInterface;
use App\Repositories\Eloquent\ProdutosEloquent;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ProdutosInterface::class, ProdutosEloquent::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
