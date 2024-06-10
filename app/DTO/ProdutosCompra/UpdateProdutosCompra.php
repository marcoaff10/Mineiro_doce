<?php

namespace App\DTO\ProdutosCompra;

use App\Http\Requests\RequestProdutosCompra;

class UpdateProdutosCompra
{
    public function __construct(
        public string $compra_id,
        public string $produto_id,
        public $preco_compra,
        public int $quantidade
    ) 
    {}

    //=====================================================================
    public static function makeFromRequesr(RequestProdutosCompra $request)
    {
        return new self($request->compra, $request->produto, $request->preco_compra, $request->quantidade);
    }
}
