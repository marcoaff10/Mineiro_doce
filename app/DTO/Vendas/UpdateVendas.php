<?php

namespace App\DTO\Vendas;

use App\Http\Requests\RequestVendas;
use Illuminate\Http\Request;

class UpdateVendas {
    public function __construct(
        public $id,
        public $frete,

        ){}

    //=====================================================================
    public static function makeFromRequest(Request $request, string $id = null)
    {
        return new self(
            $id ?? $request->venda,
            $request->frete, 
        );
    }
}