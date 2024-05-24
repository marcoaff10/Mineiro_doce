<?php

namespace App\DTO\Produtos;

use App\Http\Requests\RequestProdutos;

class UpdateProdutos
{
    public function __construct(public $id, public string $produto, public string $categoria, public int $peso){}

    //=====================================================================
    public static function makeFromRequest(RequestProdutos $request)
    {
        return new self($request->id, $request->produto, $request->categoria, $request->peso);
    }
}