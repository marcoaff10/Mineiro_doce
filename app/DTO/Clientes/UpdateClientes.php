<?php

namespace App\DTO\Clientes;

use App\Http\Requests\RequestUpdateClientes;

class UpdateClientes
{
    public function __construct(
        public $id,
        public int $cnpj,
        public string $cliente,
        public string|null $email,
        public int|null $telefone,
        public int $cep,
        public string $cidade,
        public string $uf,
        public string $endereco,
        public string|null $bairro,
        public int|null $num
        ){}

    //=====================================================================
    public static function makeFromRequest(RequestUpdateClientes $request, string $id = null)
    {
        
        return new self(
            $id ?? $request->id,
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