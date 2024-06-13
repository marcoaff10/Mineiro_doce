<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EntradaProduto extends Component
{
    /**
     * Create a new component instance.
     */
    public $entradas;
    public $filters;
    
    public function __construct($entradas, $filters)
    {
        $this->entradas = $entradas;
        $this->filters = $filters;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.entrada-produto');
    }
}
