<?php

namespace App\Http\Controllers;

use App\DTO\Produtos\CreateProdutos;
use App\DTO\Produtos\UpdateProdutos;
use App\Http\Requests\RequestProdutos;
use App\Models\Categoria;
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
    public function show(Request $request)
    {

        $produtos = $this->service->paginate(
            page: $request->get('page', 1),
            totalPerPage: $request->get('per_page', 15),
            filter: $request->filter
        );


        $filters = ['filter' => $request->get('filter', '')];

        return view('dashboard.produdos.show_produtos', compact('produtos', 'filters'));
    }

    //=========================================================================================================
    public function detalhes(string $id)
    {
        $produto = $this->service->findOne($id);


        return view('dashboard.produdos.detalhes_produtos', compact('produto'));
    }

    //=========================================================================================================
    public function create()
    {

        $categorias = Categoria::get();
        $fornecedores = Fornecedor::get();


        return view('dashboard.produdos.create_produtos', compact('categorias', 'fornecedores'));
    }

    //=========================================================================================================
    public function store(RequestProdutos $request)
    {
        if (!Categoria::where('id', $request->categoria)->first()) {
            return redirect()->route('create.produtos')
                ->withInput()
                ->with('error_create', 'Categoria inválida');
        }

        if (!Fornecedor::where('id', $request->fornecedor)->first()) {
            return redirect()->route('create.produtos')
                ->withInput()
                ->with('error_create', 'Fornecedor inválida');
        }

        if ($this->model->where('produto', $request->produto)->where('categoria_id', $request->categoria)->where('fornecedor_id', $request->fornecedor)->first()) {
            return redirect()->route('create.produtos')
                ->withInput()
                ->with('error_create', 'Já existe um registro desse produto com o mesmo fornecedor e categoria.');
        }

        $this->service->store(
            CreateProdutos::makeFromRequest($request)
        );

        return redirect()->route('show.produtos');
    }

    //=========================================================================================================
    public function update($id)
    {
        
        $produto = $this->service->findOne($id);
        $categorias = Categoria::get();
        $fornecedores = Fornecedor::get();
        
        return view('dashboard.produdos.update_produtos', compact('produto', 'categorias', 'fornecedores'));
    }

    //=========================================================================================================
    public function update_submit(RequestProdutos $request)
    {
        if (!Categoria::where('id', $request->categoria)->first()) {
            return redirect()->route('create.produtos')
                ->withInput()
                ->with('error_create', 'Categoria inválida');
        }

        if (!Fornecedor::where('id', $request->fornecedor)->first()) {
            return redirect()->route('create.produtos')
                ->withInput()
                ->with('error_create', 'Fornecedor inválida');
        }

        if ($this->model->where('produto', $request->produto)->where('categoria_id', $request->categoria)->where('fornecedor_id', $request->fornecedor)->where('id', '!=', $request->id)->first()) {
            return redirect()->route('create.produtos')
                ->withInput()
                ->with('error_create', 'Já existe um registro desse produto com o mesmo fornecedor e categoria.');
        }

        $this->service->update(
            UpdateProdutos::makeFromRequest($request)
        );

        return redirect()->route('detalhes.produtos', ['id' => $request->id]);
    }

    //=========================================================================================================
    public function delete(Request $request)
    {
        $this->service->delete($request->id);

        
        return redirect()->route('show.produtos');
    }

}
