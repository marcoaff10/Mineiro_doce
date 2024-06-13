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
                <strong class="fs-3 text-info text-center">{{ $produto->produto }}</strong>
            </div>
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-sm-12 col-md-6 col-lg-6 my-4">
                        <div class="row mb-3 justify-content-center">
                            <div class="col-sm-12 col-md-7 col-lg-7">
                                <h2 class="mb-2 fw-bold">Informações de Estoque:</h2>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-sm-12 col-md-7 col-lg-7">
                                <p>Estoque Mínimo: {{ $produto->minimo }}</p>
                                <p>Estoque Máxima: {{ $produto->maximo }}</p>
                                <p>Estoque Total: {{ $produto->estoque == null ? '0' : $produto->estoque }}</p>
                                <p>Estoque Situação:</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-6 my-4">
                        <div class="row mb-3 justify-content-center">
                            <div class="col-sm-12 col-md-7 col-lg-7">
                                <h2 class="mb-2 fw-bold">Informações:</h2>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-sm-12 col-md-7 col-lg-7">
                                <p>Cadastrado: {{ date('d/m/Y', strtotime($produto->created_at)) }}</p>
                                <p>Ultima atualização: {{ date('d/m/Y', strtotime($produto->updated_at)) }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-6 my-4 ">
                        <div class="row mb-3 justify-content-center">
                            <div class="col-sm-12 col-md-7 col-lg-7">
                                <h2 class="mb-2 fw-bold">Histórico de Compras:</h2>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-sm-12 col-md-7 col-lg-7">
                                <p>Valor mais baixo de compra:
                                    {{ $produto->min_compra == null ? '' : 'R$ ' . preco($produto->min_compra) }}</p>
                                <p>Valor mais alto de compra:
                                    {{ $produto->max_compra == null ? '' : 'R$ ' . preco($produto->max_compra) }}</p>
                                <p>Valor médio de compra:
                                    {{ $produto->avg_compra == null ? '' : 'R$ ' . preco($produto->avg_compra) }}</p>

                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-6 my-4">
                        <div class="row mb-3 justify-content-center">
                            <div class="col-sm-12 col-md-7 col-lg-7">
                                <h2 class="mb-2 fw-bold">Histórico de Vendas:</h2>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-sm-12 col-md-7 col-lg-7">
                                <p>Valor mais baixo de venda:
                                    {{ $produto->min_venda == null ? '' : 'R$ ' . preco($produto->min_venda) }}</p>
                                <p>Valor mais alto de venda:
                                    {{ $produto->max_venda == null ? '' : 'R$ ' . preco($produto->max_venda) }}</p>
                                <p>Valor médio de venda:
                                    {{ $produto->avg_venda == null ? '' : 'R$ ' . preco($produto->avg_venda) }}</p>

                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-start align-items-center py-4">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <h1 class="fw-bold fs-4 text-success">
                                Lucro por unidade:
                                {{ $produto->lucro == null ? '' : 'R$ ' . preco($produto->lucro) }}
                            </h1>

                        </div>
                    </div>

                    <div class="col-12 text-center mt-5">

                        <button class="btn btn-danger" data-bs-target="#confirmDelete" data-bs-toggle="modal"
                            @if ($produto->estoque > 0) disabled @endif>
                            Inativar
                        </button>
                        <a href="{{ route('update.produtos', $produto->id) }}" class="btn btn-primary">Editar</a>

                    </div>

                    @if (count($entradas->items()) > 0)
                        <x-entrada-produto :entradas="$entradas" :filters="$filters" />
                    @endif
                    {{-- ====================================== - Produtos Entrada - ============================================== --}}

                    {{-- ====================================== - Produtos Saida - ============================================== --}}
                    @if (count($saidas->items()) > 0)
                        <x-saida-produto :saidas="$saidas" :filters="$filters" />
                    @endif

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
