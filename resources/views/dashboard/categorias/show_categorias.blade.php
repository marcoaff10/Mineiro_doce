@extends('dashboard.dashboard')
@section('title', 'Categorias')
@section('content')
    <div class="row align-items-center justify-content-center">
        <div class="col">

            <div class="row mb-3">
                <div class="col">
                    <h1 class="mb-3 fs-4 d-block"><i class="bi bi-bookmark me-2 align-middle"></i>Categorias </h1>
                </div>
            </div>

            <div class="row justify-content-between">
                @if (count($categorias->items()) > 0)
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <form action="" method="GET">

                            <div class="mb-3 d-flex">
                                <input type="text" name="filter" id="filter"
                                    class="form-control me-3 h-25 rounded-pill" placeholder="Pesquisar"
                                    value="{{ $filters['filter'] ?? '' }}">
                                <button type="submit" class="me-3 align-middle fs-5 fw-bold">
                                    <strong><i class="bi bi-search"></i></strong>
                                </button>
                                @if ($filters['filter'] != '')
                                    <a href="{{ route('show.categorias') }}"
                                        class="fw-bold text-danger ms-3 fs-5 align-middle">
                                        <strong><i class="bi bi-x-lg align-middle"></i></strong>
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>
                @endif

                <div class="col-sm-12 col-md-5 col-lg-4 mb-3">
                    <a href=" {{ route('create.categorias') }} " class="btn btn-primary w-100">
                        Cadastrar Categoria
                        <i class="bi bi-plus-circle ms-1"></i>
                    </a>
                </div>
            </div>

            @if (count($categorias->items()) > 0)
                <div class="w-100 col-12">
                    <table class="colorTbales table-striped table table table-light table-hover table-responsive">
                        <thead>
                            <th scope="col" class="align-middle">Categorias</th>
                            <th scope="col" class="align-middle">Detalhes</th>
                        </thead>
                        <tbody>
                            @foreach ($categorias->items() as $categoria)
                                <tr>
                                    <td scope="row" class="w-75 align-middle"> {{ $categoria->categoria }} </td>
                                    <td scope="row" class="align-middle">
                                        <a href=" {{ route('detalhes.categorias', ['id' => $categoria->id]) }} "
                                            class="text-decoration-none text-secondary">
                                            <i class="bi bi-arrow-right-circle-fill"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <x-pagination :paginator="$categorias" :appends="$filters" />

            @else
                <p class=" text-center opacity-50 mt-5">Sem Categorias cadastrados.</p>
            @endif
        </div>
    </div>
@endsection
