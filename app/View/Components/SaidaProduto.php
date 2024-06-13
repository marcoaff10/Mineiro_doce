<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SaidaProduto extends Component
{
    /**
     * Create a new component instance.
     */
    public $saidas;
    public $filters;

    public function __construct($saidas, $filters)
    {
        $this->saidas = $saidas;
        $this->filters = $filters;
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.saida-produto');
    }
}
