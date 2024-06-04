<?php

namespace App\Services\SaidaProdutos;

use App\DTO\SaidaProdutos\CreateSaidaProdutos;
use App\Repositories\Contracts\SaidaProdutos\SaidaProdutosInterface;
use stdClass;

class SaidaProdutoService
{

    public function __construct(protected SaidaProdutosInterface $saidaInterface)
    {
        
    }

    public function store(CreateSaidaProdutos $dto): stdClass
    {
        return $this->saidaInterface->store($dto);
    }
}