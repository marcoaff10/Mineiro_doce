<?php

namespace App\Repositories\Eloquent\EntradaProdutos;

use App\DTO\EntradaProdutos\CreateEntradaProdutos;
use App\Models\Compra;
use App\Models\CompraProduto;
use App\Models\Entrada_produto;
use App\Models\Estoque;
use App\Repositories\Contracts\EntradaProdutos\EntradaProdutosInterface;
use stdClass;

class EntradaProdutosEloquent implements EntradaProdutosInterface
{
    public function __construct(protected Entrada_produto $model, protected Estoque $modelEstoque)
    {
    }

    //=========================================================================================================
    public function store(CreateEntradaProdutos $dto): stdClass
    {
        
        $entrada = $this->model->create(
            (array) $dto
        );

        $estoque = $this->modelEstoque->where('produto_id', $dto->produto_id)->first();

        if (!$estoque) {
            $this->modelEstoque->create(
                [
                    'produto_id' => $dto->produto_id,
                    'qtde_entrada' => $dto->quantidade,
                ]
            );
        } else {

            $quantidade = $estoque->qtde_entrada + $dto->quantidade;
         
            $this->modelEstoque->where('id', $estoque->id)->update(
                [
                    'qtde_entrada' => $quantidade
                ]
                );
        }

        return (object) $entrada->toArray();
    }

    //=========================================================================================================
    public function produtosEntrada(string $id)
    {
        $data = CompraProduto::leftJoin('produtos', 'compra_produto.produto_id', 'produtos.id')
                    ->select(
                        'produtos.produto',
                        'compra_produto.quantidade',
                    )
                    ->where('compra_id', $id)
                    ->get();
        
        return response()->json($data);
                    
    }

    //=========================================================================================================
    public function entrada_compra(string $id): stdClass
    {
        $compras = CompraProduto::where('compra_id', $id)->select('compra_id', 'produto_id', 'quantidade')->get();
        
        foreach ($compras as $compra) {
            $this->model->create(
                [
                    'compra_id' => $compra->compra_id,
                    'produto_id' => $compra->produto_id,
                    'quantidade' => $compra->quantidade
                ]
            );

            $estoque = $this->modelEstoque->where('produto_id', $compra->produto_id)->first();

            if (!$estoque) {
                $this->modelEstoque->create(
                    [
                        'produto_id' => $compra->produto_id,
                        'qtde_entrada' => $compra->quantidade,
                    ]
                );

            } else {
    
                $quantidade = $estoque->qtde_entrada + $compra->quantidade;
             
                $this->modelEstoque->where('id', $estoque->id)->update(
                    [
                        'qtde_entrada' => $quantidade
                    ]
                    );
            }

            Compra::where('id', $compra->compra_id)->update(
                [
                    'entrada' => 1,
                    'ativa' => 0
                    ]
            );
        }
        
        return (object) $compras->toArray();
    }
}
