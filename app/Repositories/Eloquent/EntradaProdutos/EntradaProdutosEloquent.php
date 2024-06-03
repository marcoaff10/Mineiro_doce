<?php

namespace App\Repositories\Eloquent\EntradaProdutos;

use App\DTO\EntradaProdutos\CreateEntradaProdutos;
use App\Models\Entrada;
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
            (array) $dto
        );

        return (object) $entrada->toArray();
    }
}