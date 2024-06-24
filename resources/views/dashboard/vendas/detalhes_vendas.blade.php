@extends('dashboard.dashboard')
@section('title', 'Detalhes da Venda')
@section('content')
    <div class="row justify-content-center p-lg-3 p-sm-3 p-md-3">
        <div class="col">
            <a href="{{ route('show.vendas') }}" class="fs-3 text-decoration-none link-secondary">
                <i class="bi bi-skip-backward-circle align-middle"></i>
            </a>
        </div>
        <div class="row my-2">
            <div class="col">
                <h1 class="mb-3 fs-4 d-block align-middle"><i class="bi bi-truck me-2 align-middle"></i>Detalhes</h1>
            </div>

        </div>
        <div class="col card p-3">
            <div class="row p-2">
                <strong class="fs-5 titleGraph text-center"> </strong>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12 mb-4">
                        <h2 class="fs-3 titleGraph mb-3">{{ $venda[0]->venda }}</h2>
                        <h2 class="mb-3 fw-bold">Informações:</h2>
                        <ul>
                            @foreach ($venda as $item)
                                <li class="my-1">Cliente: {{ $item->cliente }}</li>
                                <li class="my-1">
                                    Frete: {{ $item->frete == 0 ? 'Frete não informado.' : 'R$ ' . preco($item->frete) }}
                                </li>
                                <li class="my-1">
                                    {{ $item->ativa === 1 ? 'Venda Ativa' : 'Venda Desativada' }}
                                </li class="my-1">
                                <li class="my-1">
                                    {{ $item->saida === 1 ? 'Venda Fechada' : 'Peças em Estoque' }}
                                    @if ($item->saida === 0)
                                        <a href="{{ route('estoque.produtos') }}"
                                            class="ms-2 text-decoration-none fw-bold text-danger">SAIR.</a>
                                    @endif
                                </li>
                                <li class="my-1 fw-bold">Valor total da venda: R$ {{ preco(somarVenda($venda)['valor']) }}
                                </li>
                            @break
                        @endforeach
                        @if ($venda[0]->frete == 0 && $venda[0]->ativa == 1)
                            <li class="my-1">
                                <form action="{{ route('frete.venda') }}" method="POST" class="col-4">
                                    @method('PUT')
                                    @csrf
                                    <input type="hidden" name="venda" value="{{ $venda[0]->id }}">
                                    <input type="text" name="frete" class="form-control form-control-sm mt-4 mb-2"
                                        placeholder="Frete" required>
                                    <button type="submit" class="btn btnSuccess align-middle"
                                        style="max-height: 35px">
                                        Salvar
                                    </button>
                                </form>
                            </li>
                        @endif
                    </ul>
                </div>

                <div class="col-lg-6 col-md-12 col-sm-12 mb-4">
                    <h2 class="mb-3 fw-bold">Produtos:</h2>
                    <div class="col-12" style="max-width: 100%; overflow-x: auto">
                        <table class="table table-bordered table-striped">
                            <thead class="table-dark">
                                <th class="text-center align-middle">Produto</th>
                                <th class="text-center align-middle">Quantidade</th>
                                <th class="text-center align-middle">Preço Unitário</th>
                                <th class="text-center align-middle">Preço venda</th>
                            </thead>
                            <tbody>
                                @foreach ($venda as $item)
                                    <tr>
                                        <td class="text-center align-middle"> {{ $item->produto }} </td>
                                        <td class="text-center align-middle"> {{ $item->quantidade }} </td>
                                        <td class="text-center align-middle"> R$ {{ preco($item->preco_venda) }} </td>
                                        <th class="text-center align-middle">R$
                                            {{ preco($item->quantidade * $item->preco_venda) }}
                                        </th>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                @if ($venda[0]->ativa == 1)

                    <div class="col-12 text-center mt-4">

                        <a href="" class="btn btnDanger" data-bs-target="#confirmDelete"
                            data-bs-toggle="modal">Inativar</a>
                        <a href="{{ route('update.venda', $venda[0]->id) }}" class="btn btnPrimary">Editar</a>
                        @if (session('error_disable'))
                            <div class="text-danger alert-danger mt-2 text-center">
                                {{ session()->get('error_disable') }}
                            </div>
                        @endif
                    </div>

                @endif

            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="confirmDelete" aria-hidden="true" aria-labelledby="confirmDeleteLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-danger text-center" id="confirmDeleteLabel">
                    Atenção
                    <i class="bi bi-exclamation-triangle-fill"></i>
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Deseja inativar a venda {{ $venda[0]->venda }} <strong></strong> ?
            </div>
            <div class="modal-footer">
                <form action="{{ route('desativar.venda') }}" method="POST">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="id" value="{{ $venda[0]->id }}">
                    <button type="submit" class="btn btnDanger">
                        confirmar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
