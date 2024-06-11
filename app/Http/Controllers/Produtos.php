<?php

namespace App\Http\Controllers;

use App\DTO\Produtos\CreateProdutos;
use App\DTO\Produtos\UpdateProdutos;
use App\Http\Requests\RequestProdutos;
use App\Models\Categoria;
use App\Models\Cliente;
use App\Models\Compra;
use App\Models\Fornecedor;
use App\Models\Produto;
use App\Services\Produtos\ProdutoService;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class Produtos extends Controller
{
    public function __construct(protected ProdutoService $service, protected Produto $model)
    {
    }

    //=========================================================================================================
    // Produtos
    //=========================================================================================================
    public function estoque(Request $request)
    {

        $produtos = $this->service->paginate(
            page: $request->get('page', 1),
            totalPerPage: $request->get('per_page', 15),
            filter: $request->filter
        );

        
        $entradas = Compra::where('entrada', 0)->where('ativa', 1)->get();

        $saidas = Compra::where('entrada', 1)->where('ativa', 1)->get();

        $filters = ['filter' => $request->get('filter', '')];

        return view('dashboard.produdos.estoque_produtos', compact('produtos', 'filters', 'entradas', 'saidas'));
    }

    //=========================================================================================================
    public function movimentacao(string $id, Request $request)
    {
        $produto = $this->service->findOne($id);

        $produtoEntrada = $this->service->paginateEntradas(
            id: $id,
            page: $request->get('page', 1),
            totalPerPage: $request->get('per_page', 15),
        );
        
        $produtoSaida = $this->service->paginateSaidas(
            id: $id,
            page: $request->get('page', 1),
            totalPerPage: $request->get('per_page', 15),
        );
   
        $filters = ['filter' => $request->get('filter', '')];

        return view('dashboard.produdos.movimentacao_produtos', compact('produto', 'produtoEntrada', 'produtoSaida','filters'));
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
        if (!Categoria::where('id', $request->categoria)->first()) {
            return redirect()->route('create.produtos')
                ->withInput()
                ->with('error_create', 'Categoria inválida');
        }

        if ($this->model->where('produto', $request->produto)->where('categoria_id', $request->categoria)->first()) {
            return redirect()->route('create.produtos')
                ->withInput()
                ->with('error_create', 'Já existe um registro desse produto com a mesma categoria.');
        }

        $this->service->store(
            CreateProdutos::makeFromRequest($request)
        );

        return redirect()->route('estoque.produtos');
    }

    //=========================================================================================================
    public function update(string $id)
    {
        
        $produto = $this->model->where('id', $id)->first();
        $categorias = Categoria::get();
        
        return view('dashboard.produdos.update_produtos', compact('produto', 'categorias'));
    }

    //=========================================================================================================
    public function update_submit(RequestProdutos $request)
    {
        if (!Categoria::where('id', $request->categoria)->first()) {
            return redirect()->route('create.produtos')
                ->withInput()
                ->with('error_create', 'Categoria inválida');
        }

        if ($this->model->where('id', '!=', $request->id)->where('produto', $request->produto)->where('categoria_id', $request->categoria)->first()) {
            return redirect()->route('update.produtos', ['id' => $request->id])
                ->withInput()
                ->with('error_create', 'Já existe outro produto igual registrado na mesma categoria.');
        }

        $this->service->update(
            UpdateProdutos::makeFromRequest($request)
        );

        return redirect()->route('movimentacao.produtos', $request->id);
    }

    //=========================================================================================================
    public function delete(Request $request)
    {
        $this->service->delete($request->id);

        
        return redirect()->route('estoque.produtos');
    }

}
