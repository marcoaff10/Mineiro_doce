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

        $fornecedor = $this->model->where('id_fornecedor', $id)->first();

        if (!$fornecedor) return null;

        return (object) $fornecedor->toArray();
    }

    //=====================================================================
    public function store(CreateFornecedores $dto): void
    {
        $this->model->insert([
            'fornecedor' => $dto->fornecedor,
            'email' => $dto->email,
            'cnpj' => $dto->cnpj,
            'telefone' => $dto->telefone,
            'cidade' => $dto->cidade,
            'uf' => $dto->uf,
            'cep' => $dto->cep,
            'endereco' => $dto->endereco,
            'bairro' => $dto->bairro,
            'num' => $dto->num,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }

    //=====================================================================
    public function update(UpdateFornecedores $dto): stdClass|null
    {
        $fornecedor = $this->model->find($dto->id);
        if (!$fornecedor) return null;

        $fornecedor->update(
            [
                'fornecedor' => $dto->fornecedor,
                'email' => $dto->email,
                'cnpj' => $dto->cnpj,
                'telefone' => $dto->telefone,
                'cidade' => $dto->cidade,
                'uf' => $dto->uf,
                'cep' => $dto->cep,
                'endereco' => $dto->endereco,
                'bairro' => $dto->bairro,
                'num' => $dto->num,
                'updated_at' => date('Y-m-d H:i:s')
            ]
        );

        return (object) $fornecedor->toArray();
    }

    //=====================================================================
    public function delete(string $id): void
    {
        $fornecedor = $this->model->findOrFail($id);

        $fornecedor->update([
            'deleted_at' => date('Y-m-d H:i:s')
        ]);
    }
}
