<?php

namespace App\Repositories\Contracts\Home;

use App\Http\Requests\Home\RequestLucroTotal;
use App\Http\Requests\Home\RequestEstatisticasProdutos;
use App\Http\Requests\Home\RequestEstatisticasVendas;
use stdClass;

interface HomeInterface
{
    public function lucroTotal();
    public function lucroTotalFiltro(RequestLucroTotal $request);
    public function estatisticasProdutos();
    public function estatisticasProdutosFiltro(RequestEstatisticasProdutos $request);
    public function estatisticasVendas();
    public function estatisticasVendasFiltro(RequestEstatisticasVendas $request);

}