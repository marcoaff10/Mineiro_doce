<?php

namespace App\DTO\Vendas;

use App\Http\Requests\RequestVendas;

class CreateVendas {
    public function __construct(
        public string $cliente_id,
    ) {}

    //=====================================================================
    public static function makeFromRequest(RequestVendas $request)
    {
        return new self(
            $request->cliente,
        );
    }
}