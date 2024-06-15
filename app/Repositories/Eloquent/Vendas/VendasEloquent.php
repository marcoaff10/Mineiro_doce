<?php

namespace App\Repositories\Eloquent\Vendas;

use App\DTO\ProdutosVenda\UpdateProdutosVenda;
use App\DTO\ProdutosVenda\CreateProdutosVenda;
use App\DTO\Vendas\CreateVendas;
use App\DTO\Vendas\UpdateVendas;
use App\Models\Venda;
use App\Models\VendaProduto;
use App\Repositories\Contracts\PaginationInterface;
use App\Repositories\Contracts\PaginationPresenter;
use App\Repositories\Contracts\Vendas\VendasInterface;
use stdClass;

class VendasEloquent implements VendasInterface
{
    public function __construct(protected Venda $model)
    {
    }

    //=====================================================================
    public function paginate(int $page = 1, int $totalPerPage = 15, string $filter = null): PaginationInterface
    {
        $result = $this->model->leftJoin('venda_produto', 'venda_produto.venda_id', 'vendas.id')
            ->join('clientes', 'clientes.id', 'vendas.cliente_id')
            ->select(
                'vendas.id',
                'vendas.venda',
                'vendas.ativa',
                'vendas.saida',
                'clientes.cliente',
                $this->model->raw(
                    'COUNT(venda_produto.id) AS produtos'
                ),
                $this->model->raw(
                    'CAST(SUM(venda_produto.quantidade * venda_produto.preco_venda) AS DECIMAL(20, 2))  AS valor'
                )
            )
            ->groupBy('vendas.id')
            ->where('vendas.saida', 0)
            ->where('vendas.ativa', 1)
            ->where(function ($query) use ($filter) {
                if ($filter) {
                    $query->where('cliente', 'like', "%$filter%");
                    $query->orWhere('venda', 'like', "%$filter%");
                    $query->orWhere('saida', 'like', "%$filter%");
                    $query->orWhere('ativa', 'like', "%$filter%");
                }
            })
            ->paginate($totalPerPage, ['*'], 'page', $page);
        return new PaginationPresenter($result);
    }

    //=====================================================================
    public function getAll(int $page = 1, int $totalPerPage = 15, string $filter = null): PaginationInterface
    {
        $result = $this->model->leftJoin('venda_produto', 'venda_produto.venda_id', 'vendas.id')
            ->join('clientes', 'clientes.id', 'vendas.cliente_id')
            ->select(
                'vendas.id',
                'vendas.venda',
                'vendas.ativa',
                'vendas.saida',
                'clientes.cliente',
                $this->model->raw(
                    'COUNT(venda_produto.id) AS produtos'
                ),
                $this->model->raw(
                    'CAST(SUM(venda_produto.quantidade * venda_produto.preco_venda) AS DECIMAL(20, 2))  AS valor'
                )
            )
            ->groupBy('vendas.id')
            ->where('vendas.ativa', 0)
            ->where('vendas.saida', 0)
            ->where(function ($query) use ($filter) {
                if ($filter) {
                    $query->where('cliente', 'like', "%$filter%");
                    $query->orWhere('venda', 'like', "%$filter%");
                    $query->orWhere('saida', 'like', "%$filter%");
                    $query->orWhere('ativa', 'like', "%$filter%");
                }
            })
            ->paginate($totalPerPage, ['*'], 'page', $page);
        return new PaginationPresenter($result);
    }

    //=====================================================================
    public function vendasFechadas(int $page = 1, int $totalPerPage = 15, string $filter = null): PaginationInterface
    {
        $result = $this->model->leftJoin('venda_produto', 'venda_produto.venda_id', 'vendas.id')
            ->join('clientes', 'clientes.id', 'vendas.cliente_id')
            ->select(
                'vendas.id',
                'vendas.venda',
                'vendas.ativa',
                'vendas.saida',
                'clientes.cliente',
                $this->model->raw(
                    'COUNT(venda_produto.id) AS produtos'
                ),
                $this->model->raw(
                    'CAST(SUM(venda_produto.quantidade * venda_produto.preco_venda) AS DECIMAL(20, 2))  AS valor'
                )
            )
            ->groupBy('vendas.id')
            ->where('vendas.saida', 1)
            ->where(function ($query) use ($filter) {
                if ($filter) {
                    $query->where('cliente', 'like', "%$filter%");
                    $query->orWhere('venda', 'like', "%$filter%");
                    $query->orWhere('saida', 'like', "%$filter%");
                    $query->orWhere('ativa', 'like', "%$filter%");
                }
            })
            ->paginate($totalPerPage, ['*'], 'page', $page);
        return new PaginationPresenter($result);
    }

    //=====================================================================
    public function findOne(string $id)
    {
        $venda = $this->model->leftJoin('venda_produto', 'vendas.id', 'venda_produto.venda_id')
            ->join('produtos', 'produtos.id', 'venda_produto.produto_id')
            ->join('clientes', 'clientes.id', 'vendas.cliente_id')
            ->select(
                'vendas.id',
                'vendas.venda',
                'vendas.frete',
                'vendas.ativa',
                'vendas.saida',
                'vendas.created_at',
                'vendas.updated_at',
                'venda_produto.preco_venda',
                'venda_produto.produto_id',
                'venda_produto.quantidade',
                'clientes.cliente',
                'produtos.produto'
            )
            ->where('vendas.id', $id)->get();
        if (!$venda) return null;

        return arrayToObject($venda);
    }

    //=====================================================================
    public function store(CreateVendas $dto): stdClass
    {
        $venda = $this->model->create(
            [
                'venda' => 'Venda_' . uniqid(),
                'cliente_id' => $dto->cliente_id,
                'ativa' => 1,
                'data' => date('Y-m-d')
            ]
        );

        return (object) $venda->toArray();
    }

    //=====================================================================
    public function storeProdutos(CreateProdutosVenda $dto): stdClass
    {

        if (str_contains($dto->preco_venda, ',')) {
            $preco = explode(',', $dto->preco_venda);
            $preco = $preco[0] . '.' . $preco[1];
        }

        $venda = VendaProduto::create(
            [
                'venda_id' => $dto->venda_id,
                'produto_id' => $dto->produto_id,
                'preco_venda' => $preco ?? $dto->preco_venda,
                'quantidade' => $dto->quantidade
            ]
        );

        return (object) $venda->toArray();
    }

    //=====================================================================
    public function update(UpdateVendas $dto): stdClass|null
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
    public function updateProdutos(UpdateProdutosVenda $dto): stdClass|null
    {

        if (str_contains($dto->preco_venda, ',')) {
            $preco = explode(',', $dto->preco_venda);
            $preco = $preco[0] . '.' . $preco[1];
        }

        $venda = VendaProduto::where('venda_id', $dto->venda_id)->where('produto_id', $dto->produto_id)->first();

        if (!$venda) return null;

        $venda->update(
            [
                'venda_id' => $dto->venda_id,
                'produto_id' => $dto->produto_id,
                'preco_venda' => $preco ?? $dto->preco_venda,
                'quantidade' => $dto->quantidade

            ]
        );

        return (object) $venda->toArray();
    }

    //=====================================================================
    public function delete(string $id): void
    {
        $this->model->findOrFail($id)->delete();
    }
}
