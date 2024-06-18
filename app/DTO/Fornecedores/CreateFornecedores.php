<?php

namespace App\DTO\Fornecedores;

use App\Http\Requests\RequestCreateFornededores;


class CreateFornecedores
{

    public function __construct(
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
    ) {}

    //=====================================================================
    public static function makeFromRequest(RequestCreateFornededores $request)
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
