@extends('dashboard.dashboard')
@section('title', 'Detalhes do Produto')
@section('content')
    <div class="row justify-content-center p-lg-5 p-sm-3 p-md-3">
        <div class="row my-2">
            <div class="col">
                <h1 class="mb-3 fs-4 d-block align-middle">Detalhes <i class="bi bi-box ms-1"></i></h1>

            </div>

            {{-- <div class="col text-end">
                <a href="{{route('show.fornecedores')}}" class="btn btn-dark">
                    <i class="bi bi-skip-backward-fill"></i>
                </a>
            </div> --}}
        </div>
        <div class="col card p-3">
            <div class="row p-2">
                <strong class="fs-5 text-info text-center">{{ $produto->produto }}</strong>
            </div>
            <div class="card-body">
                <div class="row justify-content-between">
                    <div class="col-sm-12 col-md-3 col-lg-3 mt-3">
                        <h2 class="mb-2 fw-bold">Informações de estoque:</h2>
                        <ul>
                            <li>Estoque Mínimo: {{ $produto->minimo }}</li>
                            <li>Estoque Máxima: {{ $produto->maximo }}</li>
                            <li>Estoque Total: {{ $produto->estoque }}</li>
                            <li>Estoque Situação: </li>
                        </ul>
                    </div>

                    <div class="col-sm-12 col-md-3 col-lg-3 mt-3">
                        <h2 class="mb-2 fw-bold">Valores totais de entrada:</h2>
                        <ul>
                            <li>Valor total de compra: R$ {{ somaProdutos($produtoEntrada->items())['valor'] }}</li>
                            <li>Valor total de fretes: R$ {{ somaProdutos($produtoEntrada->items())['frete'] }}</li>
                        </ul>
                    </div>

                    <div class="col-sm-12 col-md-3 col-lg-3 mt-3">
                        <h2 class="mb-2 fw-bold">Valores totais de saida:</h2>
                        <ul>
                            <li>Valor total de compra: {{ somaProdutos($produtoSaida->items())['valor'] }}</li>
                            <li>Valor total de fretes: R$ {{ somaProdutos($produtoSaida->items())['frete'] }}</li>
                        </ul>
                    </div>

                    <div class="col-sm-12 col-md-3 col-lg-3 mt-3">
                        <h2 class="mb-2 fw-bold">Informações:</h2>
                        <ul>
                            <li>Cadastrado: {{ date('d/m/Y', strtotime($produto->created_at)) }}</li>
                            <li>Ultima atualização: {{ date('d/m/Y', strtotime($produto->updated_at)) }}</li>
                        </ul>
                    </div>

                    <div class="col-12 text-center mt-5">

                        <button class="btn btn-danger" data-bs-target="#confirmDelete" data-bs-toggle="modal"
                            @if ($produto->estoque > 0) disabled @endif>
                            Inativar
                        </button>
                        <a href="{{ route('update.produtos', $produto->id) }}" class="btn btn-primary">Editar</a>

                    </div>


                    {{-- ====================================== - Produtos Entrada - ============================================== --}}
                    <div class="row mt-3 py-5">
                        <div class="row ">
                            <h1 class="mb-3 fs-4 d-block">Entradas</h1>
                        </div>
                        <div class="col-12" style="max-width: 100%; overflow-x: auto">
                            <table class="table table-bordered table-striped">
                                <thead class="table-dark">
                                    <th class="text-center align-middle">Produto</th>
                                    <th class="text-center align-middle">Motivo</th>
                                    <th class="text-center align-middle">QTDE</th>
                                    <th class="text-center align-middle">Valor uni.</th>
                                    <th class="text-center align-middle">Frete</th>
                                    <th class="text-center align-middle">Fornecedor</th>
                                    <th class="text-center align-middle">Data</th>
                                    <th class="text-center align-middle">Usuário</th>
                                </thead>
                                <tbody>
                                    @foreach ($produtoEntrada->items() as $entrada)
                                        <tr>
                                            <td class=" align-middle">{{ $entrada->produto }}</td>
                                            <td class=" align-middle">{{ motivoEntrada($entrada->motivo) }}</td>
                                            <td class="text-center align-middle">{{ $entrada->quantidade }}</td>
                                            <td class="text-center align-middle">R$ {{ $entrada->valor_unidade }}</td>
                                            <td class="text-center align-middle">R$ {{ $entrada->frete }}</td>
                                            <td class=" align-middle">{{ $entrada->fornecedor ?? '-' }}</td>
                                            <td class="text-center align-middle">
                                                {{ date('d/m/Y', strtotime($entrada->created_at)) }}</td>
                                            <td class=" align-middle">{{ auth()->user()->name }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <x-pagination :paginator="$produtoEntrada" :appends="$filters" />
                    </div>
                    <hr class="mb-1">
                    <hr class="mt-1">
                    {{-- ====================================== - Produtos Saida - ============================================== --}}
                    <div class="row mt-5">
                        <div class="row ">
                            <h1 class="mb-3 fs-4 d-block">Saidas</h1>
                        </div>
                        <div class="col-12" style="max-width: 100%; overflow-x: auto">
                            <table class="table table-bordered table-striped">
                                <thead class="table-dark">
                                    <th class="text-center align-middle">Produto</th>
                                    <th class="text-center align-middle">Motivo</th>
                                    <th class="text-center align-middle">QTDE</th>
                                    <th class="text-center align-middle">Valor uni.</th>
                                    <th class="text-center align-middle">Frete</th>
                                    <th class="text-center align-middle">Fornecedor</th>
                                    <th class="text-center align-middle">Data</th>
                                    <th class="text-center align-middle">Usuário</th>
                                </thead>
                                <tbody>
                                    @foreach ($produtoSaida->items() as $saida)
                                        <tr>
                                            <td class=" align-middle">{{ $saida->produto }}</td>
                                            <td class=" align-middle">{{ motivoSaida($saida->motivo) }}</td>
                                            <td class="text-center align-middle">{{ $saida->quantidade }}</td>
                                            <td class="text-center align-middle">R$ {{ $saida->valor_unidade }}</td>
                                            <td class="text-center align-middle">R$ {{ $saida->frete }}</td>
                                            <td class=" align-middle">{{ $saida->cliente ?? '-' }}</td>
                                            <td class="text-center align-middle">
                                                {{ date('d/m/Y', strtotime($saida->created_at)) }}</td>
                                            <td class=" align-middle">{{ auth()->user()->name }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <x-pagination :paginator="$produtoSaida" :appends="$filters" />
                    </div>

                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="confirmDelete" aria-hidden="true" aria-labelledby="confirmDeleteLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-danger text-center" id="confirmDeleteLabel">Atenção <i
                            class="bi bi-exclamation-triangle-fill"></i></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Deseja inativar o produto <strong></strong> ?
                </div>
                <div class="modal-footer">
                    <form action="{{ route('delete.produtos') }}" method="POST">
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="id" value="{{ $produto->id }}">
                        <button type="submit" class="btn btn-danger">
                            confirmar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
