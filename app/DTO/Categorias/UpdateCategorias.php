<?php

namespace App\DTO\Categorias;

use App\Http\Requests\RequestCategorias;


class UpdateCategorias
{
    public function __construct(
        public $id,
        public string $categoria,

        ){}

    //=====================================================================
    public static function makeFromRequest(RequestCategorias $request, string $id = null)
    {
        return new self(
            $id ?? $request->id,
            $request->categoria,
        );
    }
}