@extends('dashboard.dashboard')
@section('title', 'Nova Categoria')
@section('content')


    <div class="row justify-content-center align-items-center p-3">
        <div class="col-lg-6 p-2">
            <form action="{{ route('store.categorias') }}" method="POST">
                @csrf
                <h3 class="text-center mb-3 fw-bold fs-4"><i class="bi bi-bookmark me-2 align-middle"></i>Nova Categoria </h3>

                <div class="mb-4">
                    <label for="categoria" class="form-label">Categoria</label>
                    <input type="text" name="categoria" id="categoria" class="form-control" placeholder="Categoria..."
                        value="{{ old('categoria') }}" required>
                    @error('categoria')
                        <div class="text-danger text-center alert-danger mt-2">
                            {{ $errors->get('categoria')[0] }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3 text-center ">
                    <a href="{{ route('show.categorias') }}" class="btn btnSecondary me-2">Cancelar</a>
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
