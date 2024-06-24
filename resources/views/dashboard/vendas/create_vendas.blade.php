@extends('dashboard.dashboard')
@section('title', 'Nova Venda')
@section('content')
    <div class="row justify-content-center align-items-center p-3">
        <div class="col-lg-12 p-2">
            <form action="{{ route('store.vendas') }}" method="POST">
                @csrf
                <h3 class="text-center mb-3 fw-bold fs-4"><i class="bi bi-truck me-2 align-middle"></i>Nova Venda </h3>

                <div class="mb-3 d-lg-flex justify-content-center">

                    <div class="col-lg-5 col-sm-12 mb-3">
                        <label for="cliente" class="form-label">Cliente</label>
                        <select name="cliente" id="cliente" class="form-select" >
                            <option value="" selected>Selecione um cliente</option>
                            @foreach ($clientes as $cliente)
                                <option value="{{ $cliente->id }}">{{ $cliente->cliente }}</option>
                            @endforeach
                        </select>
                        @error('cliente')
                            <div class="text-center text-danger alert-danger mt-2">
                                {{ $errors->get('cliente')[0] }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="mt-3 text-center ">
                    <a href="{{ route('show.vendas') }}" class="btn btnSecondary me-2">Cancelar</a>
                    <button type="submit" class="btn btnPrimary ms-2">Cadastrar</button>
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
