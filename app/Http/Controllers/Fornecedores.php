<?php

namespace App\Http\Controllers;

use AnourValar\EloquentSerialize\Service;
use App\DTO\Fornecedores\CreateFornecedores;
use App\DTO\Fornecedores\UpdateFornecedores;
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

        $filters = ['filter' => $request->get('filter', '')];

        return view('dashboard.fornecedores.show_fornecedores', compact('fornecedores', 'filters'));
    }

    //=========================================================================================================
    public function detalhes(string $id)
    {
        
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
        if (substr($request->cnpj, 0, 1) == 0) {
            $cnpj = substr($request->cnpj, 1, 13);
        } else {
            $cnpj = $request->cnpj;
        }

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

    //=========================================================================================================
    public function update(string $id)
    {

        $fornecedor = $this->service->findOne($id);

        return view('dashboard.fornecedores.update_fornecedores', compact('fornecedor'));

    }

    //=========================================================================================================
    public function update_submit(RequestFornededores $request)
    {

        $this->service->update(
            UpdateFornecedores::makeFromRequest($request)
        );

        return redirect()->route('detalhes.fornecedores', ['id' => $request->id]);
    }

    //=========================================================================================================
    public function delete(Request $request)
    {

        $this->service->delete($request->id);

        return redirect()->route('show.fornecedores');
    }
}
