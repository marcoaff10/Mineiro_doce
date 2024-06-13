@extends('dashboard.dashboard')
@section('title', 'Vendas Fechadas')
@section('content')
    <div class="row align-items-center justify-content-center">
        <div class="col">

            <div class="row py-3">
                <div class="col">
                    <h1 class="mb-3 fs-4 d-block">Vendas Fechadas<i class="bi bi-truck ms-1 align-middle"></i></h1>
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
                    <a href=" {{ route('create.compras') }} " class="btn btn-primary w-100">
                        Vender
                        <i class="bi bi-plus-circle ms-1"></i>
                    </a>
                </div>

                <div class="col-sm-12 col-md-4 col-lg-6 mb-3">
                    <a href=" {{ route('show.compras') }} " class="btn btn-success w-100">
                        Vendas Ativas
                        <i class="bi bi-check-circle ms-1"></i>
                    </a>
                </div>
            </div>

            @if (count($vendas->items()) > 0)
                <div class="w-100 col-12" style="max-width: 100%; overflow-x: auto">
                    <table class="table table-striped table-bordered " id="datatables">
                        <thead class="table-dark">
                            <th class="text-center align-middle">Venda</th>
                            <th class="text-center align-middle">Cliente</th>
                            <th class="text-center align-middle">Ativa</th>
                            <th class="text-center align-middle">Fechada</th>
                            <th class="text-center align-middle">Valor</th>
                        </thead>
                        <tbody>
                            @foreach ($vendas->items() as $compra)
                                <tr>
                                    <td class="w-25 align-middle"> {{ $compra->compra }} </td>
                                    <td class="align-middle"> {{ primeiro_nome($compra->clientes) }} </td>
                                    <td class="text-center align-middle "> {{ $compra->ativa == 1 ? 'SIM' : 'NÃO' }} </td>
                                    <td class="text-center align-middle"> {{ $compra->saida == 1 ? 'SIM' : 'NÃO' }} </td>
                                    <td class="text-center align-middle"> R$ {{ preco($compra->valor) }} </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <x-pagination :paginator="$vendas" :appends="$filters" />
                </div>
            @else
                <p class=" text-center opacity-50 mt-5">Nenhuma compra fechada.</p>
            @endif
        </div>
    </div>
@endsection
