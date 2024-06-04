@extends('dashboard.dashboard')
@section('title', 'Editar Cliente')
@section('content')
    <div class="row justify-content-center align-items-center p-3">
        <div class="col-lg-12 p-2">
            <form action="{{ route('update.submit.clientes') }}" method="POST">
                @method('PUT')
                @csrf
                <h3 class="text-center mb-3 fw-bold fs-4">Editar Cliente <i class="bi bi-people"></i></h3>
                <input type="hidden" name="id" value="{{ $cliente->id }}" required>
                <div class="mb-4 d-lg-flex justify-content-between">

                    <div class="col-lg-2 col-md-12 col-sm-12 mb-3" id="div_cnpj">
                        <label for="cnpj" class="form-label">CNPJ</label>
                        <input type="text" name="cnpj" id="cnpj" class="form-control" placeholder="CNPJ..."
                            value="{{ $cliente->cnpj }}" required>
                        @error('cnpj')
                            <div class="text-danger text-center alert-danger mt-2">
                                {{ $errors->get('cnpj')[0] }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-lg-9 col-md-12 col-sm-12 mb-3">
                        <label for="cliente" class="form-label">Cliente</label>
                        <input type="text" name="cliente" id="cliente" class="form-control"
                            placeholder="Cliente..." value="{{ $cliente->cliente }}" required>
                        @error('cliente')
                            <div class="text-danger text-center alert-danger mt-2">
                                {{ $errors->get('cliente')[0] }}
                            </div>
                        @enderror
                    </div>



                </div>

                <div class="mb-4 d-lg-flex justify-content-between">
                    <div class="col-lg-2 col-md-12 col-sm-12 mb-3">
                        <label for="telefone" class="form-label">Telefone</label>
                        <input type="texy" name="telefone" id="telefone" class="form-control" placeholder="DDD + telefone..."
                            value="{{ $cliente->telefone }}" required>
                        @error('telefone')
                            <div class="text-danger text-center alert-danger mt-2">
                                {{ $errors->get('telefone')[0] }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-lg-9 col-md-12 col-sm-12 mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" name="email" id="email" class="form-control" placeholder="Email..."
                            value="{{ $cliente->email }}" required>
                        @error('email')
                            <div class="text-danger text-center alert-danger mt-2">
                                {{ $errors->get('email')[0] }}
                            </div>
                        @enderror
                    </div>

                </div>



                <div class="mb-4 d-lg-flex justify-content-between">

                    <div class="col-lg-2 col-md-12 col-sm-12 mb-3">
                        <label for="cep" class="form-label">CEP</label>
                        <input type="text" name="cep" id="cep" class="form-control" placeholder="CEP..."
                            value="{{ $cliente->cep }}" required>
                        @error('cep')
                            <div class="text-danger text-center alert-danger mt-2">
                                {{ $errors->get('cep')[0] }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-lg-6 col-md-12 col-sm-12 mb-3">
                        <label for="cidade" class="form-label">Cidade</label>
                        <input type="text" name="cidade" id="cidade" class="form-control" placeholder="Cidade..."
                            value="{{ $cliente->cidade }}" required>
                        @error('cidade')
                            <div class="text-danger text-center alert-danger mt-2">
                                {{ $errors->get('cidade')[0] }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-lg-2 col-md-12 col-sm-12 mb-3">
                        <label for="uf" class="form-label">UF</label>
                        <input type="text" name="uf" id="uf" class="form-control" placeholder="UF..."
                            value="{{ $cliente->uf }}" required>
                        @error('uf')
                            <div class="text-danger text-center alert-danger mt-2">
                                {{ $errors->get('uf')[0] }}
                            </div>
                        @enderror
                    </div>

                </div>



                <div class="mb-4 d-lg-flex justify-content-between">

                    <div class="col-lg-5 col-md-12 col-sm-12 mb-3">
                        <label for="endereco" class="form-label">Endereço</label>
                        <input type="text" name="endereco" id="endereco" class="form-control" placeholder="Endereço..."
                            value="{{ $cliente->endereco }}" required>
                        @error('endereco')
                            <div class="text-danger text-center alert-danger mt-2">
                                {{ $errors->get('endereco')[0] }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-lg-4 col-md-12 col-sm-12 mb-3">
                        <label for="bairro" class="form-label">Bairro</label>
                        <input type="text" name="bairro" id="bairro" class="form-control" placeholder="Bairro..."
                            value="{{ $cliente->bairro }}" required>
                        @error('bairro')
                            <div class="text-danger text-center alert-danger mt-2">
                                {{ $errors->get('bairro')[0] }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-lg-2 col-sm-12">
                        <label for="num" class="form-label">N°</label>
                        <input type="number" name="num" id="num" class="form-control" placeholder="N°..."
                            value="{{ $cliente->num }}" required>
                        @error('num')
                            <div class="text-danger text-center alert-danger mt-2">
                                {{ $errors->get('num')[0] }}
                            </div>
                        @enderror
                    </div>

                </div>

                <div class="mb-3 text-center ">
                    <a href="{{ route('detalhes.fornecedores', ['id' => $cliente->id]) }}" class="btn btn-secondary me-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary ms-2">Editar</button>
                </div>

                @if (session('error_create'))
                    <div class="text-danger alert-danger mt-2 text-center">
                        {{ session()->get('error_create') }}
                    </div>
                @endif
            </form>
        </div>
    </div>
@endsection
