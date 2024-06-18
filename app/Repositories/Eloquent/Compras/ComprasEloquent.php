<?php

namespace App\Repositories\Eloquent\Compras;

use App\DTO\Compras\CreateCompras;
use App\DTO\ProdutosCompra\CreateProdutosCompra;
use App\DTO\Compras\UpdateCompras;
use App\DTO\ProdutosCompra\UpdateProdutosCompra;
use App\Models\Compra;
use App\Models\CompraProduto;
use App\Repositories\Contracts\Compras\ComprasInterface;
use App\Repositories\Contracts\PaginationInterface;
use App\Repositories\Contracts\PaginationPresenter;
use stdClass;

class ComprasEloquent implements ComprasInterface
{

    public function __construct(protected Compra $model)
    {
    }
    //=====================================================================
    public function paginate(int $page = 1, int $totalPerPage = 15, string $filter = null): PaginationInterface
    {
        $result = $this->model->leftJoin('compra_produto', 'compra_produto.compra_id', 'compras.id')
            ->join('fornecedores', 'fornecedores.id', 'compras.fornecedor_id')
            ->select(
                'compras.id',
                'compras.compra',
                'compras.ativa',
                'compras.entrada',
                'fornecedores.fornecedor',
                $this->model->raw(
                    'COUNT(compra_produto.id) AS produtos'
                ),
                $this->model->raw(
                    'CAST(SUM(compra_produto.quantidade * compra_produto.preco_compra) AS DECIMAL(20, 2))  AS valor'
                )
            )
            ->groupBy('compras.id')
            ->where('compras.entrada', 0)
            ->where('compras.ativa', 1)
            ->where(function ($query) use ($filter) {
                if ($filter) {
                    $query->where('fornecedor', 'like', "%$filter%");
                    $query->orWhere('compra', 'like', "%$filter%");
                    $query->orWhere('entrada', 'like', "%$filter%");
                    $query->orWhere('ativa', 'like', "%$filter%");
                }
            })
            ->paginate($totalPerPage, ['*'], 'page', $page);
        return new PaginationPresenter($result);
    }

    //=====================================================================
    public function getAll(int $page = 1, int $totalPerPage = 15, string $filter = null): PaginationInterface
    {
        $result = $this->model->leftJoin('compra_produto', 'compra_produto.compra_id', 'compras.id')
            ->join('fornecedores', 'fornecedores.id', 'compras.fornecedor_id')
            ->select(
                'compras.id',
                'compras.compra',
                'compras.ativa',
                'compras.entrada',
                'fornecedores.fornecedor',
                $this->model->raw(
                    'COUNT(compra_produto.id) AS produtos'
                ),
                $this->model->raw(
                    'CAST(SUM(compra_produto.quantidade * compra_produto.preco_compra) AS DECIMAL(20, 2))  AS valor'
                )
            )
            ->groupBy('compras.id')
            ->where('compras.ativa', 0)
            ->where('compras.entrada', 0)
            ->where(function ($query) use ($filter) {
                if ($filter) {
                    $query->where('fornecedor', 'like', "%$filter%");
                    $query->orWhere('compra', 'like', "%$filter%");
                    $query->orWhere('entrada', 'like', "%$filter%");
                    $query->orWhere('ativa', 'like', "%$filter%");
                }
            })
            ->paginate($totalPerPage, ['*'], 'page', $page);
        return new PaginationPresenter($result);
    }

    //=====================================================================
    public function comprasFechadas(int $page = 1, int $totalPerPage = 15, string $filter = null): PaginationInterface
    {
        $result = $this->model->leftJoin('compra_produto', 'compra_produto.compra_id', 'compras.id')
            ->join('fornecedores', 'fornecedores.id', 'compras.fornecedor_id')
            ->select(
                'compras.id',
                'compras.compra',
                'compras.ativa',
                'compras.entrada',
                'fornecedores.fornecedor',
                $this->model->raw(
                    'COUNT(compra_produto.id) AS produtos'
                ),
                $this->model->raw(
                    'CAST(SUM(compra_produto.quantidade * compra_produto.preco_compra) AS DECIMAL(20, 2))  AS valor'
                )
            )
            ->groupBy('compras.id')
            ->where('compras.entrada', 1)
            ->where(function ($query) use ($filter) {
                if ($filter) {
                    $query->where('fornecedor', 'like', "%$filter%");
                    $query->orWhere('compra', 'like', "%$filter%");
                    $query->orWhere('entrada', 'like', "%$filter%");
                    $query->orWhere('ativa', 'like', "%$filter%");
                }
            })
            ->paginate($totalPerPage, ['*'], 'page', $page);
        return new PaginationPresenter($result);
    }

    //=====================================================================
    public function findOne(string $id)
    {
        $compra = $this->model->leftJoin('compra_produto', 'compras.id', 'compra_produto.compra_id')
            ->join('produtos', 'produtos.id', 'compra_produto.produto_id')
            ->join('fornecedores', 'fornecedores.id', 'compras.fornecedor_id')
            ->select(
                'compras.id',
                'compras.compra',
                'compras.frete',
                'compras.ativa',
                'compras.entrada',
                'compras.created_at',
                'compras.updated_at',
                'compra_produto.preco_compra',
                'compra_produto.produto_id',
                'compra_produto.quantidade',
                'fornecedores.fornecedor',
                'produtos.produto'
            )
            ->where('compras.id', $id)->get();
        if (!$compra) return null;

        return arrayToObject($compra);
    }

    //=====================================================================
    public function store(CreateCompras $dto): stdClass
    {


        $compra = $this->model->create(
            [
                'compra' => 'Compra_' . uniqid(),
                'fornecedor_id' => $dto->fornecedor_id,
                'data' => date('Y-m-d')
            ]
        );

        return (object) $compra->toArray();
    }

    //=====================================================================
    public function storeProdutos(CreateProdutosCompra $dto): stdClass
    {
        if (str_contains($dto->preco_compra, ',')) {
            $preco = explode(',', $dto->preco_compra);
            $preco = $preco[0] . '.' . $preco[1];
        }

        $compra = CompraProduto::create(
            [
                'compra_id' => $dto->compra_id,
                'produto_id' => $dto->produto_id,
                'preco_compra' => $preco ?? $dto->preco_compra,
                'quantidade' => $dto->quantidade
            ]
        );

        return (object) $compra->toArray();
    }

    //=====================================================================
    public function update(UpdateCompras $dto): stdClass|null
    {

        if (str_contains($dto->frete, ',')) {
            $frete = explode(',', $dto->frete);
            $frete = $frete[0] . '.' . $frete[1];
        }

        $this->model->where('id', $dto->id)->update(
            [
                'frete' => $frete ?? $dto->frete
            ]
        );

        return null;
    }

    //=====================================================================
    public function updateProdutos(UpdateProdutosCompra $dto): stdClass|null
    {

        if (str_contains($dto->preco_compra, ',')) {
            $preco = explode(',', $dto->preco_compra);
            $preco = $preco[0] . '.' . $preco[1];
        }

        $compra = CompraProduto::where('compra_id', $dto->compra_id)->where('produto_id', $dto->produto_id)->first();

        if (!$compra) return null;

        $compra->update(
            [
                'compra_id' => $dto->compra_id,
                'produto_id' => $dto->produto_id,
                'preco_compra' => $preco ?? $dto->preco_compra,
                'quantidade' => $dto->quantidade

            ]
        );

        return (object) $compra->toArray();
    }

    //=====================================================================
    public function delete(string $id): void
    {
        $this->model->findOrFail($id)->delete();
    }

    //=====================================================================
}
