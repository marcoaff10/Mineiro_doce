<?php

namespace App\Services\EntradaProdutos;

use App\DTO\EntradaProdutos\CreateEntradaProdutos;
use App\Repositories\Contracts\EntradaProdutos\EntradaProdutosInterface;
use stdClass;

class EntradaProdutoService
{
    public function __construct(protected EntradaProdutosInterface $entrada_interface){}

    //=========================================================================================================
    public function store(CreateEntradaProdutos $dto): stdClass
    {
        return $this->entrada_interface->store($dto);
    }

    //=========================================================================================================
    public function produtosEntrada(string $id)
    {
        return $this->entrada_interface->produtosEntrada($id);
    }

    //=========================================================================================================
    public function entrada_compra(string $id): stdClass
    {
        return $this->entrada_interface->entrada_compra($id);
    }

}