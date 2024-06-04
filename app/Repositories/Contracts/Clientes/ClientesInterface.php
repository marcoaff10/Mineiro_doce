<?php


namespace App\Repositories\Contracts\Clientes;

use App\DTO\Clientes\CreateClientes;
use App\DTO\Clientes\UpdateClientes;
use App\Repositories\Contracts\PaginationInterface;
use stdClass;

interface ClientesInterface
{
    public function paginate(int $page = 1, int $totalPerPage = 15, string $filter = null): PaginationInterface;
    public function getAll(string $filter = null): array;
    public function findOne(string $id): stdClass|null;
    public function store(CreateClientes $dto): stdClass;
    public function update(UpdateClientes $dto): stdClass|null;
    public function delete(string $id): void;
}