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

        for ($i = 0; $i < count($vendas); $i++) {
            $this->model->create(
                [
                    'venda_id' => $vendas[$i]->venda_id,
                    'produto_id' => $vendas[$i]->produto_id,
                    'quantidade' => $vendas[$i]->quantidade
                ]
            );

            $estoque = $this->modelEstoque->where('produto_id', $vendas[$i]->produto_id)->first();

            if ($estoque) {

                $quantidade = $estoque->qtde_saida + $vendas[$i]->quantidade;

                $this->modelEstoque->where('id', $estoque->id)->update(
                    [
                        'qtde_saida' => $quantidade
                    ]
                );
            } 

            Venda::where('id', $vendas[$i]->venda_id)->update(
                [
                    'saida' => 1,
                    'ativa' => 0
                ]
            );
        }

        return (object) $vendas->toArray();
    }
}
