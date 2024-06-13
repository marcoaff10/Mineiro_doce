<?php

namespace App\Http\Controllers;

use App\DTO\ProdutosVenda\CreateProdutosVenda;
use App\DTO\ProdutosVenda\UpdateProdutosVenda;
use App\DTO\Vendas\CreateVendas;
use App\DTO\Vendas\UpdateVendas;
use App\Http\Requests\RequestProdutosVenda;
use App\Http\Requests\RequestVendas;
use App\Models\Cliente;
use App\Models\Estoque;
use App\Models\Produto;
use App\Models\Venda;
use App\Models\VendaProduto;
use App\Services\Vendas\VendaService;
use Illuminate\Http\Request;

class Vendas extends Controller
{

    public function __construct(protected Venda $model, protected VendaService $service)
    {
    }
    //=========================================================================================================
    // Vendas
    //=========================================================================================================
    public function show(Request $request)
    {
        $vendas = $this->service->paginate(
            page: $request->get('page', 1),
            totalPerPage: $request->get('per_page', 15),
            filter: $request->filter
        );

        $filters = ['filter' => $request->get('filter', '')];


        $desativadas = $this->model->where('ativa', 0)->where('saida', 0)->get();

        $fechadas = $this->model->where('saida', 1)->get();

        return view('dashboard.vendas.show_vendas', compact('vendas', 'desativadas', 'fechadas', 'filters'));
    }

    //=========================================================================================================
    public function create()
    {

        $clientes = Cliente::all();

        return view('dashboard.vendas.create_vendas', compact('clientes'));
    }

    //=========================================================================================================
    public function store(RequestVendas $request)
    {
        $venda = $this->service->store(
            CreateVendas::makeFromRequest($request)
        );

        return redirect()->route('produtos.venda', $venda->id);
    }

    //=========================================================================================================
    public function produtos_venda(string $id)
    {

        $produtos = Produto::leftJoin('estoque', 'estoque.produto_id', 'produtos.id')
            ->select('produtos.id', 'produtos.produto')
            ->whereRaw('CAST(estoque.qtde_entrada - estoque.qtde_saida AS DECIMAL(20, 0)) > 0')
            ->get();


        $pedido = VendaProduto::where('venda_id', $id)->get();

        $venda = $this->model->where('id', $id)->select('id', 'venda')->first();

        return view('dashboard.vendas.produtos_venda', compact('venda', 'produtos', 'pedido'));
    }

    //=========================================================================================================
    public function store_produtos_venda(RequestProdutosVenda $request)
    {
        if (VendaProduto::where('produto_id', $request->produto)->where('venda_id', $request->venda)->first()) {
            return redirect()->route('produtos.venda', $request->venda)->with('error_create', 'Produto já cadastrado nessa venda.');
        }

        $this->service->storeProdutos(
            CreateProdutosVenda::makeFromRequesr($request)
        );

        return redirect()->route('produtos.venda', $request->venda)->with('success', 'Item adicionado com sucesso.');
    }

    //=========================================================================================================
    public function estoque_disponivel_vendas(string $id)
    {
        // retorna o estoque do produto para o usuário não vender mais do que tem em estoque

        $estoque = Estoque::leftJoin('venda_produto',  function ($join) {
            $join->on('venda_produto.produto_id', 'estoque.produto_id')
                ->where('venda_produto.produto_id', '!=', null);
        })
            ->leftJoin('vendas', 'vendas.id', 'venda_produto.venda_id')
            ->where('estoque.produto_id', $id)
            ->select(
                Estoque::raw(
                    'CAST(
                        estoque.qtde_entrada - estoque.qtde_saida 
                        AS DECIMAL(20, 0)
                        ) AS estoque'
                )
            )
            ->first();

        $venda = VendaProduto::leftJoin('vendas', 'vendas.id', 'venda_produto.venda_id')
            ->where('produto_id', $id)
            ->where('vendas.saida', 0)
            ->select(
                VendaProduto::raw('SUM(venda_produto.quantidade) AS venda')
            )->first();

        $estoque->estoque = $estoque->estoque - $venda->venda;

        return response()->json($estoque);
    }

    //=========================================================================================================
    public function detalhes(string $id)
    {
        $venda = $this->service->findOne($id);

        return view('dashboard.vendas.detalhes_vendas', compact('venda'));
    }

    //=========================================================================================================
    public function update(string $id)
    {
        // Atualizar apenas quantidade e preço unitário dos produtos já cadastrados na venda
        $venda = $this->service->findOne($id);

        return view('dashboard.vendas.update_venda', compact('venda'));
    }

    //=========================================================================================================
    public function itens_venda(string $produto_id, string $id)
    {
        // Chamada via Ajax para puxar informações dinamicamente do produto para a view

        $data = VendaProduto::leftJoin('estoque', 'venda_produto.produto_id', 'estoque.produto_id')

            ->select(
                VendaProduto::raw(
                    'CAST(estoque.qtde_entrada - estoque.qtde_saida - venda_produto.quantidade AS DECIMAL(20, 0)) AS estoque'
                ),
                'venda_produto.preco_venda',
                'venda_produto.quantidade'
            )
            ->where('venda_produto.produto_id', $produto_id)
            ->where('venda_produto.venda_id', $id)
            ->first();

        $venda = VendaProduto::leftJoin('vendas', 'vendas.id', 'venda_produto.venda_id')
        ->where('produto_id', $produto_id)
            ->where('venda_id', '!=', $id)
            ->where('vendas.saida', 0)
            ->select(
                VendaProduto::raw('SUM(venda_produto.quantidade) AS venda')
            )->first();


        $data->estoque = $data->estoque + $data->quantidade - $venda->venda;



        return response()->json($data);
    }

    //=========================================================================================================
    public function update_submit(RequestProdutosVenda $request)
    {
        // atualizando apenas os produtos já cadastrados na venda

        $this->service->updateProdutos(
            UpdateProdutosVenda::makeFromRequesr($request)
        );

        return redirect()->route('detalhes.venda', $request->venda);
    }

    //=========================================================================================================
    public function frete_venda(Request $request)
    {
        // atualizanfo o frete da venda
        $this->service->update(
            UpdateVendas::makeFromRequest($request)
        );

        return redirect()->route('detalhes.venda', $request->venda);
    }

    //=========================================================================================================
    public function desativar_venda(Request $request)
    {
        // Desativando a venda
        if ($this->model->where('id', $request->id)->where('saida', 1)->first()) {
            return redirect()->route('detalhes.venda', $request->id)->with('error_disable', 'Impossivel desativar uma venda que já saiu do estoque.');
        }

        $this->model->findOrFail($request->id)->update(
            ['ativa' => 0]
        );

        return redirect()->route('show.vendas');
    }

    //=========================================================================================================
    public function vendas_desativadas(Request $request)
    {
        // Lista de todas as vendas desativadas

        $vendas = $this->service->getAll(
            page: $request->get('page', 1),
            totalPerPage: $request->get('per_page', 15),
            filter: $request->filter
        );

        $filters = ['filter' => $request->get('filter', '')];


        return view('dashboard.vendas.vendas_desativadas', compact('vendas', 'filters'));
    }

    //=========================================================================================================
    public function reativar_vendas(Request $request)
    {
        // Desativando a compra
        $this->model->findOrFail($request->id)->update(
            ['ativa' => 1]
        );

        return redirect()->route('show.vendas');
    }

    //=========================================================================================================
    public function vendas_fechadas(Request $request)
    {
        $vendas = $this->service->vendasFechadas(
            page: $request->get('page', 1),
            totalPerPage: $request->get('per_page', 15),
            filter: $request->filter
        );

        $filters = ['filter' => $request->get('filter', '')];


        return view('dashboard.vendas.vendas_fechadas', compact('vendas', 'filters'));
    }

    //=========================================================================================================
    public function destroy(string $id)
    {
        // deletando a venda caso o usuário desista durante o cadastramento

        $this->service->delete($id);

        return redirect()->route('show.vendas');
    }
}
