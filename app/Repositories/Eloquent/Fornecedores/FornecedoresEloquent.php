<?php

namespace App\Repositories\Eloquent\Fornecedores;

use App\Repositories\Contracts\Fornecedores\FornecedoresInterface;
use App\DTO\Fornecedores\CreateFornecedores;
use App\DTO\Fornecedores\UpdateFornecedores;
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
