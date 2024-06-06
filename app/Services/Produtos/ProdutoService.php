<?php

namespace App\Services\Produtos;

use App\DTO\Produtos\CreateProdutos;
use App\DTO\Produtos\UpdateProdutos;
use App\Repositories\Contracts\PaginationInterface;
use App\Repositories\Contracts\Produtos\ProdutosInterface;
use stdClass;

class ProdutoService
{

    public function __construct(protected ProdutosInterface $produto_interface){}

    //=====================================================================
    public function paginate(int $page = 1, int $totalPerPage = 15, string $filter = null): PaginationInterface
    {
        return $this->produto_interface->paginate(
            page: $page,
            totalPerPage: $totalPerPage,
            filter: $filter
        );
    }
    
    //=====================================================================
    public function getAll(string $filter = null): array
    {
        return $this->produto_interface->getAll($filter);
    }

    //=====================================================================
    public function findOne(string $id): stdClass|null
    {
        return $this->produto_interface->findOne($id);
    }

    //=====================================================================
    public function store(CreateProdutos $dto):stdClass
    {
        return $this->produto_interface->store($dto);
    }

    //=====================================================================
    public function update(UpdateProdutos $dto): stdClass|null
    {
        return $this->produto_interface->update($dto);
    }

    //=====================================================================
    public function delete(string $id):void
    {
        $this->produto_interface->delete($id);
    }
}