<?php

namespace App\Repositories\Eloquent\EntradaProdutos;

use App\DTO\EntradaProdutos\CreateEntradaProdutos;
use App\Models\Entrada_produto;
use App\Models\Estoque;
use App\Repositories\Contracts\EntradaProdutos\EntradaProdutosInterface;
use stdClass;

class EntradaProdutosEloquent implements EntradaProdutosInterface
{
    public function __construct(protected Entrada_produto $model, protected Estoque $modelEstoque)
    {
    }

    //=========================================================================================================
    public function store(CreateEntradaProdutos $dto): stdClass
    {

        $entrada = $this->model->create(
            (array) $dto
        );

        $estoque = $this->modelEstoque->where('produto_id', $dto->produto_id)->first();

        if (!$estoque) {
            $this->modelEstoque->create(
                [
                    'produto_id' => $dto->produto_id,
                    'qtde_entrada' => $dto->quantidade,
                ]
            );
        } else {

            $quantidade = $estoque->qtde_entrada + $dto->quantidade;
         
            $this->modelEstoque->where('id', $estoque->id)->update(
                [
                    'qtde_entrada' => $quantidade
                ]
                );
        }



        return (object) $entrada->toArray();
    }
}
