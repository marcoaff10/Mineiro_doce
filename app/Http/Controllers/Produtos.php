<?php

namespace App\Http\Controllers;

use App\DTO\Produtos\CreateProdutos;
use App\Http\Requests\RequestProdutos;
use App\Models\Categoria;
use App\Models\Produto;
use App\Services\ProdutoService;
use Illuminate\Http\Request;

class Produtos extends Controller
{
    public function __construct(protected ProdutoService $service)
    {
    }

    //=========================================================================================================
    // Produtos
    //=========================================================================================================
    public function show()
    {

        $produtos = $this->service->getAll();
        
        return view('dashboard.produdos.show_produtos', compact('produtos'));
    }

    //=========================================================================================================
    public function create()
    {

        $categorias = Categoria::get();


        return view('dashboard.produdos.create_produtos', compact('categorias'));
    }

    //=========================================================================================================
    public function store(RequestProdutos $request)
    {
        if (!Categoria::where('id_categoria', $request->categoria)->first()) {
            return redirect()->route('create.produtos')->with('error_create', 'Categoria inválida');
        }

        $this->service->store(
            CreateProdutos::makeFromRequest($request)
        );

        return redirect()->route('show.produtos');
    }
}
