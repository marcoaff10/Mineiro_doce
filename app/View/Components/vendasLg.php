<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class vendasLg extends Component
{
    /**
     * Create a new component instance.
     */
    public $vendas;
    public $filters;

   public function __construct($vendas, $filters)
   {
       $this->vendas = $vendas;
       $this->filters = $filters;
   }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.vendas-lg');
    }
}
