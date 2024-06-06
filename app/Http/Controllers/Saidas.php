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

        return redirect()->route('show.produtos');
    }

    //=========================================================================================================
    public function qtde_estoque($id)
    {
        $data = Estoque::where('produto_id', $id)->select(
            Estoque::raw('CAST((SUM(estoque.qtde_entrada) - SUM(estoque.qtde_saida)) AS DECIMAL(20, 0)) AS estoque')
        )->first();

        return response()->json($data);
    }
}
