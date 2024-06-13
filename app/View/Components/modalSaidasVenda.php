<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class modalSaidasVenda extends Component
{
    /**
     * Create a new component instance.
     */
    public $saidas;

    public function __construct(
        $saidas
    )
    {
        $this->saidas = $saidas;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modal-saidas-venda');
    }
}
