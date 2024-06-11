<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class modalEntradas extends Component
{
    /**
     * Create a new component instance.
     */
    public $produtos;

   public function __construct(
       $produtos,
   )
   {
       $this->produtos = $produtos;
   }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modal-entradas');
    }
}
