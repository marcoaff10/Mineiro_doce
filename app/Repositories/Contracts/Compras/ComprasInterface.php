<?php


namespace App\Repositories\Contracts\Compras;

use App\DTO\Compras\CreateCompras;
use App\DTO\ProdutosCompra\CreateProdutosCompra;
use App\DTO\Compras\UpdateCompras;
use App\DTO\ProdutosCompra\UpdateProdutosCompra;
use App\Repositories\Contracts\PaginationInterface;
use stdClass;

interface ComprasInterface
{
    public function paginate(int $page = 1, int $totalPerPage = 15, string $filter = null): PaginationInterface;
    public function getAll(int $page = 1, int $totalPerPage = 15, string $filter = null): PaginationInterface;
    public function comprasFechadas(int $page = 1, int $totalPerPage = 15, string $filter = null): PaginationInterface;
    public function findOne(string $id);
    public function store(CreateCompras $dto): stdClass;
    public function storeProdutos(CreateProdutosCompra $dto): stdClass;
    public function update(UpdateCompras $dto): stdClass|null;
    public function updateProdutos(UpdateProdutosCompra $dto): stdClass|null;
    public function delete(string $id): void;
}