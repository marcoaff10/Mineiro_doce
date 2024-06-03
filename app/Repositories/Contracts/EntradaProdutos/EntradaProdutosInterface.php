<?php


namespace App\Repositories\Contracts\EntradaProdutos;

use App\DTO\EntradaProdutos\CreateEntradaProdutos;
use stdClass;

interface EntradaProdutosInterface
{
    public function store(CreateEntradaProdutos $dto): stdClass;
}