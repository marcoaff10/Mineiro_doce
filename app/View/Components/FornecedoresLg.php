<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FornecedoresLg extends Component
{
    /**
     * Create a new component instance.
     */
    public $fornecedores;
    public $filters;

   public function __construct($fornecedores, $filters)
   {
       $this->fornecedores = $fornecedores;
       $this->filters = $filters;
   }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.fornecedores-lg');
    }
}
