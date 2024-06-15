<?php


namespace App\Repositories\Eloquent\Home;


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
    public function lucroTotal($request)
    {
        $de = date('Y-m-d', strtotime($request->de));
        $ate = date('Y-m-d', strtotime($request->ate));

        $receitas = VendaProduto::leftJoin('vendas', 'vendas.id', 'venda_produto.venda_id')
            ->leftJoin('compra_produto', 'compra_produto.produto_id', 'venda_produto.produto_id')
            ->leftJoin('compras', 'compras.id', 'compra_produto.compra_id')
            ->select(
                VendaProduto::raw(
                    'CAST(
                        SUM(venda_produto.quantidade * venda_produto.preco_venda) -
                        SUM(compra_produto.quantidade * compra_produto.preco_compra) - 
                        SUM(compras.frete) - SUM(vendas.frete)
                        AS DECIMAL(20, 2)
                    ) AS lucro_total'
                ),

                VendaProduto::raw(
                    'CAST(
                        SUM(venda_produto.quantidade * venda_produto.preco_venda)
                        AS DECIMAL(20, 2)
                    ) AS receita_total'
                ),

                VendaProduto::raw(
                    'CAST(
                        SUM(compra_produto.quantidade * compra_produto.preco_compra) +
                        SUM(compras.frete) - SUM(vendas.frete)
                        AS DECIMAL(20, 2)
                    ) AS custo_total'
                )

            )
            ->where(function ($query) use ($de, $ate) {
                if ($de && $ate) {
                    return $query->where('vendas.data', '>=', $de);
                    return $query->where('vendas.data', '<=', $ate);
                    return $query->where('compras.data', '>=', $de);
                    return $query->where('compras.data', '<=', $ate);
                }
            })
            ->orderBy('vendas.created_at', 'desc')
            ->first();
        return response()->json($receitas);
    }
}
