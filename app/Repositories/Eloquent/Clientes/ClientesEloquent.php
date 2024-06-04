<?php

namespace App\Repositories\Eloquent\Clientes;

use App\DTO\Clientes\CreateClientes;
use App\DTO\Clientes\UpdateClientes;
use App\Models\Cliente;
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
    public function getAll(string $filter = null): array
    {
        return $this->model
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
            ->get()
            ->toArray();
    }

    //=====================================================================
    public function findOne(string $id): stdClass|null
    {

        $cliente = $this->model->where('id', $id)->first();

        if (!$cliente) return null;

        return (object) $cliente->toArray();
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
