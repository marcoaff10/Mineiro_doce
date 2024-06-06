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
                <strong class="fs-5 text-info text-center">{{ $produto->entrada->produto }}</strong>
            </div>
            <div class="card-body">
                <div class="row justify-content-between">
                    <h2 class="mb-2 fw-bold">Informações:</h2>
                    <ul>
                        <li>Cadastrado: {{ date('d/m/Y', strtotime($produto->entrada->created_produto)) }}</li>
                        <li>Ultima atualização: {{ date('d/m/Y', strtotime($produto->entrada->updated_produto)) }}</li>
                    </ul>

                    <div class="col-12 text-center mt-4">
                        {{$produto->entrada->quantidade}}
                        <button class="btn btn-danger"data-bs-target="#confirmDelete" 
                            data-bs-toggle="modal" 
                            @if (!is_null($produto->saida) && $produto->entrada->quantidade - $produto->saida->quantidade <= 0)
                                disabled
                            @elseif (is_null($produto->saida) || $produto->entrada->quantidade > 0)
                                disabled
                            @endif>
                            Inativar
                        </button>
                        <a href="{{ route('update.produtos', ['id' => $produto->entrada->id_produto]) }}"
                            class="btn btn-primary">Editar</a>

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
                    Deseja inativar o produto <strong>{{ $produto->entrada->produto }}</strong> ?
                </div>
                <div class="modal-footer">
                    <form action="{{ route('delete.produtos') }}" method="POST">
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="id" value="{{ $produto->entrada->id_produto }}">
                        <button type="submit" class="btn btn-danger">
                            confirmar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
