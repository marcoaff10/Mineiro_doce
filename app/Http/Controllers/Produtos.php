<?php

namespace App\Http\Controllers;

use App\DTO\Produtos\CreateProdutos;
use App\DTO\Produtos\UpdateProdutos;
use App\Http\Requests\RequestAnaliseProdutos;
use App\Http\Requests\RequestProdutos;
use App\Models\Categoria;
use App\Models\Cliente;
use App\Models\Compra;
use App\Models\CompraProduto;
use App\Models\Fornecedor;
use App\Models\Produto;
use App\Models\Venda;
use App\Models\VendaProduto;
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

        $inativados = $this->model->where('ativa', 0)->get();


        $entradas = Compra::where('entrada', 0)->where('ativa', 1)->get();

        $saidas = Venda::where('saida', 0)->where('ativa', 1)->get();

        $filters = ['filter' => $request->get('filter', '')];

        return view('dashboard.produdos.estoque_produtos', compact('produtos', 'filters', 'entradas', 'saidas', 'inativados'));
    }

    //=========================================================================================================
    public function movimentacao(string $id, Request $request)
    {
        $produto = $this->service->findOne($id);

        $entradas = $this->service->paginateEntradas(
            id: $id,
            page: $request->get('page', 1),
            totalPerPage: $request->get('per_page', 15),
        );

        $saidas = $this->service->paginateSaidas(
            id: $id,
            page: $request->get('page', 1),
            totalPerPage: $request->get('per_page', 15),
        );

        $inativarCompra = CompraProduto::leftJoin('compras', 'compras.id', 'compra_produto.compra_id')
            ->where('compra_produto.produto_id', $id)
            ->where('compras.ativa', 1)
            ->where('compras.entrada', 0)
            ->get();

        $inativarVenda = VendaProduto::leftJoin('vendas', 'vendas.id', 'venda_produto.venda_id')
            ->where('venda_produto.produto_id', $id)
            ->where('vendas.ativa', 1)
            ->where('vendas.saida', 0)
            ->get();

        $filters = ['filter' => $request->get('filter', '')];

        return view('dashboard.produdos.movimentacao_produtos', compact('produto', 'entradas', 'saidas', 'filters', 'inativarCompra', 'inativarVenda'));
    }
    //=========================================================================================================
    public function analise_produto(string $id)
    {
        $data = $this->service->analiseProduto($id);

        return (object) $data;
    }

    //=========================================================================================================
    public function analise_produto_filtro(RequestAnaliseProdutos $request)
    {
        $data = $this->service->analiseProdutoFiltro($request);

        return (object) $data;
    }
    //=========================================================================================================
    public function create()
    {

        $categorias = Categoria::where('ativa', 1)->get();

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
        $categorias = Categoria::where('ativa', 1)->get();

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
    public function inativar_produto(string $id)
    {

        $this->model->findOrFail($id)->update(
            ['ativa' => 0]
        );

        return redirect()->route('estoque.produtos');
    }

    //=========================================================================================================
    public function reativar_produto(string $id)
    {

        $this->model->findOrFail($id)->update(
            ['ativa' => 1]
        );

        return redirect()->route('estoque.produtos');
    }

    //=========================================================================================================
    public function produto_inativado(Request $request)
    {
        $produtos = $this->service->paginateInativos(
            page: $request->get('page', 1),
            totalPerPage: $request->get('per_page', 15),
            filter: $request->filter
        );

        $filters = ['filter' => $request->get('filter', '')];

        return view('dashboard.produdos.produtos_inativados', compact('produtos', 'filters'));
    }

    //=========================================================================================================
    // public function delete(Request $request)
    // {
    //     $this->service->delete($request->id);


    //     return redirect()->route('estoque.produtos');
    // }
}
