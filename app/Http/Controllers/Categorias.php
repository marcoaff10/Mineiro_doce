<?php

namespace App\Http\Controllers;

use App\DTO\Categorias\CreateCategorias;
use App\DTO\Categorias\UpdateCategorias;
use App\Http\Requests\RequestCategorias;
use App\Models\Categoria;
use App\Models\Produto;
use App\Services\Categorias\CategoriaService;
use Illuminate\Http\Request;

class Categorias extends Controller
{
    public function __construct(protected Categoria $model, protected CategoriaService $service)
    {
    }

    //=========================================================================================================
    // Categorias
    //=========================================================================================================
    public function show(Request $request)
    {

        $categorias = $this->service->paginate(
            page: $request->get('page', 1),
            totalPerPage: $request->get('per_page', 15),
            filter: $request->filter
        );

        $filters = ['filter' => $request->get('filter', '')];

        $inativas = $this->model->where('ativa', 0)->get();


        return view('dashboard.categorias.show_categorias', compact('categorias', 'filters', 'inativas'));
    }

    //=========================================================================================================
    public function detalhes($id)
    {
        $categoria = $this->service->findOne($id);

        return view('dashboard.categorias.detalhes_categorias', compact('categoria'));
    }

    //=========================================================================================================
    public function create()
    {


        return view('dashboard.categorias.create_categorias');
    }

    //=========================================================================================================
    public function store(RequestCategorias $request)
    {
        if ($this->model->where('categoria', $request->categoria)->where('ativa', 1)->first()) {
            return redirect()->route('create.categorias')->withInput()->with('error_create', 'Já existe essa categoria registrada.');
        }

        if ($this->model->where('categoria', $request->categoria)->where('ativa', 0)->first()) {
            return redirect()->route('create.categorias')->withInput()->with('error_create', 'Já existe essa categoria inativada.');
        }

        $this->service->store(
            CreateCategorias::makeFromRequest($request)
        );

        return redirect()->route('show.categorias');
    }

    //=========================================================================================================
    public function update($id)
    {

        $categoria = $this->service->findOne($id);

        return view('dashboard.categorias.update_categorias', compact('categoria'));
    }

    //=========================================================================================================
    public function update_submit(RequestCategorias $request)
    {
        if ($this->model->where('id', '!=', $request->id)->where('categoria', $request->categoria)->where('ativa', 1)->first()) {
            return redirect()->back()->withInput()->with('error_create', 'Já existe essa categoria.');
        }

        if ($this->model->where('id', '!=', $request->id)->where('categoria', $request->categoria)->where('ativa', 0)->where('ativa', 0)->first()) {
            return redirect()->route('create.categorias')->withInput()->with('error_create', 'Já existe essa categoria inativada.');
        }

        $this->service->update(
            UpdateCategorias::makeFromRequest($request)
        );

        return redirect()->route('detalhes.categorias', ['id' => $request->id]);
    }

    //=========================================================================================================
    public function inativar_categoria(string $id)
    {
        $this->model->findOrFail($id)->update(
            ['ativa' => 0]
        );

        return redirect()->route('show.categorias');
    }

    //=========================================================================================================
    public function reativar_categoria(string $id)
    {
        $this->model->findOrFail($id)->update(
            ['ativa' => 1]
        );

        return redirect()->route('show.categorias');
    }

    //=========================================================================================================
    public function categorias_inativas(Request $request)
    {
        $categorias = $this->service->paginateInativas(
            page: $request->get('page', 1),
            totalPerPage: $request->get('per_page', 15),
            filter: $request->filter
        );

        $filters = ['filter' => $request->get('filter', '')];

        return view('dashboard.categorias.categorias_inativas', compact('categorias', 'filters'));
    }

    //=========================================================================================================
    public function delete(Request $request)
    {
        if (Produto::where('categoria_id', $request->id)->first()) {
            return redirect()->route('categorias.inativas')
                ->with('error_disable', 'Impossível inativar a categoria, pois existem produtos que pertencem a ela.');
        }

        $this->service->delete($request->id);

        return redirect()->route('show.categorias');
    }
}
