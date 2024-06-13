<?php

namespace App\Http\Controllers;

use App\DTO\EntradaProdutos\CreateEntradaProdutos;
use App\Http\Requests\RequestEntradaProdutos;
use App\Services\EntradaProdutos\EntradaProdutoService;
use Illuminate\Http\Request;

class Entradas extends Controller
{

    public function __construct(protected EntradaProdutoService $service)
    {
    }
    //=========================================================================================================
    // Entradas
    //=========================================================================================================
    public function store(RequestEntradaProdutos $request)
    {
        
        $this->service->store(
            CreateEntradaProdutos::makeFromRequest($request)
        );

        return redirect()->route('estoque.produtos');
    }

    //=========================================================================================================
    public function entrada_compra(Request $request)
    {        
        $this->service->entrada_compra($request->compra);

        return redirect()->route('estoque.produtos');
    }

    //=========================================================================================================
    public function compra_entrada(string $id)
    {
        $data = $this->service->produtosEntrada($id);

        return $data;
    }
}
