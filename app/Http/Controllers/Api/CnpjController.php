<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CnpjController extends Controller
{
    public function cnpj($cnpj)
    {
       return Http::get("https://api-publica.speedio.com.br/buscarcnpj?cnpj=$cnpj")->json();
    }
}
