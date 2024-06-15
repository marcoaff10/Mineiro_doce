<?php

namespace App\Repositories\Contracts\Home;

use App\Http\Requests\Home\RequestLucroTotal;
use stdClass;

interface HomeInterface
{
    public function lucroTotal(RequestLucroTotal $request);
}