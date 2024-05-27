<?php

namespace App\Repositories\Eloquent\Produtos;

use App\DTO\Produtos\CreateProdutos;
use App\DTO\Produtos\UpdateProdutos;
use App\Models\Produto;
use App\Repositories\Contracts\Produtos\ProdutosInterface;
use stdClass;

class ProdutosEloquent implements ProdutosInterface
{
    public function __construct(protected Produto $model)
    {
    }

    //=====================================================================
    public function getAll(): array
    {

        $resultado = $this->model->leftJoin('categorias', 'produtos.id_categoria', '=', 'categorias.id_categoria')->get();

        return $resultado->toArray();
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
        $this->model->insert(
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
            [
                'id_categoria' => $dto->categoria,
                'produto' => $dto->produto,
                'peso' => $dto->peso,
                'updated_at' => date('Y-m-d H:i:s')
            ]
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
