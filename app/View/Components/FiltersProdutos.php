<?php

namespace App\View\Components;

use App\Models\Produto;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FiltersProdutos extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $produtos = Produto::all();
        
        return view('components.filters-produtos',compact('produtos'));
    }
}
