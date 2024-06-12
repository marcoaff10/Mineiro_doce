<?php


namespace App\Repositories\Contracts\Vendas;

use App\DTO\ProdutosVenda\UpdateProdutosVenda;
use App\DTO\ProdutosVenda\CreateProdutosVenda;
use App\DTO\Vendas\CreateVendas;
use App\DTO\Vendas\UpdateVendas;
use App\Repositories\Contracts\PaginationInterface;
use stdClass;

interface VendasInterface
{
    public function paginate(int $page = 1, int $totalPerPage = 15, string $filter = null): PaginationInterface;
    public function getAll(int $page = 1, int $totalPerPage = 15, string $filter = null): PaginationInterface;
    public function vendasFechadas(int $page = 1, int $totalPerPage = 15, string $filter = null): PaginationInterface;
    public function findOne(string $id);
    public function store(CreateVendas $dto): stdClass;
    public function storeProdutos(CreateProdutosVenda $dto): stdClass;
    public function update(UpdateVendas $dto): stdClass|null;
    public function updateProdutos(UpdateProdutosVenda $dto): stdClass|null;
    public function delete(string $id): void;
}