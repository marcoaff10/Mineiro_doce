@extends('dashboard.dashboard')
@section('title', 'Editar Produto')
@section('content')
    <div class="row justify-content-center align-items-center p-3">
        <div class="col-lg-12 p-2">
            <form action="{{ route('update.submit.produtos') }}" method="POST">
                @method('PUT')
                @csrf
                <h3 class="text-center mb-3 fw-bold fs-4">Editar Produto <i class="bi bi-box"></i></h3>
                <input type="hidden" name="id" value="{{ $produto->id }}">


                <div class="mb-3 d-lg-flex justify-content-between">

                    <div class="col-lg-5 col-sm-12 mb-3">
                        <label for="categoria" class="form-label">Categoria</label>
                        <select name="categoria" id="categoria" class="form-select">
                            <option value="" selected>Selecione uma categoria</option>
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}" {{$produto->categoria_id == $categoria->id ? 'selected' : ''}}>
                                    {{ $categoria->categoria }}
                                </option>
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
                            value="{{ $produto->produto }}">
                        @error('produto')
                            <div class=" text-danger alert-danger mt-2">
                                {{ $errors->get('produto')[0] }}
                            </div>
                        @enderror
                    </div>

                </div>

                <div class="mb-4 row justify-content-between">
                    <div class="col-sm-12 col-md-3 col-lg-3">
                        <label for="peso" class="form-label">Peso</label>
                        <input type="number" name="peso" id="peso" class="form-control" placeholder="Peso..."
                            value="{{ $produto->peso }}" required>
                        @error('peso')
                            <div class=" text-danger alert-danger mt-2">
                                {{ $errors->get('peso')[0] }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-sm-12 col-md-3 col-lg-3">
                        <label for="minimo" class="form-label">Mínino</label>
                        <input type="number" name="minimo" id="minimo" class="form-control" placeholder="Mín..."
                            value="{{ $produto->minimo }}" required>
                        @error('minimo')
                            <div class=" text-danger alert-danger mt-2">
                                {{ $errors->get('minimo')[0] }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-sm-12 col-md-3 col-lg-3">
                        <label for="maximo" class="form-label">Máximo</label>
                        <input type="number" name="maximo" id="maximo" class="form-control" placeholder="Máx..."
                            value="{{ $produto->maximo }}" required>
                        @error('maximo')
                            <div class=" text-danger alert-danger mt-2">
                                {{ $errors->get('maximo')[0] }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 text-center ">
                    <a href="{{ route('movimentacao.produtos', ['id' => $produto->id]) }}" class="btn btn-secondary me-2">Cancelar</a>
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
