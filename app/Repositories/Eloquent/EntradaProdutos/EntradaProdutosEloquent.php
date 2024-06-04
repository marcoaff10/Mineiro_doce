<?php

namespace App\Repositories\Eloquent\EntradaProdutos;

use App\DTO\EntradaProdutos\CreateEntradaProdutos;
use App\Models\Entrada;
use App\Models\Entrada_produto;
use App\Repositories\Contracts\EntradaProdutos\EntradaProdutosInterface;
use stdClass;

class EntradaProdutosEloquent implements EntradaProdutosInterface
{
    public function __construct(protected Entrada $model)
    {}

    //=========================================================================================================
    public function store(CreateEntradaProdutos $dto): stdClass
    {

        $entrada = $this->model->create(
            [
                'motivo' => $dto->motivo,
            ]
        );
        $id = $this->model->select('id')->orderBy('created_at', 'DESC')->first();
        
        Entrada_produto::create(
            [
                'entrada_id' => $id->id,
                'fornecedor_id' => $dto->fornecedor_id,
                'produto_id' => $dto->produto_id,
                'quantidade' => $dto->quantidade,
                'valor_unidade' => $dto->valor_unidade,
                'frete' => $dto->frete,
                'valor_total' => $dto->valor_total,
            ]
            );

        return (object) $entrada->toArray();
    }
}