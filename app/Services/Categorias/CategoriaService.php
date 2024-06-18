<?php

namespace App\Services\Categorias;

use App\DTO\Categorias\CreateCategorias;
use App\DTO\Categorias\UpdateCategorias;
use App\Repositories\Contracts\Categorias\CategoriasInterface;
use App\Repositories\Contracts\PaginationInterface;
use stdClass;

class CategoriaService
{
    public function __construct(protected CategoriasInterface $categoriaInterface)
    {
    }

    //=====================================================================
    public function paginate(int $page = 1, int $totalPerPage = 15, string $filter = null): PaginationInterface
    {
        return $this->categoriaInterface->paginate(
            page: $page,
            totalPerPage: $totalPerPage,
            filter: $filter
        );
    }

    //=====================================================================
    public function paginateInativas(int $page = 1, int $totalPerPage = 15, string $filter = null): PaginationInterface
    {
        return $this->categoriaInterface->paginateInativas(
            page: $page,
            totalPerPage: $totalPerPage,
            filter: $filter
        );
    }

    //=====================================================================
    public function findOne(string $id): stdClass|null
    {
        return $this->categoriaInterface->findOne($id);
    }

    //=====================================================================
    public function store(CreateCategorias $dto): stdClass
    {
        return $this->categoriaInterface->store($dto);
    }

    //=====================================================================
    public function update(UpdateCategorias $dto): stdClass|null
    {
        return $this->categoriaInterface->update($dto);
    }

    //=====================================================================
    public function delete(string $id): void
    {
        $this->categoriaInterface->delete($id);
    }
}
