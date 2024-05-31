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
                <div class="mb-4">
                    <label for="produto" class="form-label">Produto</label>
                    <input type="text" name="produto" id="produto" class="form-control" placeholder="Produto..."
                        value="{{ $produto->produto }}">
                    @error('produto')
                        <div class=" text-danger alert-danger mt-2">
                            {{ $errors->get('produto')[0] }}
                        </div>
                    @enderror
                </div>

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
                        <label for="fornecedor" class="form-label">Fornecedor</label>
                        <select name="fornecedor" id="fornecedor" class="form-select">
                            <option value="" selected>Selecione uma Fornecedor</option>
                            @foreach ($fornecedores as $fornecedor)
                                <option value="{{ $fornecedor->id }}" {{$produto->fornecedor_id == $fornecedor->id ? 'selected' : ''}}>
                                    {{ $fornecedor->fornecedor }}
                                </option>
                            @endforeach
                        </select>
                        @error('fornecedor')
                            <div class=" text-danger alert-danger mt-2">
                                {{ $errors->get('fornecedor')[0] }}
                            </div>
                        @enderror
                    </div>

                </div>

                <div class="mb-4 d-flex justify-content-between">
                    <div class="col-5">
                        <label for="peso" class="form-label">Peso</label>
                        <input type="number" name="peso" id="peso" class="form-control" placeholder="Peso..."
                            value="{{ $produto->peso }}">
                        @error('peso')
                            <div class=" text-danger alert-danger mt-2">
                                {{ $errors->get('peso')[0] }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-5">
                        <label for="minimo" class="form-label">Mínina</label>
                        <input type="number" name="minimo" id="minimo" class="form-control" placeholder="Mínimo..."
                            value="{{ $produto->minimo }}">
                        @error('minimo')
                            <div class=" text-danger alert-danger mt-2">
                                {{ $errors->get('minimo')[0] }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 text-center ">
                    <a href="{{ route('detalhes.produtos', ['id' => $produto->id]) }}" class="btn btn-secondary me-2">Cancelar</a>
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
