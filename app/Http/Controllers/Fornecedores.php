<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Fornecedores extends Controller
{
    //=========================================================================================================
    // Fornecedores
    //=========================================================================================================
    public function show()
    {

        return view('dashboard.fornecedores.show_fornecedores');
    }

    //=========================================================================================================
    public function create()
    {

        return view('dashboard.fornecedores.create_fornecedores');
    }
}
