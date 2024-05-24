<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Main extends Controller
{
    //=========================================================================================================
    // Dashbord
    //=========================================================================================================
    public function dashboard()
    {

        return view('auth.dashboard.home');
    }

}
