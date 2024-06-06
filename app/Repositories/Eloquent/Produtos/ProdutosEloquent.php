<?php

namespace App\Repositories\Eloquent\Produtos;

use App\DTO\Produtos\CreateProdutos;
use App\DTO\Produtos\UpdateProdutos;
use App\Models\Entrada_produto;
use App\Models\Produto;
use App\Repositories\Contracts\PaginationInterface;
use App\Repositories\Contracts\PaginationPresenter;
use App\Repositories\Contracts\Produtos\ProdutosInterface;
use Illuminate\Support\Facades\DB;
use stdClass;

use function Laravel\Prompts\select;

class ProdutosEloquent implements ProdutosInterface
{
    public function __construct(protected Produto $model)
    {
    }

    //=====================================================================
    public function paginate(int $page = 1, int $totalPerPage = 15, ?string $filter = null): PaginationInterface
    {
        $result = $this->model->leftJoin('entradas_produtos', 'produtos.id', 'entradas_produtos.produto_id')
            ->leftJoin('saidas_produtos', 'produtos.id', 'saidas_produtos.produto_id')
            ->join('categorias', 'produtos.categoria_id', 'categorias.id')
            ->select(
                'produtos.id',
                $this->model->raw(
                    "SUM(CASE WHEN entradas_produtos.quantidade IS NULL THEN 0 ELSE entradas_produtos.quantidade END) - SUM(CASE WHEN saidas_produtos.quantidade IS NULL THEN 0 ELSE saidas_produtos.quantidade END) as estoque"
                ),
                'produtos.produto',
                'produtos.peso',
                'produtos.minimo',
                'categorias.categoria'
            )
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

        $result = $this->model->leftJoin('entradas_produtos', 'produtos.id', 'entradas_produtos.produto_id')
            ->leftJoin('saidas_produtos', 'produtos.id', 'saidas_produtos.produto_id')
            ->join('categorias', 'produtos.categoria_id', 'categorias.id')
            ->select(
                'produtos.id',
                $this->model->raw(
                    "SUM(CASE WHEN entradas_produtos.quantidade IS NULL THEN 0 ELSE entradas_produtos.quantidade END) - SUM(CASE WHEN saidas_produtos.quantidade IS NULL THEN 0 ELSE saidas_produtos.quantidade END) as estoque"
                ),
                'produtos.produto',
                'produtos.peso',
                'produtos.minimo',
                'categorias.categoria'
            )
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

        $produto = [
            'entrada' => $this->model->leftJoin('entradas_produtos', 'produtos.id', '=', 'entradas_produtos.produto_id')
                            ->join('entradas', 'entradas.id', 'entradas_produtos.entrada_id')
                            ->join('fornecedores', 'fornecedores.id', 'entradas_produtos.fornecedor_id')
                            ->join('categorias', 'categorias.id', 'produtos.categoria_id')
                            ->select(
                                $this->model->raw('produtos.id AS id_produto'),
                                'produtos.produto',
                                'produtos.peso',
                                'produtos.minimo',
                                $this->model->raw('produtos.created_at AS created_produto'),
                                $this->model->raw('produtos.updated_at AS updated_produto'),
                                'entradas_produtos.quantidade',
                                'entradas_produtos.valor_unidade',
                                'entradas_produtos.frete',
                                'entradas_produtos.valor_total',
                                $this->model->raw('entradas_produtos.created_at AS dt_entrada'),
                                'entradas.motivo',
                                'fornecedores.fornecedor'
                            )
                            ->where('produtos.id', $id)->first(),

            'saida' => $this->model->leftJoin('saidas_produtos', 'saidas_produtos.produto_id', 'produtos.id')
                                ->join('saidas', 'saidas.id', 'saidas_produtos.saida_id')
                                ->join('clientes', 'clientes.id', 'saidas_produtos.cliente_id')
                                ->join('categorias', 'categorias.id', 'produtos.categoria_id')
                                ->select(
                                    $this->model->raw('produtos.id AS id_produto'),
                                    'produtos.produto',
                                    'produtos.peso',
                                    'produtos.minimo',
                                    'saidas_produtos.quantidade',
                                    'saidas_produtos.valor_unidade',
                                    'saidas_produtos.frete',
                                    'saidas_produtos.valor_total',
                                    $this->model->raw('saidas_produtos.created_at AS dt_saida'),
                                    'saidas.motivo',
                                    'clientes.cliente'
                                )
                                ->where('produtos.id', $id)->first()
        ];




        // caso não encontre informações com o id informado retorna null
        if (!$produto) return null;

        // transformando os valores de array para um objeto
        return (object) $produto;
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
