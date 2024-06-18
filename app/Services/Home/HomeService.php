<?php

namespace App\Services\Home;

use App\Http\Requests\Home\RequestEstatisticasCompras;
use App\Http\Requests\Home\RequestLucroTotal;
use App\Http\Requests\Home\RequestEstatisticasProdutos;
use App\Http\Requests\Home\RequestEstatisticasVendas;
use App\Repositories\Contracts\Home\HomeInterface;
use stdClass;

class HomeService
{

    //=========================================================================================================
    public function __construct(protected HomeInterface $homeInterface)
    {
    }

    //=========================================================================================================
    // Lucro
    //=========================================================================================================
    public function lucroTotal()
    {
        return $this->homeInterface->lucroTotal();
    }

    //=========================================================================================================
    public function lucroTotalFiltro(RequestLucroTotal $request)
    {
        return $this->homeInterface->lucroTotalFiltro($request);
    }

    //==========================================================================================================
    // Produtos
    //==========================================================================================================
    public function estatisticasProdutos()
    {
        return $this->homeInterface->estatisticasProdutos();
    }

    //=========================================================================================================
    public function estatisticasProdutosFiltro(RequestEstatisticasProdutos $request)
    {
        return $this->homeInterface->estatisticasProdutosFiltro($request);
    }

    //==========================================================================================================
    // Vendas
    //==========================================================================================================
    public function estatisticasVendas()
    {
        return $this->homeInterface->estatisticasVendas();
    }

    //=========================================================================================================
    public function estatisticasVendasFiltro(RequestEstatisticasVendas $request)
    {
        return $this->homeInterface->estatisticasVendasFiltro($request);
    }

    //==========================================================================================================
    // Compras
    //==========================================================================================================
    public function estatisticasCompras()
    {
        return $this->homeInterface->estatisticasCompras();
    }

    //=========================================================================================================
    public function estatisticasComprasFiltro(RequestEstatisticasCompras $request)
    {
        return $this->homeInterface->estatisticasComprasFiltro($request);
    }
}
