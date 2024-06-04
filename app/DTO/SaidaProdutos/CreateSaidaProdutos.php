<?php

namespace App\DTO\SaidaProdutos;

use App\Http\Requests\RequestSaidaProduto;

class CreateSaidaProdutos
{
    public function __construct(
        public string $motivo, 
        public string $produto_id,
        public string|null $cliente_id, 
        public int $quantidade,
        public int $valor_unidade,
        public int $frete,
        public int $valor_total
        ){}

    //=========================================================================================================
    public static function makeFromRequest(RequestSaidaProduto $request)
    {
        return new self(
            $request->motivo,
            $request->produto,
            $request->cliente,
            $request->quantidade,
            $request->valor_unidade,
            $request->frete,
            $request->valor_total
        );
    }
}