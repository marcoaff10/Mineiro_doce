<?php

namespace App\DTO\Categorias;

use App\Http\Requests\RequestCategorias;

class CreateCategorias
{

    public function __construct(
        public string $categoria,
    ) {}

    //=====================================================================
    public static function makeFromRequest(RequestCategorias $request)
    {
        return new self(
            $request->categoria,
        );
    }
}
