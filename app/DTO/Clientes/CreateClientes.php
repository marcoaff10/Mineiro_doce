<?php

namespace App\DTO\Clientes;


use App\Http\Requests\RequestCreateClientes;

class CreateClientes
{
    public function __construct(
        public int $cnpj,
        public string $cliente,
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
    public static function makeFromRequest(RequestCreateClientes $request)
    {
        return new self(
            $request->cnpj,
            $request->cliente, 
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