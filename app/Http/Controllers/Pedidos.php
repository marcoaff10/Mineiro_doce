<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Pedidos extends Controller
{
    //=========================================================================================================
    // Pedidos
    //=========================================================================================================
    public function show()
    {



        return view('dashboard.pedidos.show_pedidos');
    }

    //=========================================================================================================
    public function create()
    {



        return view('dashboard.pedidos.create_pedidos');
    }
}
