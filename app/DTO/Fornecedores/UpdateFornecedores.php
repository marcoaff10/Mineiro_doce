<?php

namespace App\DTO\Fornecedores;

use App\Http\Requests\RequestFornededores;

class UpdateFornecedores
{
    public function __construct(
        public $id,
        public int $cnpj,
        public string $fornecedor,
        public int $telefone,
        public string $email,
        public int $cep,
        public string $cidade,
        public string $uf,
        public string $endereco,
        public string $bairro,
        public int $num
        ){}

    //=====================================================================
    public static function makeFromRequest(RequestFornededores $request, string $id = null)
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