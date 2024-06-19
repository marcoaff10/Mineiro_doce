<?php

namespace App\Services\Fornecedores;

use App\DTO\Fornecedores\CreateFornecedores;
use App\DTO\Fornecedores\UpdateFornecedores;
use App\Repositories\Contracts\Fornecedores\FornecedoresInterface;
use App\Repositories\Contracts\PaginationInterface;
use stdClass;

class FornecedoreService
{
    public function __construct(protected FornecedoresInterface $fornecedor_interface)
    {
    }

    //=====================================================================
    public function paginate(int $page = 1, int $totalPerPage = 15, string $filter = null): PaginationInterface
    {
        return $this->fornecedor_interface->paginate(
            page: $page,
            totalPerPage: $totalPerPage,
            filter: $filter
        );
    }
    //=====================================================================
    public function paginateInativados(int $page = 1, int $totalPerPage = 15, string $filter = null): PaginationInterface
    {
        return $this->fornecedor_interface->paginateInativados(
            page: $page,
            totalPerPage: $totalPerPage,
            filter: $filter
        );
    }

    //=====================================================================
    public function findOne(string $id): stdClass|null
    {
        return $this->fornecedor_interface->findOne($id);
    }

    //=====================================================================
    public function comprasAtivasFornecedor(string $id, int $page = 1, int $totalPerPage = 15, string $filter = null): PaginationInterface
    {
        return $this->fornecedor_interface->comprasAtivasFornecedor(
            id: $id,
            page: $page,
            totalPerPage: $totalPerPage,
            filter: $filter
        );
    }

    //=====================================================================
    public function comprasFechadasFornecedor(string $id, int $page = 1, int $totalPerPage = 15, string $filter = null): PaginationInterface
    {
        return $this->fornecedor_interface->comprasFechadasFornecedor(
            id: $id,
            page: $page,
            totalPerPage: $totalPerPage,
            filter: $filter
        );
    }


    //=====================================================================
    public function store(CreateFornecedores $dto): stdClass
    {
        return $this->fornecedor_interface->store($dto);
    }

    //=====================================================================
    public function update(UpdateFornecedores $dto): stdClass|null
    {
        return $this->fornecedor_interface->update($dto);
    }

    //=====================================================================
    public function delete(string $id): void
    {
        $this->fornecedor_interface->delete($id);
    }
}
