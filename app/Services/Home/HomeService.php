<?php

namespace App\Services\Home;

use App\Http\Requests\Home\RequestLucroTotal;
use App\Repositories\Contracts\Home\HomeInterface;
use stdClass;

class HomeService {

    //=========================================================================================================
    public function __construct(protected HomeInterface $homeInterface)
    {}

    //=========================================================================================================
    public function lucroTotal(RequestLucroTotal $request)
    {
        return $this->homeInterface->lucroTotal($request);
    }

}