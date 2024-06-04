<?php

namespace App\DTO\Clientes;


use App\Http\Requests\RequestCreateClientes;

class CreateClientes
{
    public function __construct(
        public int $cnpj,
        public string $cliente,
        public string $email,
        public int $telefone,
        public int $cep,
        public string $cidade,
        public string $uf,
        public string $endereco,
        public string $bairro,
        public int|null $num
    ) {}

    //=====================================================================
    public static function makeFromRequest(RequestCreateClientes $request)
    {
        return new self(
            $request->cnpj,
            $request->cliente, 
            $request->email,
            $request->telefone,
            $request->cep,
            $request->cidade,
            $request->uf,
            $request->endereco,
            $request->bairro,
            $request->num,
        );
    }
}