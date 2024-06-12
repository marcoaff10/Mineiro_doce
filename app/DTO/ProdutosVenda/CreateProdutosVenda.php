<?php

namespace App\DTO\ProdutosVenda;


use App\Http\Requests\RequestProdutosVenda;

class CreateProdutosVenda
{
    public function __construct(
        public string $venda_id,
        public string $produto_id,
        public $preco_venda,
        public int $quantidade
    ) 
    {}

    //=====================================================================
    public static function makeFromRequesr(RequestProdutosVenda $request)
    {
        return new self($request->venda, $request->produto, $request->preco_venda, $request->quantidade);
    }
}
