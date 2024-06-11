<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class modalEntradaCompra extends Component
{
    /**
     * Create a new component instance.
     */

     public $entradas;

    public function __construct(
        $entradas
    )
    {
        $this->entradas = $entradas;
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modal-entrada-compra');
    }
}
