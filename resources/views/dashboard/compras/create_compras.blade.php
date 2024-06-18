@extends('dashboard.dashboard')
@section('title', 'Nova Compra')
@section('content')
    <div class="row justify-content-center align-items-center p-3">
        <div class="col-lg-12 p-2">
            <form action="{{ route('store.compras') }}" method="POST">
                @csrf
                <h1 class="text-center mb-3 fw-bold fs-4"><i class="bi bi-cart-plus me-2 align-middle"></i>Nova Compra </h1>

                <div class="mb-3 d-lg-flex justify-content-center">

                    <div class="col-lg-5 col-sm-12 mb-3">
                        <label for="fornecedor" class="form-label">Fornecedor</label>
                        <select name="fornecedor" id="fornecedor" class="form-select" >
                            <option value="" selected>Selecione um Fornecedor</option>
                            @foreach ($fornecedores as $fornecedor)
                                <option value="{{ $fornecedor->id }}">{{ $fornecedor->fornecedor }}</option>
                            @endforeach
                        </select>
                        @error('fornecedor')
                            <div class="text-center text-danger alert-danger mt-2">
                                {{ $errors->get('fornecedor')[0] }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="mt-3 text-center ">
                    <a href="{{ route('show.compras') }}" class="btn btn-secondary me-2">Cancelar</a>
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
