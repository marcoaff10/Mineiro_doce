<?php

namespace App\Repositories\Contracts\Produtos;

use App\DTO\Produtos\CreateProdutos;
use App\DTO\Produtos\UpdateProdutos;
use App\Repositories\Contracts\PaginationInterface;
use stdClass;

interface ProdutosInterface
{
    public function paginate(int $page = 1, int $totalPerPage = 15, string $filter = null): PaginationInterface;
    public function paginateInativos(int $page = 1, int $totalPerPage = 15, string $filter = null): PaginationInterface;
    public function findOne(string $id): stdClass|null;
    public function paginateEntradas(string $id, int $page = 1, int $totalPerPage = 15, string $filter = null): PaginationInterface;
    public function paginateSaidas(string $id, int $page = 1, int $totalPerPage = 15, string $filter = null): PaginationInterface;
    public function store(CreateProdutos $dto): stdClass;
    public function update(UpdateProdutos $dto): stdClass|null;
    public function delete(string $id): void;

}