<?php

namespace App\Repositories\Eloquent;

use App\DTO\Produtos\CreateProdutos;
use App\DTO\Produtos\UpdateProdutos;
use App\Models\Produto;
use App\Repositories\Contracts\ProdutosInterface;
use stdClass;

class ProdutosEloquent implements ProdutosInterface
{
    public function __construct(protected Produto $model)
    {
    }

    //=====================================================================
    public function getAll(string $filter = null): array
    {
        // verificando se há filtro para devolver os resultados
        return $this->model
            ->where(function ($query) use ($filter) {
                if ($filter) {
                    $query->where('produto', 'like', "%$filter%");
                }
            })
            ->get()->toArray();
    }

    //=====================================================================
    public function findOne(string $id): stdClass|null
    {
        // buscando linha no banco que corresponde com o id informado
        $produto = $this->model->find($id);

        // caso não encontre informações com o id informado retorna null
        if (!$produto) return null;

        // transformando os valores de array para um objeto
        return (object) $produto->toArray();
    }

    //=====================================================================
    public function store(CreateProdutos $dto): void
    {
        // Salvando as informações no banco
        $produto = $this->model->insert(
            [
                'id_categoria' => $dto->categoria,
                'produto' => $dto->produto,
                'peso' => $dto->peso,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]

        );

       
    }

    //=====================================================================
    public function update(UpdateProdutos $dto): stdClass|null
    {
        $produto = $this->model->find($dto->id);
        if (!$produto) return null;

        $produto->update(
            (array) $dto
        );

        return (object) $produto->toArray();
    }

    //=====================================================================
    public function delete(string $id): void
    {
        $produto = $this->model->findOrFail($id);

        $produto->update([
            'deleted_at' => date('Y-m-d H:i:s')
        ]);
    }
}
