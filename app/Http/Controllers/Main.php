<?php

namespace App\Http\Controllers;

use App\Http\Requests\Home\RequestLucroTotal;
use App\Services\Home\HomeService;
use Illuminate\Http\Request;

class Main extends Controller
{
    public function __construct(protected HomeService $service)
    {
        
    }
    //=========================================================================================================
    // Dashbord
    //=========================================================================================================
    public function dashboard()
    {
         

        return view('dashboard.home');
    }

    public function lucroTotal(RequestLucroTotal $request)
    {
        
        $data = $this->service->lucroTotal($request);

        return $data;
    }

}
