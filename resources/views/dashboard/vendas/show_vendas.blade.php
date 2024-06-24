@extends('dashboard.dashboard')
@section('title', 'Vendas')
@section('content')
    <div class="row align-items-center justify-content-center">
        <div class="col">

            <div class="row mb-3">
                <div class="col">
                    <h1 class="mb-3 fs-4 d-block"><i class="bi bi-truck me-2 align-middle"></i>Vendas Abertas</h1>
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
                                <a href="{{ route('show.vendas') }}" class="fw-bold text-danger ms-3 fs-5 align-middle">
                                    <strong><i class="bi bi-x-lg align-middle"></i></strong>
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            <div class="row p-2 justify-content-between p-1">
                <div class="col-sm-12 col-md-4 col-lg-4 mb-3">
                    <a href=" {{ route('create.vendas') }} " class="btn btnPrimary w-100">
                        Vender
                        <i class="bi bi-plus-circle ms-1"></i>
                    </a>
                </div>

                @if (isset($desativadas) && count($desativadas) > 0)
                    <div class="col-sm-12 col-md-4 col-lg-4 mb-3">
                        <a href=" {{ route('vendas.desativadas') }} " class="btn btnSecondary w-100">
                            Vendas Inativas
                            <i class="bi bi-x-circle ms-1"></i>
                        </a>
                    </div>
                @endif

                @if (isset($fechadas) && count($fechadas) > 0)
                <div class="col-sm-12 col-md-4 col-lg-4 mb-3">
                    <a href=" {{ route('vendas.fechadas') }} " class="btn btnSuccess w-100">
                        Vendas Fechadas
                        <i class="bi bi-box-seam ms-1"></i>
                    </a>
                </div>
            @endif
            </div>

            @if (count($vendas->items()) > 0)
                <x-vendasLg :vendas="$vendas" :filters="$filters" />
            @else
                <p class=" text-center opacity-50 mt-5">Nenhuma venda aberta.</p>
            @endif
        </div>
    </div>
@endsection
