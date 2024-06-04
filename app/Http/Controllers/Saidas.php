<?php

namespace App\Http\Controllers;

use App\DTO\SaidaProdutos\CreateSaidaProdutos;
use App\Http\Requests\RequestSaidaProduto;
use App\Services\SaidaProdutos\SaidaProdutoService;
use Illuminate\Http\Request;

class Saidas extends Controller
{
    public function __construct(protected SaidaProdutoService $service)
    {
        
    }


    //=========================================================================================================
    // Saidas
    //=========================================================================================================
    public function store(RequestSaidaProduto $request)
    {
        $this->service->store(
            CreateSaidaProdutos::makeFromRequest($request)
        );

        return redirect()->route('show.produtos');
    }
}
