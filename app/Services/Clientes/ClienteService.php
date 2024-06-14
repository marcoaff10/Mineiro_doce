<?php

namespace App\Services\Clientes;

use App\DTO\Clientes\CreateClientes;
use App\DTO\Clientes\UpdateClientes;
use App\Repositories\Contracts\Clientes\ClientesInterface;
use App\Repositories\Contracts\PaginationInterface;
use stdClass;

class ClienteService
{
    public function __construct(protected ClientesInterface $clientes_interface)
    {
    }

    //=====================================================================
    public function paginate(int $page = 1, int $totalPerPage = 15, string $filter = null): PaginationInterface
    {
        return $this->clientes_interface->paginate(
            page: $page,
            totalPerPage: $totalPerPage,
            filter: $filter
        );
    }
    //=====================================================================
    public function getAll(string $filter = null): array
    {
        return $this->clientes_interface->getAll();
    }

    //=====================================================================
    public function findOne(string $id): stdClass|null
    {
        return $this->clientes_interface->findOne($id);
    }

    //=====================================================================
    public function vendasAtivasCliente(string $id, int $page = 1, int $totalPerPage = 15, string $filter = null): PaginationInterface
    {
        return $this->clientes_interface->vendasAtivasCliente(
            id: $id,
            page: $page,
            totalPerPage: $totalPerPage,
            filter: $filter
        );
    }

    //=====================================================================
    public function vendasFechadasCliente(string $id, int $page = 1, int $totalPerPage = 15, string $filter = null): PaginationInterface
    {
        return $this->clientes_interface->vendasFechadasCliente(
            id: $id,
            page: $page,
            totalPerPage: $totalPerPage,
            filter: $filter
        );
    }

    //=====================================================================
    public function store(CreateClientes $dto): stdClass
    {
        return $this->clientes_interface->store($dto);
    }

    //=====================================================================
    public function update(UpdateClientes $dto): stdClass|null
    {
        return $this->clientes_interface->update($dto);
    }

    //=====================================================================
    public function delete(string $id): void
    {
        $this->clientes_interface->delete($id);
    }
}
