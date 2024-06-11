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
    public $saidas;
    
    public function __construct($produtos, $saidas)
    {
        $this->produtos = $produtos;
        $this->saidas = $saidas;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modal-saida');
    }
}
