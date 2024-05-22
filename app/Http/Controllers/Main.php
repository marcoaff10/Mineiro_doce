<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Main extends Controller
{
    public function login()
    {

        
        return view('auth.login');
    }

    public function dashboard()
    {

        return view('dashboard');
    }
}
