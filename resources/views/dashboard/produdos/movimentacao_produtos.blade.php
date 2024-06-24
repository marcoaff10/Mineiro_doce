@extends('dashboard.dashboard')
@section('title', 'Detalhes do Produto')
@section('content')
    <div class="row justify-content-center p-lg-3 p-sm-3 p-md-3">
        <div class="row">
            <div class="col">
                <a href="{{ route('estoque.produtos') }}" class="fs-3 text-decoration-none link-secondary">
                    <i class="bi bi-skip-backward-circle align-middle"></i>
                </a>
            </div>
        </div>
        <div class="row my-2">
            <div class="col">
                <h1 class="mb-3 fs-4 d-block align-middle"><i class="bi bi-box me-2 align-middle"></i>Detalhes </h1>

            </div>
        </div>
        <div class="col card p-3">
            <div class="row p-2">
                <strong class="fs-3 titleGraph text-center">{{ $produto->produto }}</strong>
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

                    <div class="col-12 text-center my-5">

                        <button class="btn btnDanger" data-bs-target="#confirmDelete" data-bs-toggle="modal"
                            @if ($produto->estoque > 0 && count($inativarVenda) > 0 || $produto->estoque > 0 && count($inativarCompra) > 0) disabled @endif>
                            Inativar
                        </button>
                        <a href="{{ route('update.produtos', $produto->id) }}" class="btn btnPrimary">Editar</a>

                    </div>

                    <div class="row justify-content-center align-items-center py-4">
                        <div class="col-sm-12 col-md-8 col-lg-8 text-center">
                            
                            <x-analise-produtos :id="$produto->id" />

                        </div>
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
                    <a href="{{ route('inativar.produto', $produto->id)}}" class="btn btnDanger">
                        confirmar
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection
