<?php

namespace App\Repositories\Contracts\Fornecedores;

use App\DTO\Fornecedores\CreateFornecedores;
use App\DTO\Fornecedores\UpdateFornecedores;
use App\Repositories\Contracts\PaginationInterface;
use stdClass;

interface FornecedoresInterface
{
    public function paginate(int $page = 1, int $totalPerPage = 15, string $filter = null): PaginationInterface;
    public function getAll(string $filter = null): array;
    public function findOne(string $id): stdClass|null;
    public function comprasAtivasFornecedor(string $id, int $page = 1, int $totalPerPage = 15, string $filter = null): PaginationInterface;
    public function comprasFechadasFornecedor(string $id, int $page = 1, int $totalPerPage = 15, string $filter = null): PaginationInterface;
    public function store(CreateFornecedores $dto): stdClass;
    public function update(UpdateFornecedores $dto): stdClass|null;
    public function delete(string $id): void;
}