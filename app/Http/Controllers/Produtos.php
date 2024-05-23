<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Produtos extends Controller
{
    //=========================================================================================================
    // Produtos
    //=========================================================================================================
    public function show()
    {



        return view('auth.dashboard.produdos.show_produto');
    }

    //=========================================================================================================
    public function create()
    {

        

        return view('auth.dashboard.produdos.create_produtos');
    }
}
