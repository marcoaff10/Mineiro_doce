<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Compras extends Controller
{
    //=========================================================================================================
    // Compras
    //=========================================================================================================
    public function show()
    {



        return view('auth.dashboard.compras.show_compras');
    }

    //=========================================================================================================
    public function create()
    {



        return view('auth.dashboard.compras.create_compras');
    }
}
