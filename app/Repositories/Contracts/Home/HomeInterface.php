<?php

namespace App\Repositories\Contracts\Home;

use App\Http\Requests\Home\RequestLucroTotal;
use App\Http\Requests\RequestEstatisticasProdutos;
use stdClass;

interface HomeInterface
{
    public function lucroTotal();
    public function lucroTotalFiltro(RequestLucroTotal $request);
    public function estatisticasProdutos();
    public function estatisticasProdutosFiltro(RequestEstatisticasProdutos $request);

}