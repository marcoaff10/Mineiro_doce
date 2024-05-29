<?php


namespace App\Repositories\Contracts\Categorias;

use App\DTO\Categorias\CreateCategorias;
use App\DTO\Categorias\UpdateCategorias;
use App\Repositories\Contracts\PaginationInterface;
use stdClass;

interface CategoriasInterface
{
    public function paginate(int $page = 1, int $totalPerPage = 15, string $filter = null): PaginationInterface;
    public function getAll(string $filter = null): array;
    public function findOne(string $id): stdClass|null;
    public function store(CreateCategorias $dto): stdClass;
    public function update(UpdateCategorias $dto): stdClass|null;
    public function delete(string $id): void;
}