<?php

namespace App\Http\Controllers;

use App\DTO\Compras\CreateCompras;
use App\DTO\Compras\UpdateCompras;
use App\DTO\ProdutosCompra\CreateProdutosCompra;
use App\DTO\ProdutosCompra\UpdateProdutosCompra;
use App\Http\Requests\RequestCompras;
use App\Http\Requests\RequestProdutosCompra;
use App\Models\Compra;
use App\Models\CompraProduto;
use App\Models\Fornecedor;
use App\Models\Produto;
use App\Services\Compras\CompraService;
use Illuminate\Http\Request;

class Compras extends Controller
{
    public function __construct(protected CompraService $service, protected Compra $model)
    {
    }
    //=========================================================================================================
    // Ccompras
    //=========================================================================================================
    public function show(Request $request)
    {
        $compras = $this->service->paginate(
            page: $request->get('page', 1),
            totalPerPage: $request->get('per_page', 15),
            filter: $request->filter
        );

        $filters = ['filter' => $request->get('filter', '')];

        $desativadas = $this->model->where('ativa', 0)->get();


        return view('dashboard.compras.show_compras', compact('compras', 'filters', 'desativadas'));
    }

    //=========================================================================================================
    public function create()
    {

        $fornecedores = Fornecedor::all();

        $produtos = Produto::all();

        return view('dashboard.compras.create_compras', compact('fornecedores', 'produtos'));
    }

    //=========================================================================================================
    public function store(RequestCompras $request)
    {
        $compra = $this->service->store(
            CreateCompras::makeFromRequest($request)
        );

        return redirect()->route('produtos.compra', $compra->id);
    }

    //=========================================================================================================
    public function produtos_compra($id)
    {

        $produtos = Produto::all();

        $pedido = CompraProduto::where('compra_id', $id)->get();

        $compra = $this->model->where('id', $id)->select('id', 'compra')->first();

        return view('dashboard.compras.produtos_compra', compact('compra', 'produtos', 'pedido'));
    }

    //=========================================================================================================
    public function store_produtos_compra(RequestProdutosCompra $request)
    {
        if (CompraProduto::where('produto_id', $request->produto)->where('compra_id', $request->compra)->first()) {
            return redirect()->route('produtos.compra', $request->compra)->with('error_create', 'Produto já cadastrado nessa compra.');
        }

        $this->service->storeProdutos(
            CreateProdutosCompra::makeFromRequesr($request)
        );

        return redirect()->route('produtos.compra', $request->compra)->with('success', 'Item adicionado com sucesso.');
    }

    //=========================================================================================================
    public function detalhes(string $id)
    {
        $compra = $this->service->findOne($id);

        return view('dashboard.compras.detalhes_compras', compact('compra'));
    }

    //=========================================================================================================
    public function update(string $id)
    {
        // Atualizar apenas quantidade e preço unitário dos produtos já cadastrados na compra
        $compra = $this->service->findOne($id);

        return view('dashboard.compras.update_compra', compact('compra'));
    }

    //=========================================================================================================
    public function itens_compra(string $id)
    {
        // Chamada via Ajax para puxar informações dinamicamente do produto para a view

        $data = CompraProduto::where('produto_id', $id)->select('preco_compra', 'quantidade')->first();

        return response()->json($data);
    }

    //=========================================================================================================
    public function update_submit(RequestProdutosCompra $request)
    {
        // atualizando apenas os produtos já cadastrados na compra

        $this->service->updateProdutos(
            UpdateProdutosCompra::makeFromRequesr($request)
        );

        return redirect()->route('detalhes.compra', $request->compra);
    }

    //=========================================================================================================
    public function frete_compra(Request $request)
    {
        // atualizanfo o frete da compra

        $this->service->update(
            UpdateCompras::makeFromRequest($request)
        );

        return redirect()->route('detalhes.compra', $request->compra);
    }

    //=========================================================================================================
    public function desativar_compra(Request $request)
    {
        // Desativando a compra
        if ($this->model->where('id', $request->id)->where('entrada', 1)->first()) {
            return redirect()->route('detalhes.compra', $request->id)->with('error_disable', 'Impossivel desativar uma compra que já entrou para o estoque.');
        }

        $this->model->findOrFail($request->id)->update(
            ['ativa' => 0]
        );

        return redirect()->route('show.compras');
    }

    //=========================================================================================================
    public function compras_desativadas(Request $request)
    {
        // Lista de todas as compras desativadas

        $compras = $this->service->getAll(
            page: $request->get('page', 1),
            totalPerPage: $request->get('per_page', 15),
            filter: $request->filter
        );

        $filters = ['filter' => $request->get('filter', '')];
        

        return view('dashboard.compras.compras_desativadas', compact('compras', 'filters'));
    }

    public function reativar_compras(Request $request)
    {
        // Desativando a compra
        $this->model->findOrFail($request->id)->update(
            ['ativa' => 1]
        );

        return redirect()->route('show.compras');
    }

    //=========================================================================================================
    public function destroy(string $id)
    {
        // deletando a compra caso o usuário desista durante o cadastramento

        if (CompraProduto::where('compra_id', $id)->get()) {
            CompraProduto::where('compra_id', $id)->delete();
        }

        $this->service->delete($id);

        return redirect()->route('show.compras');
    }
}
