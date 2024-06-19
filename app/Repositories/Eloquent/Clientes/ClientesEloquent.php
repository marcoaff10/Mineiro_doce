<?php

namespace App\Repositories\Eloquent\Clientes;

use App\DTO\Clientes\CreateClientes;
use App\DTO\Clientes\UpdateClientes;
use App\Models\Cliente;
use App\Models\Venda;
use App\Repositories\Contracts\Clientes\ClientesInterface;
use App\Repositories\Contracts\PaginationInterface;
use App\Repositories\Contracts\PaginationPresenter;
use stdClass;

class ClientesEloquent implements ClientesInterface
{
    public function __construct(protected Cliente $model)
    {
    }

    //=====================================================================
    public function paginate(int $page = 1, int $totalPerPage = 15, string $filter = null): PaginationInterface
    {
        $result = $this->model
            ->where('ativa', 1)
            ->where(function ($query) use ($filter) {
                if ($filter) {
                    $query->where('cliente', 'like', "%$filter%");
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
    public function paginateInativados(int $page = 1, int $totalPerPage = 15, string $filter = null): PaginationInterface
    {
        $result = $this->model
            ->where('ativa', 0)
            ->where(function ($query) use ($filter) {
                if ($filter) {
                    $query->where('cliente', 'like', "%$filter%");
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
    public function findOne(string $id): stdClass|null
    {

        $cliente = $this->model->where('id', $id)->first();

        if (!$cliente) return null;

        return (object) $cliente->toArray();
    }

    //=====================================================================
    public function vendasAtivasCliente(string $id, int $page = 1, int $totalPerPage = 15, ?string $filter = null): PaginationInterface
    {
        $ativas = Venda::leftJoin('venda_produto', 'venda_produto.venda_id', 'vendas.id')
            ->select(
                'vendas.id',
                'vendas.ativa',
                'vendas.venda',
                'vendas.saida',
                'vendas.frete',
                'vendas.created_at',
                Venda::raw(
                    'CAST(SUM(venda_produto.quantidade * venda_produto.preco_venda) AS DECIMAL(20, 2))  AS valor'
                )
            )
            ->groupBy('vendas.id')
            ->where('cliente_id', $id)
            ->where('saida', 0)
            ->where('ativa', 1)
            ->paginate($totalPerPage, ['*'], 'page', $page);


        return new PaginationPresenter($ativas);
    }

    //=====================================================================
    public function vendasFechadasCliente(string $id, int $page = 1, int $totalPerPage = 15, ?string $filter = null): PaginationInterface
    {
        $fechadas = Venda::leftJoin('venda_produto', 'venda_produto.venda_id', 'vendas.id')
            ->select(
                'vendas.id',
                'vendas.ativa',
                'vendas.venda',
                'vendas.saida',
                'vendas.frete',
                'vendas.created_at',
                Venda::raw(
                    'CAST(SUM(venda_produto.quantidade * venda_produto.preco_venda) AS DECIMAL(20, 2))  AS valor'
                )
            )
            ->groupBy('vendas.id')
            ->where('cliente_id', $id)
            ->where('saida', 1)
            ->where('ativa', 0)
            ->paginate($totalPerPage, ['*'], 'page', $page);


        return new PaginationPresenter($fechadas);
    }

    //=====================================================================
    public function store(CreateClientes $dto): stdClass
    {

        $cliente = $this->model->create(
            (array) $dto
        );

        return (object) $cliente->toArray();
    }

    //=====================================================================
    public function update(UpdateClientes $dto): stdClass|null
    {

        $cliente = $this->model->where('id', $dto->id)->first();
        if (!$cliente) return null;

        $cliente->update(
            (array) $dto
        );

        return (object) $cliente->toArray();
    }

    //=====================================================================
    public function delete(string $id): void
    {

        $this->model->findOrFail($id)->delete();
    }
}
