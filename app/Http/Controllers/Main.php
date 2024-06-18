<?php

namespace App\Http\Controllers;

use App\Http\Requests\Home\RequestEstatisticasCompras;
use App\Http\Requests\Home\RequestLucroTotal;
use App\Http\Requests\Home\RequestEstatisticasProdutos;
use App\Http\Requests\Home\RequestEstatisticasVendas;
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
    // Lucro
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

    //==========================================================================================================
    // Vendas
    //==========================================================================================================
    public function estatisticasVendas()
    {
        $data = $this->service->estatisticasVendas();

        return $data;
    }

    //==========================================================================================================
    public function estatisticasVendasFiltro(RequestEstatisticasVendas $request)
    {
        $data = $this->service->estatisticasVendasFiltro($request);

        return $data;
    }
    //==========================================================================================================
    // Compras
    //==========================================================================================================
    public function estatisticasCompras()
    {
        $data = $this->service->estatisticasCompras();

        return $data;
    }

    //==========================================================================================================
    public function estatisticasComprasFiltro(RequestEstatisticasCompras $request)
    {
        $data = $this->service->estatisticasComprasFiltro($request);

        return $data;
    }
}
