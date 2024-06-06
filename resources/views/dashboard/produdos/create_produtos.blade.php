@extends('dashboard.dashboard')
@section('title', 'Novo Produto')
@section('content')
    <div class="row justify-content-center align-items-center p-3">
        <div class="col-lg-12 p-2">
            <form action="{{ route('store.produtos') }}" method="POST">
                @csrf
                <h3 class="text-center mb-3 fw-bold fs-4">Novo Produto <i class="bi bi-box"></i></h3>

                <div class="mb-3 d-lg-flex justify-content-between">

                    <div class="col-lg-5 col-sm-12 mb-3">
                        <label for="categoria" class="form-label">Categoria</label>
                        <select name="categoria" id="categoria" class="form-select" required>
                            <option value="" selected>Selecione uma categoria</option>
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}">{{ $categoria->categoria }}</option>
                            @endforeach
                        </select>
                        @error('categoria')
                            <div class=" text-danger alert-danger mt-2">
                                {{ $errors->get('categoria')[0] }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-lg-5 col-sm-12 mb-3">
                        <label for="produto" class="form-label">Produto</label>
                        <input type="text" name="produto" id="produto" class="form-control" placeholder="Produto..."
                            value="{{ old('produto') }}" required>
                        @error('produto')
                            <div class=" text-danger alert-danger mt-2">
                                {{ $errors->get('produto')[0] }}
                            </div>
                        @enderror
                    </div>

                </div>

                <div class="mb-4 d-flex justify-content-between">
                    <div class="col-3">
                        <label for="peso" class="form-label">Peso</label>
                        <input type="number" name="peso" id="peso" class="form-control" placeholder="Peso..."
                            value="{{ old('peso') }}" required>
                        @error('peso')
                            <div class=" text-danger alert-danger mt-2">
                                {{ $errors->get('peso')[0] }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-3">
                        <label for="minimo" class="form-label">Mínino</label>
                        <input type="number" name="minimo" id="minimo" class="form-control" placeholder="Mín..."
                            value="{{ old('minimo') }}" required>
                        @error('minimo')
                            <div class=" text-danger alert-danger mt-2">
                                {{ $errors->get('minimo')[0] }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-3">
                        <label for="maximo" class="form-label">Máximo</label>
                        <input type="number" name="maximo" id="maximo" class="form-control" placeholder="Máx..."
                            value="{{ old('maximo') }}" required>
                        @error('maximo')
                            <div class=" text-danger alert-danger mt-2">
                                {{ $errors->get('maximo')[0] }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="mt-3 text-center ">
                    <a href="{{ route('show.produtos') }}" class="btn btn-secondary me-2">Cancelar</a>
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
