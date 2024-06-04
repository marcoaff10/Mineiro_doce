<?php

namespace App\Repositories\Contracts\SaidaProdutos;

use App\DTO\SaidaProdutos\CreateSaidaProdutos;
use stdClass;

interface SaidaProdutosInterface
{
    public function store(CreateSaidaProdutos $dto): stdClass;
}