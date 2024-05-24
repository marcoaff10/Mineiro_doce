@extends('auth.dashboard.dashboard')
@section('content')
    <div class="row justify-content-center align-items-center p-3">
        <div class="col-lg-12 p-2">
            <form action="{{ route('store.produtos') }}" method="POST">
                @csrf
                <h3 class="text-center mb-3 fw-bold fs-4">Novo Produto <i class="bi bi-box"></i></h3>

                <div class="mb-3">
                    <label for="produto" class="form-label">Produto</label>
                    <input type="text" name="produto" id="produto" class="form-control" placeholder="Produto..."
                        value="{{ old('produto') }}">
                    @error('produto')
                        <div class=" text-danger alert-danger mt-2">
                            {{ $errors->get('produto')[0] }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="categoria" class="form-label">Categoria</label>
                    <select name="categoria" id="categoria" class="form-select">
                        <option value="" selected>Selecione uma categoria</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id_categoria }}">{{ $categoria->categoria }}</option>
                        @endforeach
                    </select>
                    @error('categoria')
                        <div class=" text-danger alert-danger mt-2">
                            {{ $errors->get('categoria')[0] }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="peso" class="form-label">Peso</label>
                    <input type="number" name="peso" id="peso" class="form-control" placeholder="Peso..."
                        value="{{ old('peso') }}">
                    @error('peso')
                        <div class=" text-danger alert-danger mt-2">
                            {{ $errors->get('peso')[0] }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3 text-center ">
                    <a href="" class="btn btn-secondary me-2">Cancelar</a>
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
