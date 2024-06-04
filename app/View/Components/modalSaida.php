<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class modalSaida extends Component
{
    /**
     * Create a new component instance.
     */
    
    public $produtos;
    public $clientes;
    
    public function __construct($produtos, $clientes)
    {
        $this->produtos = $produtos;
        $this->clientes = $clientes;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modal-saida');
    }
}
