@extends('dashboard.dashboard')
@section('title', 'Produtos Inativos')
@section('content')
    <div class="row align-items-center justify-content-center">
        <div class="col">

            <div class="row py-3">
                <div class="col">
                    <h1 class="mb-3 fs-4 d-block"><i class="bi bi-box me-2 align-middle"></i>Produtos Inativos </h1>
                </div>
            </div>
            <div class="row justify-content-between">

                @if (count($produtos->items()) > 0)
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
                                    <a href="{{ route('estoque.produtos') }}"
                                        class="fw-bold text-danger ms-3 fs-5 align-middle">
                                        <strong><i class="bi bi-x-lg align-middle"></i></strong>
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>
                @endif

                <div class="col-sm-12 col-md-6 col-lg-6 mb-3">
                    <a href=" {{ route('estoque.produtos') }} " class="btn btn-success w-100">
                        Produtos Ativos
                        <i class="bi bi-check-circle ms-1"></i>
                    </a>
                </div>

            </div>


            @if (count($produtos->items()) > 0)
                <x-produtoEstoqueLg :produtos="$produtos" :filters="$filters" />
            @else
                <p class=" text-center opacity-50 mt-5">Nunhum produto encontrado.</p>
            @endif
        </div>
    </div>

    <x-script />
@endsection
