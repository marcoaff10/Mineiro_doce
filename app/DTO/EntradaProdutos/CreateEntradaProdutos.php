<?php

namespace App\DTO\EntradaProdutos;

use App\Http\Requests\RequestEntradaProdutos;
use App\Models\Entrada;

class CreateEntradaProdutos
{
    public function __construct(
        public string $motivo, 
        public string $produto_id,
        public string|null $fornecedor_id, 
        public int $quantidade,
        public int $valor_unidade,
        public int $frete,
        ){}

    //=========================================================================================================
    public static function makeFromRequest(RequestEntradaProdutos $request)
    {
        return new self(
            $request->motivo,
            $request->produto,
            $request->fornecedor,
            $request->quantidade,
            $request->valor_unidade,
            $request->frete,
        );
    }    
}