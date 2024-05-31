<?php

namespace App\Repositories\Contracts\Produtos;

use App\DTO\Produtos\CreateProdutos;
use App\DTO\Produtos\UpdateProdutos;
use App\Repositories\Contracts\PaginationInterface;
use stdClass;

interface ProdutosInterface
{
    public function paginate(int $page = 1, int $totalPerPage = 15, string $filter = null): PaginationInterface;
    public function getAll(): array;
    public function findOne(string $id): stdClass|null;
    public function store(CreateProdutos $dto): stdClass;
    public function update(UpdateProdutos $dto): stdClass|null;
    public function delete(string $id): void;

}