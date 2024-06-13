<?php

namespace App\Repositories\Eloquent\Fornecedores;

use App\Repositories\Contracts\Fornecedores\FornecedoresInterface;
use App\DTO\Fornecedores\CreateFornecedores;
use App\DTO\Fornecedores\UpdateFornecedores;
use App\Models\Compra;
use App\Models\Fornecedor;
use App\Repositories\Contracts\PaginationInterface;
use App\Repositories\Contracts\PaginationPresenter;

use stdClass;

class FornecedoresEloquent implements FornecedoresInterface
{

    public function __construct(protected Fornecedor $model)
    {
    }

    //=====================================================================
    public function paginate(int $page = 1, int $totalPerPage = 15, string $filter = null): PaginationInterface
    {
        $result = $this->model
            ->where(function ($query) use ($filter) {
                if ($filter) {
                    $query->where('fornecedor', 'like', "%$filter%");
                    $query->orWhere('email', 'like', "%$filter%");
                    $query->orWhere('cnpj', 'like', "%$filter%");
                    $query->orWhere('telefone', 'like', "%$filter%");
                    $query->orWhere('cidade', 'like', "%$filter%");
                    $query->orWhere('uf', 'like', "%$filter%");
                    $query->orWhere('cep', 'like', "%$filter%");
                }
            })
            ->paginate($totalPerPage, ['*'], 'page', $page);
        return new PaginationPresenter($result);
    }
    //=====================================================================
    public function getAll(string $filter = null): array
    {
        return $this->model
            ->where(function ($query) use ($filter) {
                if ($filter) {
                    $query->where('fornecedor', 'like', "%$filter%");
                    $query->orWhere('email', 'like', "%$filter%");
                    $query->orWhere('cnpj', 'like', "%$filter%");
                    $query->orWhere('telefone', 'like', "%$filter%");
                    $query->orWhere('cidade', 'like', "%$filter%");
                    $query->orWhere('uf', 'like', "%$filter%");
                    $query->orWhere('cep', 'like', "%$filter%");
                }
            })
            ->get()
            ->toArray();
    }

    //=====================================================================
    public function findOne(string $id): stdClass|null
    {

        $fornecedor = $this->model->where('id', $id)->first();

        if (!$fornecedor) return null;

        return (object) $fornecedor->toArray();
    }

    //=====================================================================
    public function comprasAtivasFornecedor(string $id, int $page = 1, int $totalPerPage = 15, string $filter = null): PaginationInterface
    {
        $ativas = Compra::leftJoin('compra_produto', 'compra_produto.compra_id', 'compras.id')
            ->select(
                'compras.id',
                'compras.ativa',
                'compras.compra',
                'compras.entrada',
                'compras.frete',
                'compras.created_at',
                Compra::raw(
                    'CAST(SUM(compra_produto.quantidade * compra_produto.preco_compra) AS DECIMAL(20, 2))  AS valor'
                )
            )
            ->groupBy('compras.id')
            ->where('fornecedor_id', $id)
            ->where('entrada', 0)
            ->where('ativa', 1)
            ->paginate($totalPerPage, ['*'], 'page', $page);


        return new PaginationPresenter($ativas);
    }

    //=====================================================================
    public function comprasFechadasFornecedor(string $id, int $page = 1, int $totalPerPage = 15, string $filter = null): PaginationInterface
    {
        $fechadas = Compra::leftJoin('compra_produto', 'compra_produto.compra_id', 'compras.id')
            ->select(
                'compras.id',
                'compras.ativa',
                'compras.compra',
                'compras.entrada',
                'compras.frete',
                'compras.created_at',
                Compra::raw(
                    'CAST(SUM(compra_produto.quantidade * compra_produto.preco_compra) AS DECIMAL(20, 2))  AS valor'
                )
            )
            ->groupBy('compras.id')
            ->where('fornecedor_id', $id)
            ->where('entrada', 1)
            ->where('ativa', 0)
            ->paginate($totalPerPage, ['*'], 'page', $page);


        return new PaginationPresenter($fechadas);
    }

    //=====================================================================
    public function store(CreateFornecedores $dto): stdClass
    {
        $fornecedor = $this->model->create(
            (array) $dto
        );

        return (object) $fornecedor->toArray();
    }

    //=====================================================================
    public function update(UpdateFornecedores $dto): stdClass|null
    {

        $fornecedor = $this->model->where('id', $dto->id)->first();
        if (!$fornecedor) return null;

        $fornecedor->update(
            (array) $dto
        );

        return (object) $fornecedor->toArray();
    }

    //=====================================================================
    public function delete(string $id): void
    {

        $this->model->findOrFail($id)->delete();
    }
}
