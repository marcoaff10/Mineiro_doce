<?php

namespace App\Repositories\Eloquent\Produtos;

use App\DTO\Produtos\CreateProdutos;
use App\DTO\Produtos\UpdateProdutos;
use App\Models\Entrada_produto;
use App\Models\Estoque;
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
        $result = $this->model->leftJoin('estoque', 'produtos.id', 'estoque.produto_id')
            ->join('categorias', 'categorias.id', 'produtos.categoria_id')
            ->select(
                'produtos.id',
                'produtos.produto',
                'produtos.peso',
                'produtos.minimo',
                'produtos.maximo',
                'categorias.categoria',
                $this->model->raw('SUM(estoque.qtde_entrada) AS entrada'),
                $this->model->raw('SUM(estoque.qtde_saida) AS saida'),
                $this->model->raw('CAST((SUM(estoque.qtde_entrada) - SUM(estoque.qtde_saida)) AS DECIMAL(20, 0)) AS estoque'),
            )
            ->orderByRaw('CAST((SUM(estoque.qtde_entrada) - SUM(estoque.qtde_saida)) AS DECIMAL(20, 0)) DESC')
            ->groupBy('produtos.id')
            ->where(function ($query) use ($filter) {
                if ($filter) {
                    $query->where('produto', 'like', "%$filter%");
                    $query->orWhere('categoria', 'like', "%$filter%");
                    $query->orWhere('peso', 'like', "%$filter%");
                    $query->orWhere('minimo', 'like', "%$filter%");
                    $query->orWhere('maximo', 'like', "%$filter%");
                    $query->orHavingRaw(
                        "CAST((SUM(estoque.qtde_entrada) - SUM(estoque.qtde_saida)) AS DECIMAL(20, 0)) like %$filter%"
                    );

                }
            })
            ->paginate($totalPerPage, ['*'], 'page', $page);

        return new PaginationPresenter($result);
    }  

    //=====================================================================
    public function getAll(string $filter = null): array
    {

        $result = $this->model->leftJoin('entrada_produto', 'produtos.id', 'entrada_produto.produto_id')
            ->leftJoin('saida_produto', 'produtos.id', 'saida_produto.produto_id')
            ->join('categorias', 'produtos.categoria_id', 'categorias.id')
            ->select(
                'produtos.id',
                $this->model->raw(
                    "SUM(CASE WHEN entrada_produto.quantidade IS NULL THEN 0 ELSE entrada_produto.quantidade END) - SUM(CASE WHEN saida_produto.quantidade IS NULL THEN 0 ELSE saida_produto.quantidade END) as estoque"
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
                    $query->orWhere('maximo', 'like', "%$filter%");

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
            'entrada' => $this->model->leftJoin('entrada_produto', 'produtos.id', '=', 'entrada_produto.produto_id')
                            ->join('entradas', 'entradas.id', 'entrada_produto.entrada_id')
                            ->join('fornecedores', 'fornecedores.id', 'entrada_produto.fornecedor_id')
                            ->join('categorias', 'categorias.id', 'produtos.categoria_id')
                            ->select(
                                $this->model->raw('produtos.id AS id_produto'),
                                'produtos.produto',
                                'produtos.peso',
                                'produtos.minimo',
                                $this->model->raw('produtos.created_at AS created_produto'),
                                $this->model->raw('produtos.updated_at AS updated_produto'),
                                'entrada_produto.quantidade',
                                'entrada_produto.valor_unidade',
                                'entrada_produto.frete',
                                'entrada_produto.valor_total',
                                $this->model->raw('entrada_produto.created_at AS dt_entrada'),
                                'entradas.motivo',
                                'fornecedores.fornecedor'
                            )
                            ->where('produtos.id', $id)->first(),

            'saida' => $this->model->leftJoin('saida_produto', 'saida_produto.produto_id', 'produtos.id')
                                ->join('saidas', 'saidas.id', 'saida_produto.saida_id')
                                ->join('clientes', 'clientes.id', 'saida_produto.cliente_id')
                                ->join('categorias', 'categorias.id', 'produtos.categoria_id')
                                ->select(
                                    $this->model->raw('produtos.id AS id_produto'),
                                    'produtos.produto',
                                    'produtos.peso',
                                    'produtos.minimo',
                                    'saida_produto.quantidade',
                                    'saida_produto.valor_unidade',
                                    'saida_produto.frete',
                                    'saida_produto.valor_total',
                                    $this->model->raw('saida_produto.created_at AS dt_saida'),
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
