<?php

namespace App\Repositories\Contracts\Home;

use App\Http\Requests\Home\RequestEstatisticasCompras;
use App\Http\Requests\Home\RequestLucroTotal;
use App\Http\Requests\Home\RequestEstatisticasProdutos;
use App\Http\Requests\Home\RequestEstatisticasVendas;
use stdClass;

interface HomeInterface
{
    //=========================================================================================================
    // Lucro
    //=========================================================================================================    
    public function lucroTotal();
    public function lucroTotalFiltro(RequestLucroTotal $request);
    //==========================================================================================================
    // Produtos
    //==========================================================================================================
    public function estatisticasProdutos();
    public function estatisticasProdutosFiltro(RequestEstatisticasProdutos $request);
    //==========================================================================================================
    // Vendas
    //==========================================================================================================
    public function estatisticasVendas();
    public function estatisticasVendasFiltro(RequestEstatisticasVendas $request);
    //==========================================================================================================
    // Compras
    //==========================================================================================================
    public function estatisticasCompras();
    public function estatisticasComprasFiltro(RequestEstatisticasCompras $request);

}