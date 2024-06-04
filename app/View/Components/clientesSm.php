<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class clientesSm extends Component
{
    /**
     * Create a new component instance.
     */
    public $clientes;
    public $filters;

   public function __construct($clientes, $filters)
   {
       $this->clientes = $clientes;
       $this->filters = $filters;
   }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.clientes-sm');
    }
}
