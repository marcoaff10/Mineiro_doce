<?php

namespace App\DTO\Fornecedores;


use App\Http\Requests\RequestUpdateFornecedores;

class UpdateFornecedores
{
    public function __construct(
        public $id,
        public int $cnpj,
        public string $fornecedor,
        public int|null $telefone,
        public string|null $email,
        public int $cep,
        public string $cidade,
        public string $uf,
        public string $endereco,
        public string|null $bairro,
        public int|null $num
        ){}

    //=====================================================================
    public static function makeFromRequest(RequestUpdateFornecedores $request, string $id = null)
    {
        return new self(
            $id ?? $request->id,
            $request->cnpj,
            $request->fornecedor, 
            $request->telefone,
            $request->email,
            $request->cep,
            $request->cidade,
            $request->uf,
            $request->endereco,
            $request->bairro,
            $request->num,
        );
    }
}