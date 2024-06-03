<?php

namespace App\DTO\EntradaProdutos;

use App\Http\Requests\RequestEntradaProdutos;

class CreateEntradaProdutos
{
    public function __construct(
        public string $motivo, 
        public string|null $fornecedor_id, 
        public string $produto_id, 
        public int $quantidade,
        public int $valor_unidade,
        public int $frete,
        public int $valor_total
        ){}

    //=========================================================================================================
    public static function makeFromRequest(RequestEntradaProdutos $request)
    {
        return new self(
            $request->motivo,
            $request->fornecedor,
            $request->produto,
            $request->quantidade,
            $request->valor_unidade,
            $request->frete,
            $request->valor_total,
        );
    }    
}