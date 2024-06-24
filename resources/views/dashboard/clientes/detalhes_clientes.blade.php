@extends('dashboard.dashboard')
@section('title', 'Detalhes do Cliente')
@section('content')
    <div class="row justify-content-center p-lg-3 p-sm-3 p-md-3">
        <div class="col">
            <a href="{{ route('show.clientes') }}" class="fs-3 text-decoration-none link-secondary">
                <i class="bi bi-skip-backward-circle align-middle"></i>
            </a>
        </div>
        <div class="row my-2">
            <div class="col">
                <h1 class="mb-3 fs-4 d-block align-middle">Detalhes <i class="bi bi-people ms-1"></i></h1>
            </div>
        </div>
        <div class="col card p-3">
            <div class="row p-2">
                <strong class="fs-3 titleGraph text-center">{{ $cliente->cliente }}</strong>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4 col-md-12 col-sm-12 mb-4">
                        <h2 class="mb-3 fw-bold">Informações de contato:</h2>
                        <ul>
                            <li>E-mail: {{ $cliente->email == null ? 'Não informado.' : $cliente->email }}</li>
                            <li>Telefone:
                                {{ $cliente->telefone == null ? 'Não informado.' : telefone($cliente->telefone) }}</li>
                            <li>CNPJ: {{ cnpj($cliente->cnpj) }}</li>
                        </ul>
                    </div>

                    <div class="col-lg-4 col-md-12 col-sm-12 mb-4">
                        <h2 class="mb-3 fw-bold">Endereço:</h2>
                        <ul>
                            <li>Cidade: {{ $cliente->cidade }}</li>
                            <li>Estado: {{ $cliente->uf }}</li>
                            <li>CEP: {{ $cliente->cep }}</li>
                            <li>Logradouro:
                                {{ $cliente->endereco . ', ' . ($cliente->num == null ? 'S/N' : $cliente->num) }}
                            </li>
                            <li>Bairro: {{ $cliente->bairro == null ? 'Não informado.' : $cliente->bairro }}</li>
                        </ul>
                    </div>


                    <div class="col-lg-4 col-md-12 col-sm-12 mb-4">
                        <h2 class="mb-3 fw-bold">datas:</h2>
                        <ul>
                            <li>Cadastrado: {{ date('d/m/Y', strtotime($cliente->created_at)) }}</li>
                            <li>Ultima atualização: {{ date('d/m/Y', strtotime($cliente->updated_at)) }}</li>
                        </ul>
                    </div>

                    <div class="col-12 text-center mt-4">

                        <button href="" class="btn btnDanger" data-bs-target="#confirmDelete"
                            data-bs-toggle="modal" @if (count($vendaCliente) > 0) disabled @endif>
                            Inativar
                        </button>
                        <a href="{{ route('update.clientes', ['id' => $cliente->id]) }}" class="btn btnPrimary">Editar</a>

                    </div>

                </div>

                @if (count($ativas->items()) > 0)
                    <x-venda-ativa-cliente :ativas="$ativas" :filters="$filters" />
                @endif

                {{-- ====================================================================================================================================== --}}

                @if (count($fechadas->items()) > 0)
                    <x-venda-fechada-cliente :fechadas="$fechadas" :filters="$filters" />
                @endif

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
                    Deseja inativar o cliente <strong>{{ $cliente->cliente }}</strong> ?
                </div>
                <div class="modal-footer">
                    <a href="{{ route('inativar.cliente', $cliente->id) }}" class="btn btnDanger">
                        confirmar
                    </a>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
