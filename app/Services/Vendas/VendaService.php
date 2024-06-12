<?php

namespace App\Services\Vendas;

use App\DTO\ProdutosVenda\UpdateProdutosVenda;
use App\DTO\ProdutosVenda\CreateProdutosVenda;
use App\DTO\Vendas\CreateVendas;
use App\DTO\Vendas\UpdateVendas;
use App\Repositories\Contracts\PaginationInterface;
use App\Repositories\Contracts\Vendas\VendasInterface;
use stdClass;

class VendaService
{

    public function __construct(protected VendasInterface $venda_interface)
    {
    }

    public function paginate(int $page = 1, int $totalPerPage = 15, string $filter = null): PaginationInterface
    {
        return $this->venda_interface->paginate(
            page: $page,
            totalPerPage: $totalPerPage,
            filter: $filter
        );
    }
    //=====================================================================
    public function getAll(int $page = 1, int $totalPerPage = 15, string $filter = null): PaginationInterface
    {
        return $this->venda_interface->getAll(
            page: $page,
            totalPerPage: $totalPerPage,
            filter: $filter
        );
    }

    //=====================================================================
    public function vendasFechadas(int $page = 1, int $totalPerPage = 15, string $filter = null): PaginationInterface
    {
        return $this->venda_interface->vendasFechadas(
            page: $page,
            totalPerPage: $totalPerPage,
            filter: $filter
        );
    }

    //=====================================================================
    public function findOne(string $id)
    {
        return $this->venda_interface->findOne($id);
    }

    //=====================================================================
    public function store(CreateVendas $dto): stdClass
    {
        return $this->venda_interface->store($dto);
    }

    //=====================================================================
    public function storeProdutos(CreateProdutosVenda $dto): stdClass
    {
        return $this->venda_interface->storeProdutos($dto);
    }

    //=====================================================================
    public function update(UpdateVendas $dto): stdClass|null
    {
        return $this->venda_interface->update($dto);
    }

    //=====================================================================
    public function updateProdutos(UpdateProdutosVenda $dto): stdClass|null
    {
        return $this->venda_interface->updateProdutos($dto);
    }

    //=====================================================================
    public function delete(string $id): void
    {
        $this->venda_interface->delete($id);
    }
}
