<?php

namespace App\DTO\Compras;

use App\Http\Requests\RequestCompras;
use App\Http\Requests\RequestProdutosCompra;

class CreateCompras {
    public function __construct(
        public string $fornecedor_id,
    ) {}

    //=====================================================================
    public static function makeFromRequest(RequestCompras $request)
    {
        return new self(
            $request->fornecedor,
        );
    }
}