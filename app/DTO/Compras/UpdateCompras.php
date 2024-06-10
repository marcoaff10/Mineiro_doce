<?php

namespace App\DTO\Compras;

use App\Http\Requests\RequestCompras;
use Illuminate\Http\Request;

class UpdateCompras {
    public function __construct(
        public $id,
        public $frete,

        ){}

    //=====================================================================
    public static function makeFromRequest(Request $request, string $id = null)
    {
        return new self(
            $id ?? $request->compra,
            $request->frete, 
        );
    }
}