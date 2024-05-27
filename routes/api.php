<?php

use App\Http\Controllers\Api\CnpjController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/api_cnpj/{cnpj}', [CnpjController::class, 'cnpj']);
