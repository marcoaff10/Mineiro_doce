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

        return view('dashboard.compras.show_compras', compact('compras', 'filters'));
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

        $compra = $this->model->where('id', $id)->select('id','compra')->first();

        return view('dashboard.compras.produtos_compra', compact('compra', 'produtos','pedido' ));
    }

    //=========================================================================================================
    public function store_produtos_compra(RequestProdutosCompra $request)
    {   
        if (CompraProduto::where('produto_id', $request->produto)->where('compra_id', $request->compra)->first())
        {
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
        $compra = $this->service->findOne($id);
        
        return view('dashboard.compras.update_compra', compact('compra'));
    }

    //=========================================================================================================
    public function itens_compra(string $id)
    {
        $data = CompraProduto::where('produto_id', $id)->select('preco_compra', 'quantidade')->first();
       
        return response()->json($data);
    }

    //=========================================================================================================
    public function update_submit(RequestProdutosCompra $request)
    {
        $this->service->updateProdutos(
            UpdateProdutosCompra::makeFromRequesr($request)
        );

        return redirect()->route('detalhes.compra', $request->compra);
    }

    //=========================================================================================================
    public function frete_compra(Request $request)
    {
        $this->service->update(
            UpdateCompras::makeFromRequest($request)
        );

        return redirect()->route('detalhes.compra', $request->compra);
    }

    //=========================================================================================================
    public function destroy(string $id)
    {

        $this->service->delete($id);

        return redirect()->route('show.compras');
    }
}
