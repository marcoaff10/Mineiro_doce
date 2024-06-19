<?php

namespace App\Http\Controllers;

use AnourValar\EloquentSerialize\Service;
use App\DTO\Clientes\CreateClientes;
use App\DTO\Clientes\UpdateClientes;
use App\Http\Requests\RequestCreateClientes;
use App\Http\Requests\RequestUpdateClientes;
use App\Models\Cliente;
use App\Models\Venda;
use App\Services\Clientes\ClienteService;
use Illuminate\Http\Request;

class Clientes extends Controller
{
    public function __construct(protected Cliente $model, protected ClienteService $service)
    {
    }

    //=========================================================================================================
    // Clientes
    //=========================================================================================================
    public function show(Request $request)
    {
        $clientes = $this->service->paginate(
            page: $request->get('page', 1),
            totalPerPage: $request->get('per_page', 15),
            filter: $request->filter
        );

        $inativados = $this->model->where('ativa', 0)->get();

        $filters = ['filter' => $request->get('filter', '')];

        return view('dashboard.clientes.show_clientes', compact('clientes', 'filters', 'inativados'));
    }

    //=========================================================================================================
    public function detalhes(string $id, Request $request)
    {
        $cliente = $this->service->findOne($id);

        $ativas = $this->service->vendasAtivasCliente(
            id: $id,
            page: $request->get('page', 1),
            totalPerPage: $request->get('per_page', 15),
            filter: $request->filter
        );

        $fechadas = $this->service->vendasFechadasCliente(
            id: $id,
            page: $request->get('page', 1),
            totalPerPage: $request->get('per_page', 15),
            filter: $request->filter
        );

        $vendaCliente = Venda::where('cliente_id', $id)->where('ativa', 1)->where('saida', 0)->get();

        $filters = ['filter' => $request->get('filter', '')];

        return view('dashboard.clientes.detalhes_clientes', compact('cliente', 'ativas', 'fechadas', 'filters', 'vendaCliente'));
    }

    //=========================================================================================================
    public function create()
    {
        return view('dashboard.clientes.create_clientes');
    }

    //=========================================================================================================
    public function store(RequestCreateClientes $request)
    {

        if (substr($request->cnpj, 0, 1) == 0) {
            $cnpj = substr($request->cnpj, 1, 13);
        } else {
            $cnpj = $request->cnpj;
        }

        if ($this->model->where('cnpj', $cnpj)->first()) {
            return redirect()->route('create.clientes')
                ->withInput()
                ->with('error_create', 'Já existe um registro com esse número de CNPJ.');
        }

        $this->service->store(
            CreateClientes::makeFromRequest($request)
        );


        return redirect()->route('show.clientes');
    }

    //=========================================================================================================
    public function update(string $id)
    {
        $cliente = $this->service->findOne($id);

        return view('dashboard.clientes.update_clientes', compact('cliente'));
    }

    //=========================================================================================================
    public function update_submit(RequestUpdateClientes $request)
    {

        if (substr($request->cnpj, 0, 1) == 0) {
            $cnpj = substr($request->cnpj, 1, 13);
        } else {
            $cnpj = $request->cnpj;
        }

        if ($this->model->where('cnpj', $cnpj)->where('id', '!=', $request->id)->first()) {
            return redirect()->route('update.clientes', ['id' => $request->id])
                ->withInput()
                ->with('error_create', 'Já existe um registro com esse número de CNPJ.');
        }

        $this->service->update(
            UpdateClientes::makeFromRequest($request)
        );

        return redirect()->route('detalhes.clientes', $request->id);
    }

    //=========================================================================================================
    public function inativar_cliente(string $id)
    {
        $this->model->findOrFail($id)->update(
            ['ativa' => 0]
        );

        return redirect()->route('show.clientes');
    }

    //=========================================================================================================
    public function reativar_cliente(string $id)
    {
        $this->model->findOrFail($id)->update(
            ['ativa' => 1]
        );
        return redirect()->route('show.clientes');
    }

    //=========================================================================================================
    public function clientes_inativados(Request $request)
    {
        $clientes = $this->service->paginateInativados();

        $filters = ['filter' => $request->get('filter', '')];
        
        return view('dashboard.clientes.clientes_inativados', compact('clientes', 'filters'));
    }

    // //=========================================================================================================
    // public function delete(Request $request)
    // {
    //     $this->service->delete($request->id);


    //     return redirect()->route('show.clientes');
    // }
}
