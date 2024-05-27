<?php

namespace App\Http\Controllers;

use App\DTO\Fornecedores\CreateFornecedores;
use App\Http\Requests\RequestFornededores;
use App\Services\Fornecedores\FornecedoreService;
use Illuminate\Http\Request;

class Fornecedores extends Controller
{
    public function __construct(protected FornecedoreService $service)
    {
        
    }

    //=========================================================================================================
    // Fornecedores
    //=========================================================================================================
    public function show()
    {
        $fornecedores = $this->service->getAll();

        return view('dashboard.fornecedores.show_fornecedores', compact('fornecedores'));
    }

    //=========================================================================================================
    public function create()
    {


        return view('dashboard.fornecedores.create_fornecedores');
    }

    //=========================================================================================================
    public function store(RequestFornededores $request)
    {

        $this->service->store(
            CreateFornecedores::makeFromRequest($request)
        );

        
        return redirect()->route('show.fornecedores');

    }
}
