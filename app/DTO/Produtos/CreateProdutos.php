<?php

namespace App\DTO\Produtos;

use App\Http\Requests\RequestProdutos;

class CreateProdutos
{

    public function __construct(public string $produto, public string $categoria, public int $peso){}

    //=====================================================================
    public static function makeFromRequest(RequestProdutos $request)
    {
        return new self($request->produto, $request->categoria, $request->peso);
    }
}