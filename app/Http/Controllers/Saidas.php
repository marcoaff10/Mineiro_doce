<?php

namespace App\Http\Controllers;

use App\DTO\SaidaProdutos\CreateSaidaProdutos;
use App\Http\Requests\RequestSaidaProduto;
use App\Models\Estoque;
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

        return redirect()->route('estoque.produtos');
    }

    //=========================================================================================================
    public function saida_venda(Request $request)
    {
        
        $this->service->saida_venda($request->venda);

        return redirect()->route('estoque.produtos');
    }

    //=========================================================================================================
    public function venda_saida(string $id)
    {
        $data = $this->service->produtoSaida($id);

        return $data;
    }
}
