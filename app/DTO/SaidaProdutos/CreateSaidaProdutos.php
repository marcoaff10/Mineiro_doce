<?php

namespace App\DTO\SaidaProdutos;

use App\Http\Requests\RequestSaidaProduto;

class CreateSaidaProdutos
{
    public function __construct(
        public string $motivo, 
        public string $produto_id,
        public int $quantidade,
        ){}

    //=========================================================================================================
    public static function makeFromRequest(RequestSaidaProduto $request)
    {
        return new self(
            $request->motivo,
            $request->produto,
            $request->quantidade,
        );
    }
}