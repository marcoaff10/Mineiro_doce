<?php


namespace App\Repositories\Eloquent\SaidaProdutos;

use App\DTO\SaidaProdutos\CreateSaidaProdutos;
use App\Models\Saida;
use App\Models\Saida_produto;
use App\Repositories\Contracts\SaidaProdutos\SaidaProdutosInterface;
use stdClass;

class SaidaProdutosEloquent implements SaidaProdutosInterface
{
     public function __construct(protected Saida $model)
     {
        
     }

    public function store(CreateSaidaProdutos $dto): stdClass
    {

        $saida = $this->model->create(
            [
                'motivo' => $dto->motivo,
            ]
        );
        $id = $this->model->select('id')->orderBy('created_at', 'DESC')->first();
        
        Saida_produto::create(
            [
                'saida_id' => $id->id,
                'cliente_id' => $dto->cliente_id,
                'produto_id' => $dto->produto_id,
                'quantidade' => $dto->quantidade,
                'valor_unidade' => $dto->valor_unidade,
                'frete' => $dto->frete,
                'valor_total' => $dto->valor_total,
            ]
            );

        return (object) $saida->toArray();
    }
}