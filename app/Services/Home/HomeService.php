<?php

namespace App\Services\Home;

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
    public function lucroTotal()
    {
        return $this->homeInterface->lucroTotal();
    }

    //=========================================================================================================
    public function lucroTotalFiltro(RequestLucroTotal $request)
    {
        return $this->homeInterface->lucroTotalFiltro($request);
    }

    //=========================================================================================================
    public function estatisticasProdutos()
    {
        return $this->homeInterface->estatisticasProdutos();
    }

    //=========================================================================================================
    public function estatisticasProdutosFiltro(RequestEstatisticasProdutos $request)
    {
        return $this->homeInterface->estatisticasProdutosFiltro($request);
    }

    //=========================================================================================================
    public function estatisticasVendas()
    {
        return $this->homeInterface->estatisticasVendas();
    }

    //=========================================================================================================
    public function estatisticasVendasFiltro(RequestEstatisticasVendas $request)
    {
        return $this->homeInterface->estatisticasVendasFiltro($request);
    }
}
