<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class produtoEstoqueLg extends Component
{
    /**
     * Create a new component instance.
     */
    public $produtos;
    public $filters;

    public function __construct($produtos, $filters)
    {
        $this->produtos = $produtos;
        $this->filters = $filters;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.produto-estoque-lg');
    }
}
