<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class comprasLg extends Component
{
    /**
     * Create a new component instance.
     */
    public $compras;
    public $filters;

   public function __construct($compras, $filters)
   {
       $this->compras = $compras;
       $this->filters = $filters;
   }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.compras-lg');
    }
}
