<?php

namespace App\Repositories\Eloquent\Produtos;

use App\DTO\Produtos\CreateProdutos;
use App\DTO\Produtos\UpdateProdutos;
use App\Models\Entrada_produto;
use App\Models\Estoque;
use App\Models\Produto;
use App\Models\Saida_produto;
use App\Repositories\Contracts\PaginationInterface;
use App\Repositories\Contracts\PaginationPresenter;
use App\Repositories\Contracts\Produtos\ProdutosInterface;
use App\View\Components\EntradaProduto;
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
            ->where('produtos.ativa', 1)
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
    public function paginateInativos(int $page = 1, int $totalPerPage = 15, ?string $filter = null): PaginationInterface
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
            ->where('produtos.ativa', 0)
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
    public function findOne(string $id): stdClass|null
    {

        // buscando linha no banco que corresponde com o id informado
        $produto = $this->model->leftJoin('estoque', 'estoque.produto_id', 'produtos.id')
            ->leftJoin('compra_produto', function ($join) {
                $join->on('compra_produto.produto_id', 'produtos.id')
                    ->where('compra_produto.id', '!=', null);
            })
            ->leftJoin('compras', function ($join) {
                $join->on('compra_produto.compra_id', 'compras.id')
                    ->where('compra_produto.compra_id', '!=', null);
            })

            ->leftJoin('venda_produto', function ($join) {
                $join->on('venda_produto.produto_id', 'produtos.id')
                    ->where('venda_produto.id', '!=', null);
            })
            ->leftJoin('vendas', function ($join) {
                $join->on('venda_produto.venda_id', 'vendas.id')
                    ->where('venda_produto.venda_id', '!=', null);
            })
            ->join('categorias', 'categorias.id', 'produtos.categoria_id')
            ->select(
                'produtos.*',
                'categorias.categoria',
                $this->model->raw('CAST((SUM(estoque.qtde_entrada) - SUM(estoque.qtde_saida)) AS DECIMAL(20, 0)) AS estoque'),
                $this->model->raw('CAST(MIN(compra_produto.preco_compra) AS DECIMAL(20,2)) AS min_compra'),
                $this->model->raw('CAST(MAX(compra_produto.preco_compra) AS DECIMAL(20,2)) AS max_compra'),
                $this->model->raw('CAST(AVG(compra_produto.preco_compra) AS DECIMAL(20,2)) AS avg_compra'),
                $this->model->raw('CAST(MIN(venda_produto.preco_venda) AS DECIMAL(20,2)) AS min_venda'),
                $this->model->raw('CAST(MAX(venda_produto.preco_venda) AS DECIMAL(20,2)) AS max_venda'),
                $this->model->raw('CAST(AVG(venda_produto.preco_venda) AS DECIMAL(20,2)) AS avg_venda'),
                $this->model->raw('CAST((SUM(venda_produto.preco_venda) - SUM(compra_produto.preco_compra)) AS DECIMAL(20,2)) AS lucro')
            )
            ->groupBy('produtos.id')
            ->where('produtos.id', $id)
            ->first();


        // caso não encontre informações com o id informado retorna null
        if (!$produto) return null;

        // transformando os valores de array para um objeto
        return (object) $produto->toArray();
    }

    //=====================================================================
    public function analiseProduto($id)
    {
        $data = $this->model->leftJoin('venda_produto', 'venda_produto.produto_id', 'produtos.id')
            ->leftJoin('vendas', 'vendas.id', 'venda_produto.venda_id')
            ->selectRaw(
                'MONTH(vendas.data) AS mes,
                YEAR(vendas.data) AS ano,
                CAST(SUM(venda_produto.quantidade * venda_produto.preco_venda) AS DECIMAL(20, 2)) AS valor'
            )
            ->where('produtos.id', $id)
            ->where('vendas.saida', 1)
            ->groupByRaw('MONTH(vendas.data), YEAR(vendas.data)')
            ->orderByRaw('MONTH(vendas.data), YEAR(vendas.data)')
            ->limit(5)
            ->get()
            ->toArray();

        return response()->json($data);
    }

    //=====================================================================
    public function analiseProdutoFiltro($request)
    {
        $id = $request->id;
        $de = date('Y-m-d', strtotime($request->de));
        $ate = date('Y-m-d', strtotime($request->ate));
        $tipo = $request->tipo;
        $por = $request->por;
        // ==================== Filtrando por venda e preço de venda ===========================================
        if ($tipo == 'venda' && $por == 'preco') {
            $data = $this->model->leftJoin('venda_produto', 'venda_produto.produto_id', 'produtos.id')
                ->leftJoin('vendas', 'vendas.id', 'venda_produto.venda_id')
                ->selectRaw(
                    'MONTH(vendas.data) AS mes,
                    YEAR(vendas.data) AS ano,
                    CAST(SUM(venda_produto.quantidade * venda_produto.preco_venda) AS DECIMAL(20, 2)) AS valor'
                )
                ->where('produtos.id', $id)
                ->whereBetween('vendas.data', [$de, $ate])
                ->where('vendas.saida', 1)
                ->groupByRaw('MONTH(vendas.data), YEAR(vendas.data)')
                ->orderByRaw('MONTH(vendas.data), YEAR(vendas.data)')
                ->get()
                ->toArray();

            return response()->json($data);

            // ==================== Filtrando por venda e quantidade ===========================================
        } elseif ($tipo == 'venda' && $por == 'quantidade') {
            $data = $this->model->leftJoin('venda_produto', 'venda_produto.produto_id', 'produtos.id')
                ->leftJoin('vendas', 'vendas.id', 'venda_produto.venda_id')
                ->selectRaw(
                    'MONTH(vendas.data) AS mes,
                    YEAR(vendas.data) AS ano,
                    SUM(venda_produto.quantidade) AS valor'
                )
                ->where('produtos.id', $id)
                ->whereBetween('vendas.data', [$de, $ate])
                ->where('vendas.saida', 1)
                ->groupByRaw('MONTH(vendas.data), YEAR(vendas.data)')
                ->orderByRaw('MONTH(vendas.data), YEAR(vendas.data)')
                ->get()
                ->toArray();

            return response()->json($data);

            // ==================== Filtrando por compra e preço de compra ===========================================
        } elseif ($tipo == 'compra' && $por == 'preco') {
            $data = $this->model->leftJoin('compra_produto', 'compra_produto.produto_id', 'produtos.id')
                ->leftJoin('compras', 'compras.id', 'compra_produto.compra_id')
                ->selectRaw(
                    'MONTH(compras.data) AS mes,
                    YEAR(compras.data) AS ano,
                    CAST(SUM(compra_produto.quantidade * compra_produto.preco_compra) AS DECIMAL(20, 2)) AS valor'
                )
                ->where('produtos.id', $id)
                ->whereBetween('compras.data', [$de, $ate])
                ->where('compras.entrada', 1)
                ->groupByRaw('MONTH(compras.data), YEAR(compras.data)')
                ->orderByRaw('MONTH(compras.data), YEAR(compras.data)')
                ->get()
                ->toArray();

            return response()->json($data);

            // ==================== Filtrando por compra e quantidade ===========================================
        } elseif ($tipo == 'compra' && $por == 'quantidade') {
            $data = $this->model->leftJoin('compra_produto', 'compra_produto.produto_id', 'produtos.id')
                ->leftJoin('compras', 'compras.id', 'compra_produto.compra_id')
                ->selectRaw(
                    'MONTH(compras.data) AS mes,
                    YEAR(compras.data) AS ano,
                    SUM(compra_produto.quantidade) AS valor'
                )
                ->where('produtos.id', $id)
                ->whereBetween('compras.data', [$de, $ate])
                ->where('compras.entrada', 1)
                ->groupByRaw('MONTH(compras.data), YEAR(compras.data)')
                ->orderByRaw('MONTH(compras.data), YEAR(compras.data)')
                ->get()
                ->toArray();

            return response()->json($data);
        }
    }



    //=====================================================================
    public function paginateEntradas(string $id, int $page = 1, int $totalPerPage = 15, string $filter = null): PaginationInterface
    {
        $entradas = Entrada_produto::leftJoin('produtos', 'produtos.id', 'entrada_produto.produto_id')
            ->leftJoin('compras', function ($join) {
                $join->on('compras.id', 'entrada_produto.compra_id')
                    ->where('entrada_produto.compra_id', '!=', null);
            })
            ->leftJoin('compra_produto', function ($join) {
                $join->on('compra_produto.compra_id', 'compras.id')
                    ->where('entrada_produto.compra_id', '!=', null);
            })
            ->leftJoin('fornecedores', function ($join) {
                $join->on('fornecedores.id', 'compras.fornecedor_id')
                    ->where('entrada_produto.compra_id', '!=', null);
            })
            ->select(
                'produtos.produto',
                'entrada_produto.motivo',
                'entrada_produto.quantidade',
                'entrada_produto.created_at',
                'fornecedores.fornecedor',
                'compra_produto.preco_compra',
            )
            ->orderBy('entrada_produto.created_at')
            ->where('produtos.id', $id)
            ->paginate($totalPerPage, ['*'], 'page', $page);

        return new PaginationPresenter($entradas);
    }

    //=====================================================================
    public function paginateSaidas(string $id, int $page = 1, int $totalPerPage = 15, string $filter = null): PaginationInterface
    {
        $saidas = Saida_produto::leftJoin('produtos', 'produtos.id', 'saida_produto.produto_id')
            ->leftJoin('vendas', function ($join) {
                $join->on('vendas.id', 'saida_produto.venda_id')
                    ->where('saida_produto.venda_id', '!=', null);
            })
            ->leftJoin('venda_produto', function ($join) {
                $join->on('venda_produto.venda_id', 'vendas.id')
                    ->where('saida_produto.venda_id', '!=', null);
            })
            ->leftJoin('clientes', function ($join) {
                $join->on('clientes.id', 'vendas.cliente_id')
                    ->where('saida_produto.venda_id', '!=', null);
            })
            ->select(
                'produtos.produto',
                'saida_produto.motivo',
                'saida_produto.quantidade',
                'saida_produto.created_at',
                'clientes.cliente',
                'venda_produto.preco_venda',
            )
            ->orderBy('saida_produto.created_at')
            ->where('produtos.id', $id)
            ->paginate($totalPerPage, ['*'], 'page', $page);

        return new PaginationPresenter($saidas);
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
