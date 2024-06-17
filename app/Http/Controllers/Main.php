<?php

namespace App\Http\Controllers;

use App\Http\Requests\Home\RequestLucroTotal;
use App\Http\Requests\RequestEstatisticasProdutos;
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

    //=========================================================================================================
    public function lucroTotal()
    {

        $data = $this->service->lucroTotal();

        return $data;
    }

    //=========================================================================================================
    public function lucroTotalFiltro(RequestLucroTotal $request)
    {
        $data = $this->service->lucroTotalFiltro($request);

        return $data;
    }

    //==========================================================================================================
    // Produtos
    //==========================================================================================================
    public function estatisticasProdutos()
    {

        $data = $this->service->estatisticasProdutos();

        return (object) $data;
    }

    //==========================================================================================================
    public function estatisticasProdutosFiltro(RequestEstatisticasProdutos $request)
    {
        $data = $this->service->estatisticasProdutosFiltro($request);

        return (object) $data;
    }

}
