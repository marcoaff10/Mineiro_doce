<?php

namespace App\DTO\Clientes;

use App\Http\Requests\RequestUpdateClientes;

class UpdateClientes
{
    public function __construct(
        public $id,
        public int $cnpj,
        public string $cliente,
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
    public static function makeFromRequest(RequestUpdateClientes $request, string $id = null)
    {
        return new self(
            $id ?? $request->id,
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