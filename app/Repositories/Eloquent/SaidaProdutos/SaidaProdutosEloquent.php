<?php


namespace App\Repositories\Eloquent\SaidaProdutos;

use App\DTO\SaidaProdutos\CreateSaidaProdutos;
use App\Models\Estoque;
use App\Models\Saida_produto;
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
}
