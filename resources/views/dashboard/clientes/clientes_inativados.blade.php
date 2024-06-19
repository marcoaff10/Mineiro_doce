@extends('dashboard.dashboard')
@section('title', 'Clientes Inativos')
@section('content')
    <div class="row align-items-center justify-content-center">
        <div class="col">

            <div class="row mb-3">
                <div class="col">
                    <h1 class="mb-3 fs-4 d-block"><i class="bi bi-people me-2 align-middle"></i>Clientes Inativos</h1>
                </div>
            </div>

            <div class="row justify-content-between">

                @if (count($clientes->items()) > 0)
                    <div class="col-sm-12 col-md-12 col-lg-6">
                        <form action="" method="GET">
                            <div class="mb-3 d-flex">
                                <input type="text" name="filter" id="filter"
                                    class="form-control me-3 h-25 rounded-pill" placeholder="Pesquisar"
                                    value="{{ $filters['filter'] ?? '' }}">
                                <button type="submit" class="me-3 align-middle fs-5 fw-bold">
                                    <strong><i class="bi bi-search"></i></strong>
                                </button>
                                @if ($filters['filter'] != '')
                                    <a href="{{ route('show.clientes') }}"
                                        class="fw-bold text-danger ms-3 fs-5 align-middle">
                                        <strong><i class="bi bi-x-lg align-middle"></i></strong>
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>
                @endif

                <div class="col-sm-12 col-md-6 col-lg-6 mb-3">
                    <a href=" {{ route('show.clientes') }} " class="btn btn-success w-100">
                        Clientes Ativos
                        <i class="bi bi-check-circle ms-1"></i>
                    </a>
                </div>

            </div>

            @if (count($clientes->items()) > 0)
                <x-clientes-lg :clientes="$clientes" :filters="$filters" />
            @else
                <p class=" text-center opacity-50 mt-5">Sem clientes cadastrados.</p>
            @endif
        </div>
    </div>
@endsection
