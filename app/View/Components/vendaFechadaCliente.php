<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class vendaFechadaCliente extends Component
{
    /**
     * Create a new component instance.
     */
    public $fechadas;
    public $filters;

    public function __construct($fechadas, $filters)
    {
        $this->fechadas = $fechadas;
        $this->filters = $filters;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.venda-fechada-cliente');
    }
}
