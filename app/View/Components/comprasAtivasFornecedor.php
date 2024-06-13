<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class comprasAtivasFornecedor extends Component
{
    /**
     * Create a new component instance.
     */
    public $ativas;
    public $filters;

    public function __construct($ativas, $filters)
    {
        $this->ativas = $ativas;
        $this->filters = $filters;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.compra-ativa-fornecedor');
    }
}
