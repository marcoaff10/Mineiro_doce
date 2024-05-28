<?php

namespace App\Http\Controllers;

use AnourValar\EloquentSerialize\Service;
use App\DTO\Fornecedores\CreateFornecedores;
use App\Http\Requests\RequestFornededores;
use App\Models\Fornecedor;
use App\Services\Fornecedores\FornecedoreService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class Fornecedores extends Controller
{
    public function __construct(protected FornecedoreService $service, protected Fornecedor $model)
    {
        
    }

    //=========================================================================================================
    // Fornecedores
    //=========================================================================================================
    public function show(Request $request)
    {
        $fornecedores = $this->service->paginate(
            page: $request->get('page', 1),
            totalPerPage: $request->get('per_page', 15),
            filter: $request->filter
        );

        return view('dashboard.fornecedores.show_fornecedores', compact('fornecedores'));
    }

    //=========================================================================================================
    public function detalhes($id)
    {
        
        try {

            $id = Crypt::decrypt($id);

        } catch (\Exception $e)
        {
            return redirect()->route('show.fornecedores');
        }

        $fornecedor = $this->service->findOne($id);


        return view('dashboard.fornecedores.detalhes_fornecedor', compact('fornecedor'));
    }

    //=========================================================================================================
    public function create()
    {


        return view('dashboard.fornecedores.create_fornecedores');
    }

    //=========================================================================================================
    public function store(RequestFornededores $request)
    {
        $cnpj = substr($request->cnpj, 1, 13);

        if ($this->model->where('cnpj', $cnpj)->first()) {
            return redirect()->route('create.fornecedores')
                ->withInput()
                ->with('error_create', 'Já existe um registro com esse número de CNPJ.');
        }

        $this->service->store(
            CreateFornecedores::makeFromRequest($request)
        );

        
        return redirect()->route('show.fornecedores');

    }
}
