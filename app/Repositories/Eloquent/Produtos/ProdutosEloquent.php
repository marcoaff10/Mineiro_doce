<?php

namespace App\Repositories\Eloquent\Produtos;

use App\DTO\Produtos\CreateProdutos;
use App\DTO\Produtos\UpdateProdutos;
use App\Models\Entrada_produto;
use App\Models\Produto;
use App\Repositories\Contracts\PaginationInterface;
use App\Repositories\Contracts\PaginationPresenter;
use App\Repositories\Contracts\Produtos\ProdutosInterface;
use stdClass;

class ProdutosEloquent implements ProdutosInterface
{
    public function __construct(protected Produto $model)
    {
    }

    //=====================================================================
    public function paginate(int $page = 1, int $totalPerPage = 15, ?string $filter = null): PaginationInterface
    {
        $result = $this->model->leftJoin('entradas_produtos', 'produtos.id', 'entradas_produtos.produto_id')
            ->leftJoin('categorias', 'produtos.categoria_id', 'categorias.id')
            ->select('produtos.id', Entrada_produto::raw("SUM(entradas_produtos.quantidade) as quantidade"), 'produtos.produto', 'produtos.peso', 'produtos.minimo', 'categorias.categoria')
            ->groupBy('produtos.id')
            ->where(function ($query) use ($filter) {
                if ($filter) {
                    $query->where('produto', 'like', "%$filter%");
                    $query->orWhere('categoria', 'like', "%$filter%");
                    $query->orWhere('peso', 'like', "%$filter%");
                    $query->orWhere('quantidade', 'like', "%$filter%");
                    $query->orWhere('minimo', 'like', "%$filter%");
                }
            })
            ->paginate($totalPerPage, ['*'], 'page', $page);



        return new PaginationPresenter($result);
    }

    //=====================================================================
    public function getAll(string $filter = null): array
    {

        $result = $this->model->leftJoin('categorias', 'produtos.categoria_id', '=', 'categorias.id')
            ->leftJoin('entradas', 'produtos.id', '=', 'entradas.produto_id')
            ->select('produtos.*', 'categorias.categoria', 'entradas.quantidade')
            ->where(function ($query) use ($filter) {
                if ($filter) {
                    $query->where('produto', 'like', "%$filter%");
                    $query->orWhere('categoria', 'like', "%$filter%");
                    $query->orWhere('peso', 'like', "%$filter%");
                    $query->orWhere('minimo', 'like', "%$filter%");
                }
            })
            ->get();

        return $result->toArray();
    }

    //=====================================================================
    public function findOne(string $id): stdClass|null
    {

        // buscando linha no banco que corresponde com o id informado
        $produto = $this->model->leftJoin('categorias', 'produtos.categoria_id', '=', 'categorias.id')
            ->leftJoin('entradas', 'produtos.id', '=', 'entradas.produto_id')
            ->select('produtos.*', 'categorias.categoria', 'entradas.motivo', 'entradas.quantidade.')
            ->where('produtos.id', $id)->first();


        // caso não encontre informações com o id informado retorna null
        if (!$produto) return null;

        // transformando os valores de array para um objeto
        return (object) $produto->toArray();
    }

    //=====================================================================
    public function store(CreateProdutos $dto): stdClass
    {

        // Salvando as informações no banco
        $produto = $this->model->create(
            (array) $dto

        );

        return (object) $produto->toArray();
    }

    //=====================================================================
    public function update(UpdateProdutos $dto): stdClass|null
    {
        $produto = $this->model->where('id', $dto->id)->first();
        if (!$produto) return null;

        $produto->update(
            (array) $dto
        );

        return (object) $produto->toArray();
    }

    //=====================================================================
    public function delete(string $id): void
    {
        $this->model->findOrFail($id)->delete();
    }
}
