<?php

namespace App\Services\Compras;

use App\DTO\Compras\CreateCompras;
use App\DTO\ProdutosCompra\CreateProdutosCompra;
use App\DTO\Compras\UpdateCompras;
use App\DTO\ProdutosCompra\UpdateProdutosCompra;
use App\Repositories\Contracts\Compras\ComprasInterface;
use App\Repositories\Contracts\PaginationInterface;
use stdClass;

class CompraService
{
    public function __construct(protected ComprasInterface $compra_interface)
    {
    }

    //=====================================================================
    public function paginate(int $page = 1, int $totalPerPage = 15, string $filter = null): PaginationInterface
    {
        return $this->compra_interface->paginate(
            page: $page,
            totalPerPage: $totalPerPage,
            filter: $filter
        );
    }
    //=====================================================================
    public function getAll(string $filter = null): array
    {
        return $this->compra_interface->getAll();
    }

    //=====================================================================
    public function findOne(string $id)
    {
        return $this->compra_interface->findOne($id);
    }

    //=====================================================================
    public function store(CreateCompras $dto): stdClass
    {
        return $this->compra_interface->store($dto);
    }

    //=====================================================================
    public function storeProdutos(CreateProdutosCompra $dto): stdClass
    {
        return $this->compra_interface->storeProdutos($dto);
    }

    //=====================================================================
    public function update(UpdateCompras $dto): stdClass|null
    {
        return $this->compra_interface->update($dto);
    }

    //=====================================================================
    public function updateProdutos(UpdateProdutosCompra $dto): stdClass|null
    {
        return $this->compra_interface->updateProdutos($dto);
    }

    //=====================================================================
    public function delete(string $id): void
    {
        $this->compra_interface->delete($id);
    }
}
