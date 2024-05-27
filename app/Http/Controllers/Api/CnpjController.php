<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CnpjController extends Controller
{
    public function __invoke()
    {
        return Http::get('https://publica.cnpj.ws/cnpj/06947284000104')->json();
    }
}
