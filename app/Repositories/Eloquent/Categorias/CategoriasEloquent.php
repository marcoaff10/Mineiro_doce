<?php

namespace App\Repositories\Eloquent\Categorias;

use App\DTO\Categorias\CreateCategorias;
use App\DTO\Categorias\UpdateCategorias;
use App\Models\Categoria;
use App\Repositories\Contracts\Categorias\CategoriasInterface;
use App\Repositories\Contracts\PaginationInterface;
use App\Repositories\Contracts\PaginationPresenter;
use stdClass;

class CategoriasEloquent implements CategoriasInterface
{

    public function __construct(protected Categoria $model)
    {
    }

    //=====================================================================
    public function paginate(int $page = 1, int $totalPerPage = 15, string $filter = null): PaginationInterface
    {
        $result = $this->model
            ->where(function ($query) use ($filter) {
                if ($filter) {
                    $query->where('categoria', 'like', "%$filter%");
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
                    $query->where('categoria', 'like', "%$filter%");
                }
            })
            ->get()
            ->toArray();
    }

    //=====================================================================
    public function findOne(string $id): stdClass|null
    {
        $categoria = $this->model->where('id', $id)->first();

        if (!$categoria) return null;

        return (object) $categoria->toArray();
    }

    //=====================================================================
    public function store(CreateCategorias $dto): stdClass
    {
        $categoria = $this->model->create(
            (array) $dto
        );

        return (object) $categoria->toArray();
    }

    //=====================================================================
    public function update(UpdateCategorias $dto): stdClass|null
    {
        $categoria = $this->model->where('id', $dto->id)->first();
        if (!$categoria) return null;

        $categoria->update(
            (array) $dto
        );

        return (object) $categoria->toArray();
    }

    //=====================================================================
    public function delete(string $id): void
    {
        $this->model->findOrFail($id)->delete();
    }
}
