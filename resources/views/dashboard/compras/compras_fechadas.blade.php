@extends('dashboard.dashboard')
@section('title', 'Compras Fechadas')
@section('content')
    <div class="row align-items-center justify-content-center">
        <div class="col">

            <div class="row py-3">
                <div class="col">
                    <h1 class="mb-3 fs-4 d-block"><i class="bi bi-cart-plus me-2 align-middle"></i>Compras Fechadas</h1>
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
                                <a href="{{ route('compras.desativadas') }}"
                                    class="fw-bold text-danger ms-3 fs-5 align-middle">
                                    <strong><i class="bi bi-x-lg align-middle"></i></strong>
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            <div class="row p-2 justify-content-between p-1">
                <div class="col-sm-12 col-md-4 col-lg-6 mb-3">
                    <a href=" {{ route('create.compras') }} " class="btn btnPrimary w-100">
                        Comprar
                        <i class="bi bi-plus-circle ms-1"></i>
                    </a>
                </div>

                <div class="col-sm-12 col-md-4 col-lg-6 mb-3">
                    <a href=" {{ route('show.compras') }} " class="btn btnSuccess w-100">
                        Compras Ativas
                        <i class="bi bi-check-circle ms-1"></i>
                    </a>
                </div>
            </div>

            @if (count($compras->items()) > 0)
                <div class="w-100 col-12 overflowTable">
                    <table class="colorTables table-striped table table table-hover table-responsive">
                        <thead>
                            <th scope="col" class="align-middle">Compra</th>
                            <th scope="col" class="align-middle">Fornecedor</th>
                            <th scope="col" class="align-middle">Ativa</th>
                            <th scope="col" class="align-middle">Fechada</th>
                            <th scope="col" class="align-middle">Valor</th>
                            <th scope="col" class="align-middle">Detalhes</th>
                        </thead>
                        <tbody>
                            @foreach ($compras->items() as $compra)
                                <tr>
                                    <td scope="row" class="w-25 align-middle"> {{ $compra->compra }} </td>
                                    <td scope="row" class="align-middle"> {{ primeiro_nome($compra->fornecedor) }} </td>
                                    <td scope="row" class="align-middle "> {{ $compra->ativa == 1 ? 'SIM' : 'NÃO' }} </td>
                                    <td scope="row" class="align-middle"> {{ $compra->entrada == 1 ? 'SIM' : 'NÃO' }} </td>
                                    <td scope="row" class="align-middle"> R$ {{ preco($compra->valor) }} </td>
                                    <td scope="row" class="align-middle">
                                        <a href=" {{ route('detalhes.compra', $compra->id) }} "
                                            class="text-decoration-none text-secondary ">
                                            <i class="bi bi-arrow-right-circle-fill"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <x-pagination :paginator="$compras" :appends="$filters" />
                </div>
            @else
                <p class=" text-center opacity-50 mt-5">Nenhuma compra.</p>
            @endif
        </div>
    </div>
@endsection
