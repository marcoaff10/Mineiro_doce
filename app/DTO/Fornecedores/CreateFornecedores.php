<?php

namespace App\DTO\Fornecedores;

use App\Http\Requests\RequestFornededores;

class CreateFornecedores
{

    public function __construct(
        public int $cnpj,
        public string $fornecedor,
        public int $telefone,
        public string $email,
        public int $cep,
        public string $cidade,
        public string $uf,
        public string $endereco,
        public string $bairro,
        public int|null $num
    ) {}

    //=====================================================================
    public static function makeFromRequest(RequestFornededores $request)
    {
        return new self(
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
