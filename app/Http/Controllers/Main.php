<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Main extends Controller
{
    //=========================================================================================================
    // Autenticação
    //=========================================================================================================
    public function login()
    {

        
        return view('auth.login');
    }

    //=========================================================================================================
    // Dashbord
    //=========================================================================================================
    public function dashboard()
    {

        return view('auth.dashboard.home');
    }

    //============================================ Compras ====================================================
    public function compras()
    {



        return view('auth.dashboard.compras.visao_geral');
    }
}
