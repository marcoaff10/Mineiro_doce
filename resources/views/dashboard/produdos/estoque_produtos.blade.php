@extends('dashboard.dashboard')
@section('title', 'Estoque')
@section('content')
    <div class="row align-items-center justify-content-center">
        <div class="col">

            <div class="row py-3">
                <div class="col">
                    <h1 class="mb-3 fs-4 d-block">Estoque <i class="bi bi-box ms-1 align-middle"></i></h1>
                </div>
            </div>
            <div class="row py-3">
                <div class="col text-end ">
                    <form action="" method="GET">

                        <div class="mb-3 d-flex">
                            <input type="text" name="filter" id="filter" class="form-control me-3 h-25 rounded-pill"
                                placeholder="Pesquisar" value="{{ $filters['filter'] ?? '' }}">
                            <button type="submit" class="me-3 align-middle fs-5 fw-bold">
                                <strong><i class="bi bi-search"></i></strong>
                            </button>
                            @if ($filters['filter'] != '')
                                <a href="{{ route('show.produtos') }}" class="fw-bold text-danger ms-3 fs-5 align-middle">
                                    <strong><i class="bi bi-x-lg align-middle"></i></strong>
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            <div class="row p-2 justify-content-between p-1">
                <div class="col-sm-12 col-md-4 col-lg-4 mb-3">
                    <a href=" {{ route('show.produtos') }} " class="btn btn-primary w-100">
                        Cadastrar Produto 
                        <i class="bi bi-plus-circle ms-1"></i>
                    </a>
                </div>

                <div class="col-sm-12 col-md-4 col-lg-4 mb-3">
                    <a href="" class="btn btn-success w-100" data-bs-target="#entrada" data-bs-toggle="modal">
                        Entrada
                        <i class="bi bi-plus-circle ms-1"></i>
                    </a>
                </div>

                <div class="col-sm-12 col-md-4 col-lg-4 mb-3">
                    <a href="" class="btn btn-secondary w-100" data-bs-target="#saida" data-bs-toggle="modal">
                        Saida
                        <i class="bi bi-dash-circle ms-1"></i>
                    </a>
                </div>
            </div>

            <!--===============================================Modal Entrada===================================================================================== -->
            <x-modal-entrada :produtos="$produtosEstoque" :fornecedores="$fornecedores" />
            <!--===============================================Fim Modal Entrada===================================================================================== -->

            <!--===============================================Modal Saida===================================================================================== -->
            <x-modal-saida :produtos="$produtosEstoque" :clientes="$clientes" />
            <!--===============================================Fim Modal Saida===================================================================================== -->

            @if (count($produtos->items()) > 0)
                <x-produtoEstoqueLg :produtos="$produtos" :filters="$filters" />
                <!--===============================================MD===================================================================================== -->
                <x-produtoEstoqueMd :produtos="$produtos" :filters="$filters" />
                <!--================================================SM==================================================================================== -->
                <x-produtoEstoqueSm :produtos="$produtos" :filters="$filters" />
            @else
                <p class=" text-center opacity-50 mt-5">Sem produtos cadastrados.</p>
            @endif
        </div>
    </div>

    <x-scriptEntradaProduto />
@endsection
