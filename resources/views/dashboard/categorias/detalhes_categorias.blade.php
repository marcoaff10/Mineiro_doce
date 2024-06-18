@extends('dashboard.dashboard')
@section('title', 'Detalhes da Categoria')
@section('content')
    <div class="row justify-content-center p-lg-3 p-sm-3 p-md-3">
        <div class="row">
            <div class="col">
                <a href="{{route('show.categorias')}}" class="fs-3 text-decoration-none link-secondary">
                    <i class="bi bi-skip-backward-circle align-middle"></i>
                </a>
            </div>
        </div>
        <div class="row my-2">
            <div class="col">
                <h1 class="mb-3 fs-4 d-block align-middle"><i class="bi bi-bookmark me-2 align-middle"></i>Detalhes</h1>
            </div>
        </div>
        <div class="col card p-3">
            <div class="row p-2">
                <strong class="fs-3 text-info text-center">{{ $categoria->categoria }}</strong>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4 col-md-12 col-sm-12 mb-4">
                        <h2 class="mb-3 fw-bold">Informações:</h2>
                        <ul>
                            <li>Criado em: {{ date('d/m/Y', strtotime($categoria->created_at)) }}</li>
                            <li>Ultima atualização: {{ date('d/m/Y', strtotime($categoria->updated_at)) }}</li>
                        </ul>
                    </div>

                    <div class="col-12 text-center mt-4">

                        <a href="" class="btn btn-danger" data-bs-target="#confirmDelete"
                            data-bs-toggle="modal">Inativar</a>
                        <a href="{{ route('update.categorias', ['id' => $categoria->id]) }}"
                            class="btn btn-primary">Editar</a>

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
                        Deseja inativar a categoria <strong>{{ $categoria->categoria }}</strong> ?
                    </div>
                    <div class="modal-footer">
                            <a href="{{ route('inativar.categorias', $categoria->id) }}" class="btn btn-danger">
                                confirmar
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    @endsection
