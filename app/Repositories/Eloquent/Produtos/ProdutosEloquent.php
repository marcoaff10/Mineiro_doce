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
                }
            })
            ->paginate($totalPerPage, ['*'], 'page', $page);

        return new PaginationPresenter($result);
    }

    //=====================================================================
    public function getAll(string $filter = null): array
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
        $produto = $this->model->where('produtos.id', $id)->leftJoin('estoque', 'estoque.produto_id', 'produtos.id')
            ->join('categorias', 'categorias.id', 'produtos.categoria_id')
            ->select(
                'produtos.*',
                'categorias.categoria',
                $this->model->raw('CAST((SUM(estoque.qtde_entrada) - SUM(estoque.qtde_saida)) AS DECIMAL(20, 0)) AS estoque')
            )
            ->groupBy('produtos.id')
            ->first();


        // caso não encontre informações com o id informado retorna null
        if (!$produto) return null;

        // transformando os valores de array para um objeto
        return (object) $produto->toArray();
    }

    //=====================================================================
    public function paginateEntradas(string $id, int $page = 1, int $totalPerPage = 15, string $filter = null): PaginationInterface
    {
        $produtoEntrada = $this->model->leftJoin('entrada_produto', 'entrada_produto.produto_id', 'produtos.id')
            ->leftJoin('fornecedores',  function ($join) {
                $join->on('fornecedores.id', 'entrada_produto.fornecedor_id')
                    ->where('entrada_produto.fornecedor_id', '!=', null);
            })
            ->select(
                'produtos.produto',
                'entrada_produto.motivo',
                'entrada_produto.quantidade',
                'entrada_produto.created_at',
                'fornecedores.fornecedor'
            )
            ->orderBy('entrada_produto.created_at')
            ->where('produtos.id', $id)
            ->paginate($totalPerPage, ['*'], 'page', $page);

        return new PaginationPresenter($produtoEntrada);
    }

    //=====================================================================
    public function paginateSaidas(string $id, int $page = 1, int $totalPerPage = 15, string $filter = null): PaginationInterface
    {
        $produtoSaida = $this->model->leftJoin('saida_produto', 'saida_produto.produto_id', 'produtos.id')
            ->leftJoin('clientes',  function ($join) {
                $join->on('clientes.id', 'saida_produto.cliente_id')
                    ->where('saida_produto.cliente_id', '!=', null);
            })
            ->select(
                'produtos.produto',
                'saida_produto.motivo',
                'saida_produto.quantidade',
                'saida_produto.created_at',
                'clientes.cliente'
            )
            ->orderBy('saida_produto.created_at')
            ->where('produtos.id', $id)
            ->paginate($totalPerPage, ['*'], 'page', $page);

        return new PaginationPresenter($produtoSaida);
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
