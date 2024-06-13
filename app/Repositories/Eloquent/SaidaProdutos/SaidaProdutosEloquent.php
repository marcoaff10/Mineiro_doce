<?php


namespace App\Repositories\Eloquent\SaidaProdutos;

use App\DTO\SaidaProdutos\CreateSaidaProdutos;
use App\Models\Estoque;
use App\Models\Saida_produto;
use App\Models\Venda;
use App\Models\VendaProduto;
use App\Repositories\Contracts\SaidaProdutos\SaidaProdutosInterface;
use stdClass;

class SaidaProdutosEloquent implements SaidaProdutosInterface
{
    public function __construct(protected Saida_produto $model, protected Estoque $modelEstoque)
    {
    }

    public function store(CreateSaidaProdutos $dto): stdClass
    {

        $saida = $this->model->create(
            (array) $dto
        );

        $estoque = $this->modelEstoque->where('produto_id', $dto->produto_id)->first();

        if ($estoque) {

            $quantidade = $estoque->qtde_saida + $dto->quantidade;

            $this->modelEstoque->where('id', $estoque->id)->update(
                [
                    'qtde_saida' => $quantidade
                ]
            );
        }

        return (object) $saida->toArray();
    }

    //=========================================================================================================
    public function produtoSaida(string $id)
    {
        $data = VendaProduto::leftJoin('produtos', 'venda_produto.produto_id', 'produtos.id')
            ->select(
                'produtos.produto',
                'venda_produto.quantidade',
            )
            ->where('venda_id', $id)
            ->get();

        return response()->json($data);
    }


    //=========================================================================================================
    public function saida_venda(string $id)
    {
        
        $vendas = VendaProduto::where('venda_id', $id)->select('venda_id', 'produto_id', 'quantidade')->get();
       
        foreach ($vendas as $venda) {
            $this->model->create(
                [
                    'venda_id' => $venda->venda_id,
                    'produto_id' => $venda->produto_id,
                    'quantidade' => $venda->quantidade
                ]
            );

            $estoque = $this->modelEstoque->where('produto_id', $venda->produto_id)->first();

            if ($estoque) {

                $quantidade = $estoque->qtde_saida + $venda->quantidade;

                $this->modelEstoque->where('id', $estoque->id)->update(
                    [
                        'qtde_saida' => $quantidade
                    ]
                );
            } 

            Venda::where('id', $venda->venda_id)->update(
                [
                    'saida' => 1,
                    'ativa' => 0
                ]
            );
        }

        return (object) $vendas->toArray();
    }
}
