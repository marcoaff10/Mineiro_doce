@extends('auth.dashboard.dashboard')
@section('content')
    <div class="row justify-content-center align-items-center p-3">
        <div class="col-lg-12 p-2">
            <form action="" method="post">
                @csrf
                <h3 class="text-center mb-3 fw-bold fs-4">Novo Produto <i class="bi bi-box"></i></h3>

                <div class="mb-3">
                    <label for="produto" class="form-label">Produto</label>
                    <input type="text" name="produto" id="produto" class="form-control" placeholder="Produto..."
                        value="{{ old('produto') }}">
                </div>

                <div class="mb-3">
                    <label for="fornecedor" class="form-label">Fornecedor</label>
                    <select name="fornecedor" id="fornecedor" class="form-select">
                        <option value="">Fornecedor</option>
                        <option value="">Fornecedor</option>
                        <option value="">Fornecedor</option>
                        <option value="">Fornecedor</option>
                        <option value="">Fornecedor</option>
                    </select>
                </div>

                <div class="mb-4">
                    <div class="d-flex justify-content-start align-items-center ">
                        <div class="me-4">
                            <label for="peso" class="form-label">Peso</label>
                            <input type="number" name="peso" id="peso" class="form-control" placeholder="Peso..."
                                value="{{ old('peso') }}">
                        </div>

                        <div class="">
                            <label for="quantidade" class="form-label">Quantidade</label>
                            <input type="number" name="quantidade" id="quantidade" class="form-control"
                                placeholder="Quantidade..." value="{{ old('quantidade') }}">
                        </div>
                    </div>
                </div>

                <div class="mb-3 text-center ">
                    <a href="" class="btn btn-secondary me-2">Cancelar <i class="bi bi-x-octagon ms-1"></i></a>
                    <button type="submit" class="btn btn-primary ms-2">Cadastrar</button>
                </div>


            </form>
        </div>
    </div>
@endsection
