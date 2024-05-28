@extends('dashboard.dashboard')
@section('content')
    <div class="row justify-content-center p-lg-5 p-sm-3 p-md-3">
        <h1 class="mb-3 fs-4 d-block">Detalhes <i class="bi bi-box ms-1"></i></h1>
        <div class="col card p-3">
            <div class="row p-2">
                <strong class="fs-5 text-info text-center">{{ $fornecedor->fornecedor }}</strong>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4 col-md-12 col-sm-12 mb-4">
                        <h2 class="mb-3 fw-bold">Informações de contato:</h2>
                        <ul>
                            <li>E-mail: {{ $fornecedor->email }}</li>
                            <li>Telefone: {{ telefone($fornecedor->telefone) }}</li>
                            <li>CNPJ: {{ cnpj($fornecedor->cnpj) }}</li>
                        </ul>
                    </div>

                    <div class="col-lg-4 col-md-12 col-sm-12 mb-4">
                        <h2 class="mb-3 fw-bold">Endereço:</h2>
                        <ul>
                            <li>Cidade: {{ $fornecedor->cidade }}</li>
                            <li>Estado: {{ $fornecedor->uf }}</li>
                            <li>CEP: {{ $fornecedor->cep }}</li>
                            <li>Logradouro: {{ $fornecedor->endereco . ', ' . $fornecedor->num }}</li>
                            <li>Bairro: {{ $fornecedor->bairro }}</li>
                        </ul>
                    </div>

                    <div class="col-lg-4 col-md-12 col-sm-12 mb-4">
                        <h2 class="mb-3 fw-bold">datas:</h2>
                        <ul>
                            <li>Cadastrado: {{ date('d/m/Y', strtotime($fornecedor->created_at)) }}</li>
                            <li>Ultima atualização: {{ date('d/m/Y', strtotime($fornecedor->updated_at)) }}</li>
                        </ul>
                    </div>

                    <div class="col-12 text-center mt-4">

                        <a href="" class="btn btn-secondary">Inativar</a>
                        <a href="" class="btn btn-primary">Editar</a>
                        
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
