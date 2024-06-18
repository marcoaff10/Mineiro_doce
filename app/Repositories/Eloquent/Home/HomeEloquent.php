<?php


namespace App\Repositories\Eloquent\Home;

use App\Models\Cliente;
use App\Models\Compra;
use App\Models\CompraProduto;
use App\Models\Fornecedor;
use App\Models\Produto;
use App\Models\Venda;
use App\Models\VendaProduto;
use App\Repositories\Contracts\Home\HomeInterface;
use stdClass;

class HomeEloquent implements HomeInterface
{
    //=========================================================================================================
    public function __construct()
    {
    }

    //=========================================================================================================
    // Lucro
    //=========================================================================================================    
    public function lucroTotal()
    {

        $fretev = Venda::selectRaw('SUM(frete) AS frete')
            ->where('saida', 1)
            ->first();
        $fretec = Compra::selectRaw('SUM(frete) AS frete')
            ->where('entrada', 1)
            ->first();

        $receita = VendaProduto::leftJoin('vendas', 'venda_produto.venda_id', 'vendas.id')
            ->selectRaw(
                'CAST(SUM(quantidade * preco_venda) AS DECIMAL(20, 2)) AS receita'
            )
            ->where('vendas.saida', 1)
            ->first();

        $custo = CompraProduto::leftJoin('compras', 'compra_produto.compra_id', 'compras.id')
            ->selectRaw(
                'CAST(SUM(quantidade * preco_compra) AS DECIMAL(20, 2)) AS custo'
            )
            ->where('compras.entrada', 1)
            ->first();

        $custoTotal = $custo->custo + $fretev->frete + $fretec->frete;
        $lucro = $receita->receita - $custoTotal;
        return response()->json(
            [
                'receita' => $receita->receita,
                'custo' => $custoTotal,
                'lucro' => $lucro
            ]
        );
    }

    //=========================================================================================================
    public function lucroTotalFiltro($request)
    {
        $de = date('Y-m-d', strtotime($request->de));
        $ate = date('Y-m-d', strtotime($request->ate));
        $fretev = Venda::selectRaw('SUM(frete) AS frete')
            ->where('saida', 1)
            ->whereBetween('data', [$de, $ate])
            ->first();

        $fretec = Compra::selectRaw('SUM(frete) AS frete')
            ->where('compras.entrada', 1)
            ->whereBetween('data', [$de, $ate])
            ->first();


        $receita = VendaProduto::leftJoin('vendas', 'vendas.id', 'venda_produto.venda_id')
            ->selectRaw(
                'CAST(SUM(quantidade * preco_venda) AS DECIMAL(20, 2)) AS receita'
            )
            ->where('vendas.saida', 1)
            ->whereBetween('vendas.data', [$de, $ate])
            ->first();

        $custo = CompraProduto::leftJoin('compras', 'compras.id', 'compra_produto.compra_id')
            ->selectRaw(
                'CAST(SUM(quantidade * preco_compra) AS DECIMAL(20, 2)) AS custo'
            )
            ->where('compras.entrada', 1)
            ->whereBetween('compras.data', [$de, $ate])
            ->first();

        $custoTotal = $custo->custo + $fretev->frete + $fretec->frete;
        $lucro = $receita->receita - $custoTotal;
        return response()->json(
            [
                'receita' => $receita->receita,
                'custo' => $custoTotal,
                'lucro' => $lucro,
            ]
        );
    }

    //==========================================================================================================
    // Produtos
    //==========================================================================================================
    public function estatisticasProdutos()
    {


        $estatisticas = VendaProduto::leftJoin('vendas', 'vendas.id', 'venda_produto.venda_id')
            ->leftJoin('produtos', 'produtos.id', 'venda_produto.produto_id')
            ->select(
                'produtos.produto',
                VendaProduto::raw(
                    'CAST(
                        SUM(venda_produto.quantidade * venda_produto.preco_venda)
                        AS DECIMAL(20, 2)
                    ) AS venda'
                ),

            )
            ->where('vendas.saida', 1)
            ->orderByRaw('SUM(venda_produto.quantidade * venda_produto.preco_venda) DESC')
            ->groupBy('produtos.id')
            ->limit(5)
            ->get()
            ->toArray();

        return response()->json($estatisticas);
    }

    //=========================================================================================================
    public function estatisticasProdutosFiltro($request)
    {
        $de = date('Y-m-d', strtotime($request->de));
        $ate = date('Y-m-d', strtotime($request->ate));

        if ($request->tipo == 'preco') {

            $estatisticas = Produto::leftJoin('venda_produto', 'produtos.id', 'venda_produto.produto_id')
                ->leftJoin('vendas', 'vendas.id', 'venda_produto.venda_id')
                ->select(
                    'produtos.produto',
                    Produto::raw(
                        'CAST(SUM(venda_produto.quantidade * venda_produto.preco_venda) AS DECIMAL(20, 2)) AS valor'
                    )
                )
                ->whereBetween('vendas.data', [$de, $ate])
                ->where('vendas.saida', 1)
                ->orderByRaw('SUM(venda_produto.quantidade * venda_produto.preco_venda) DESC')
                ->groupBy('produtos.id')
                ->limit(5)
                ->get()
                ->toArray();

            return response()->json($estatisticas);
        } else {
            if ($request->tipo == 'quantidade') {

                $estatisticas = Produto::leftJoin('venda_produto', 'produtos.id', 'venda_produto.produto_id')
                    ->leftJoin('vendas', 'vendas.id', 'venda_produto.venda_id')
                    ->select(
                        'produtos.produto',
                        Produto::raw(
                            'SUM(venda_produto.quantidade) AS valor'
                        )
                    )
                    ->whereBetween('vendas.data', [$de, $ate])
                    ->where('vendas.saida', 1)
                    ->orderByRaw('SUM(venda_produto.quantidade) DESC')
                    ->groupBy('produtos.id')
                    ->limit(5)
                    ->get()
                    ->toArray();

                return response()->json($estatisticas);
            }
        }
    }

    //==========================================================================================================
    // Vendas
    //==========================================================================================================
    public function estatisticasVendas()
    {
        $estatisticas = VendaProduto::leftJoin('vendas', 'vendas.id', 'venda_produto.venda_id')
            ->leftJoin('clientes', 'clientes.id', 'vendas.cliente_id')
            ->select(
                'clientes.cliente',
                VendaProduto::raw(
                    'CAST(
                    SUM(venda_produto.quantidade * venda_produto.preco_venda)
                    AS DECIMAL(20, 2)
                ) AS venda'
                ),

            )
            ->where('vendas.saida', 1)
            ->orderByRaw('SUM(venda_produto.quantidade * venda_produto.preco_venda) DESC')
            ->groupBy('clientes.id')
            ->limit(5)
            ->get()
            ->toArray();

        return response()->json($estatisticas);
    }

    //=========================================================================================================
    public function estatisticasVendasFiltro($request)
    {
        $de = date('Y-m-d', strtotime($request->de));
        $ate = date('Y-m-d', strtotime($request->ate));

        if ($request->tipo == 'preco') {

            $estatisticas = Cliente::leftJoin('vendas', 'vendas.cliente_id', 'clientes.id')
                ->leftJoin('venda_produto', 'venda_produto.venda_id', 'vendas.id')
                ->select(
                    'clientes.cliente',
                    Cliente::raw(
                        'CAST(SUM(venda_produto.quantidade * venda_produto.preco_venda) AS DECIMAL(20, 2)) AS valor'
                    )
                )
                ->whereBetween('vendas.data', [$de, $ate])
                ->where('vendas.saida', 1)
                ->orderByRaw('SUM(venda_produto.quantidade * venda_produto.preco_venda) DESC')
                ->groupBy('clientes.id')
                ->limit(5)
                ->get()
                ->toArray();

            return response()->json($estatisticas);
        } else {
            if ($request->tipo == 'quantidade') {

                $estatisticas = Cliente::leftJoin('vendas', 'vendas.cliente_id', 'clientes.id')
                    ->leftJoin('venda_produto', 'venda_produto.venda_id', 'vendas.id')
                    ->select(
                        'clientes.cliente',
                        Cliente::raw(
                            'SUM(venda_produto.quantidade) AS valor'
                        )
                    )
                    ->whereBetween('vendas.data', [$de, $ate])
                    ->where('vendas.saida', 1)
                    ->orderByRaw('SUM(venda_produto.quantidade) DESC')
                    ->groupBy('clientes.id')
                    ->limit(5)
                    ->get()
                    ->toArray();

                return response()->json($estatisticas);
            }
        }
    }

    //==========================================================================================================
    // Compras
    //==========================================================================================================
    public function estatisticasCompras()
    {
        $estatisticas = CompraProduto::leftJoin('compras', 'compras.id', 'compra_produto.compra_id')
            ->leftJoin('fornecedores', 'fornecedores.id', 'compras.fornecedor_id')
            ->select(
                'fornecedores.fornecedor',
                CompraProduto::raw(
                    'CAST(
                        SUM(compra_produto.quantidade * compra_produto.preco_compra)
                        AS DECIMAL(20, 2)
                    ) AS compra'
                ),

            )
            ->where('compras.entrada', 1)
            ->orderByRaw('SUM(compra_produto.quantidade * compra_produto.preco_compra) DESC')
            ->groupBy('fornecedores.id')
            ->limit(5)
            ->get()
            ->toArray();

        return response()->json($estatisticas);
    }

    //=========================================================================================================
    public function estatisticasComprasFiltro($request)
    {
        $de = date('Y-m-d', strtotime($request->de));
        $ate = date('Y-m-d', strtotime($request->ate));

        if ($request->tipo == 'preco') {

            $estatisticas = Fornecedor::leftJoin('compras', 'compras.fornecedor_id', 'fornecedores.id')
                ->leftJoin('compra_produto', 'compra_produto.compra_id', 'compras.id')
                ->select(
                    'fornecedores.fornecedor',
                    Fornecedor::raw(
                        'CAST(SUM(compra_produto.quantidade * compra_produto.preco_compra) AS DECIMAL(20, 2)) AS valor'
                    )
                )
                ->whereBetween('compras.data', [$de, $ate])
                ->where('compras.entrada', 1)
                ->orderByRaw('SUM(compra_produto.quantidade * compra_produto.preco_compra) DESC')
                ->groupBy('fornecedores.id')
                ->limit(5)
                ->get()
                ->toArray();

            return response()->json($estatisticas);
        } else {
            if ($request->tipo == 'quantidade') {

                $estatisticas = Fornecedor::leftJoin('compras', 'compras.fornecedor_id', 'fornecedores.id')
                    ->leftJoin('compra_produto', 'compra_produto.compra_id', 'compras.id')
                    ->select(
                        'fornecedores.fornecedor',
                        Fornecedor::raw(
                            'SUM(compra_produto.quantidade) AS valor'
                        )
                    )
                    ->whereBetween('compras.data', [$de, $ate])
                    ->where('compras.entrada', 1)
                    ->orderByRaw('SUM(compra_produto.quantidade * compra_produto.preco_compra) DESC')
                    ->groupBy('fornecedores.id')
                    ->limit(5)
                    ->get()
                    ->toArray();

                return response()->json($estatisticas);
            }
        }
    }
}
