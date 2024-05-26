<?php

namespace App\Repositories\Contracts;

use App\DTO\Produtos\CreateProdutos;
use App\DTO\Produtos\UpdateProdutos;
use stdClass;

interface ProdutosInterface
{
    public function getAll(): array;
    public function findOne(string $id): stdClass|null;
    public function store(CreateProdutos $dto): void;
    public function update(UpdateProdutos $dto): stdClass|null;
    public function delete(string $id): void;

}