@extends('dashboard.dashboard')
@section('title', 'Novo Fornecedor')
@section('content')
    <div class="row justify-content-center align-items-center p-3">
        <div class="col-lg-8 p-2">
            <form action="{{ route('store.fornecedores') }}" method="POST">
                @csrf
                <h1 class="text-center mb-3 fw-bold fs-4"><i class="bi bi-shop me-2 align-middle"></i>Novo Fornecedor</h1>

                <div class="mb-4 d-lg-flex justify-content-between">

                    <div class="col-lg-3 col-md-12 col-sm-12 mb-3" id="div_cnpj">
                        <label class="form-label">CNPJ</label>
                        <input type="text" name="cnpj" id="cnpjFornecedor" class="form-control" placeholder="CNPJ..."
                            value="{{ old('cnpj') }}" required>
                        @error('cnpj')
                            <div class="text-danger text-center alert-danger mt-2">
                                {{ $errors->get('cnpj')[0] }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-lg-8 col-md-12 col-sm-12 mb-3">
                        <label class="form-label">Fornecedor</label>
                        <input type="text" name="fornecedor" id="fornecedor" class="form-control"
                            placeholder="Fornecedor..." value="{{ old('fornecedor') }}" required>
                        @error('fornecedor')
                            <div class="text-danger text-center alert-danger mt-2">
                                {{ $errors->get('fornecedor')[0] }}
                            </div>
                        @enderror
                    </div>



                </div>

                <div class="mb-4 d-lg-flex justify-content-between">
                    <div class="col-lg-3 col-md-12 col-sm-12 mb-3">
                        <label class="form-label">Telefone</label>
                        <input type="texy" name="telefone" id="telefoneFornecedor" class="form-control" placeholder="DDD + telefone..."
                            value="{{ old('telefone') }}">
                        @error('telefone')
                            <div class="text-danger text-center alert-danger mt-2">
                                {{ $errors->get('telefone')[0] }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-lg-8 col-md-12 col-sm-12 mb-3">
                        <label class="form-label">Email</label>
                        <input type="text" name="email" id="emailFornecedor" class="form-control" placeholder="Email..."
                            value="{{ old('email') }}">
                        @error('email')
                            <div class="text-danger text-center alert-danger mt-2">
                                {{ $errors->get('email')[0] }}
                            </div>
                        @enderror
                    </div>

                </div>

                <div class="mb-4 d-lg-flex justify-content-between">

                    <div class="col-lg-3 col-md-12 col-sm-12 mb-3">
                        <label class="form-label">CEP</label>
                        <input type="text" name="cep" id="cepFornecedor" class="form-control" placeholder="CEP..."
                            value="{{ old('cep') }}" required>
                        @error('cep')
                            <div class="text-danger text-center alert-danger mt-2">
                                {{ $errors->get('cep')[0] }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-lg-5 col-md-12 col-sm-12 mb-3">
                        <label class="form-label">Cidade</label>
                        <input type="text" name="cidade" id="cidadeFornecedor" class="form-control" placeholder="Cidade..."
                            value="{{ old('cidade') }}" required>
                        @error('cidade')
                            <div class="text-danger text-center alert-danger mt-2">
                                {{ $errors->get('cidade')[0] }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-lg-2 col-md-12 col-sm-12 mb-3">
                        <label class="form-label">UF</label>
                        <input type="text" name="uf" id="ufFornecedor" class="form-control" placeholder="UF..."
                            value="{{ old('uf') }}" required>
                        @error('uf')
                            <div class="text-danger text-center alert-danger mt-2">
                                {{ $errors->get('uf')[0] }}
                            </div>
                        @enderror
                    </div>

                </div>

                <div class="mb-4 d-lg-flex justify-content-between">

                    <div class="col-lg-5 col-md-12 col-sm-12 mb-3">
                        <label class="form-label">Endereço</label>
                        <input type="text" name="endereco" id="enderecoFornecedor" class="form-control" placeholder="Endereço..."
                            value="{{ old('endereco') }}" required>
                        @error('endereco')
                            <div class="text-danger text-center alert-danger mt-2">
                                {{ $errors->get('endereco')[0] }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-lg-4 col-md-12 col-sm-12 mb-3">
                        <label class="form-label">Bairro</label>
                        <input type="text" name="bairro" id="bairroFornecedor" class="form-control" placeholder="Bairro..."
                            value="{{ old('bairro') }}">
                        @error('bairro')
                            <div class="text-danger text-center alert-danger mt-2">
                                {{ $errors->get('bairro')[0] }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-lg-2 col-sm-12">
                        <label class="form-label">N°</label>
                        <input type="number" name="num" id="numFornecedor" class="form-control" placeholder="N°..."
                            value="{{ old('num') }}">
                        @error('num')
                            <div class="text-danger text-center alert-danger mt-2">
                                {{ $errors->get('num')[0] }}
                            </div>
                        @enderror
                    </div>

                </div>

                <div class="mb-3 text-center ">
                    <a href="{{ route('show.fornecedores') }}" class="btn btn-secondary me-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary ms-2">Cadastrar</button>
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
