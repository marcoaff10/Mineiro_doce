<?php


namespace App\Repositories\Contracts\EntradaProdutos;

use App\DTO\EntradaProdutos\CreateEntradaProdutos;
use stdClass;

interface EntradaProdutosInterface
{
    public function store(CreateEntradaProdutos $dto): stdClass;
    public function produtosEntrada(string $id);
    public function entrada_compra(string $id): stdClass;
}