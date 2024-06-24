@extends('dashboard.dashboard')
@section('title', 'Estoque')
@section('content')
    <div class="row align-items-center justify-content-center">
        <div class="col">

            <div class="row py-3">
                <div class="col">
                    <h1 class="mb-3 fs-4 d-block"><i class="bi bi-box me-2 align-middle"></i>Estoque </h1>
                </div>
            </div>
            @if (count($produtos->items()) > 0)
                <div class="row py-3">
                    <div class="col text-end ">
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
                                        class=" fw-bold text-danger ms-3 fs-5 align-middle">
                                        <strong><i class="bi bi-x-lg align-middle"></i></strong>
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            @endif

            <div class="row p-2 justify-content-between p-1">
                <div class="col-sm-12 col-md-12 {{(count($inativados) > 0) ? 'col-lg-6' : 'col-lg-4'}} mb-3">
                    <a href=" {{ route('create.produtos') }} " class="btn btnPrimary w-100">
                        Cadastrar Produto
                        <i class="bi bi-plus-circle ms-1"></i>
                    </a>
                </div>

                @if (count($inativados) > 0)
                    <div class="col-sm-12 col-md-12 col-lg-6 mb-3">
                        <a href=" {{ route('produto.inativado') }} " class="btn btnSecondary w-100">
                            Produtos Inativados
                            <i class="bi bi-x-circle ms-1"></i>
                        </a>
                    </div>
                @endif
                @if (count($produtos->items()) > 0)
                    <div class="col-sm-12 col-md-12 {{(count($inativados) > 0) ? 'col-lg-6' : 'col-lg-4'}} mb-3">
                        <a href="" class="btn btnSuccess w-100" data-bs-target="#entrada" data-bs-toggle="modal">
                            Entrada
                            <i class="bi bi-plus-circle ms-1"></i>
                        </a>
                    </div>

                    <div class="col-sm-12 col-md-12 {{(count($inativados) > 0) ? 'col-lg-6' : 'col-lg-4'}} mb-3">
                        <a href="" class="btn btnDanger w-100" data-bs-target="#saida" data-bs-toggle="modal">
                            Saida
                            <i class="bi bi-dash-circle ms-1"></i>
                        </a>
                    </div>
                @endif
            </div>

            <!--===============================================Modal Entrada===================================================================================== -->
            <x-modal-entrada :produtos="$produtos" :entradas="$entradas" />
            <!--===============================================Fim Modal Entrada===================================================================================== -->

            <!--===============================================Modal Saida===================================================================================== -->
            <x-modal-saida :produtos="$produtos" :saidas="$saidas" />
            <!--===============================================Fim Modal Saida===================================================================================== -->

            @if (count($produtos->items()) > 0)
                <x-produtoEstoqueLg :produtos="$produtos" :filters="$filters" />
            @else
                <p class=" text-center opacity-50 mt-5">Nunhum produto encontrado.</p>
            @endif
        </div>
    </div>
@endsection
