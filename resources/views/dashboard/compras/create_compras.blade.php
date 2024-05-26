@extends('dashboard.dashboard')
@section('content')
    <div class="row justify-content-center align-items-center p-3">
        <div class="col p-2">
            <form action="" method="post">
                @csrf
                <h3 class="text-center mb-3 fw-bold ">Nova Compra <i class="bi bi-bag ms-1"></i></h3>
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

                <div class="mb-3">
                    <label for="produto" class="form-label">Produto</label>
                </div>
            </form>
        </div>
    </div>
@endsection