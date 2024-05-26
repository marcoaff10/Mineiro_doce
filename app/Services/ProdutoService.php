<?php

namespace App\Services;

use App\DTO\Produtos\CreateProdutos;
use App\DTO\Produtos\UpdateProdutos;
use App\Repositories\Contracts\ProdutosInterface;
use stdClass;

class ProdutoService
{

    public function __construct(protected ProdutosInterface $produto_interface){}

    //=====================================================================
    public function getAll(): array
    {
        return $this->produto_interface->getAll();
    }

    //=====================================================================
    public function findOne(string $id): stdClass|null
    {
        return $this->produto_interface->findOne($id);
    }

    //=====================================================================
    public function store(CreateProdutos $dto):void
    {
        $this->produto_interface->store($dto);
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