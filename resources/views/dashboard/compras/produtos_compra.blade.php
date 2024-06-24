@extends('dashboard.dashboard')
@section('title', 'Produtos da Compra')
@section('content')
    <div class="row justify-content-center align-items-center p-3">
        <div class="col-lg-6 p-2">
            <form action="{{ route('store.produtos.compra') }}" method="POST">
                @csrf
                <h1 class="text-center mb-3 fw-bold fs-4">
                    <i class="bi bi-cart-plus me-2 align-middle"></i>
                    {{ $compra->compra }} 
                </h1>
                <div class="row justify-content-center">
                    <input type="hidden" name="compra" value="{{ $compra->id }}" required>
                    <div class="mb-3 row justify-content-between">

                        <div class="col-lg-12 col-sm-12 mb-3">
                            <label for="produto" class="form-label">Produto</label>
                            <select name="produto" id="produto" class="form-select" required>
                                <option value="" selected>Selecione um Produto</option>
                                @foreach ($produtos as $produto)
                                    <option value="{{ $produto->id }}">{{ $produto->produto }}</option>
                                @endforeach
                            </select>
                            @error('produto')
                                <div class=" text-danger alert-danger mt-2">
                                    {{ $errors->get('produto')[0] }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-lg-12 col-sm-12 mb-3">
                            <label for="quantidade" class="form-label">Quantidade</label>
                            <input type="text" name="quantidade" id="quantidade" class="form-control"
                                placeholder="Quantidade..." value="{{ old('quantidade') }}" required>
                            @error('quantidade')
                                <div class=" text-danger alert-danger mt-2">
                                    {{ $errors->get('quantidade')[0] }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-lg-12 col-sm-12 mb-3">
                            <label for="preco_compra" class="form-label">Preço da unidade</label>
                            <input type="text" name="preco_compra" id="preco_compra" class="form-control"
                                placeholder="Preço..." value="{{ old('preco_compra') }}" required>
                            @error('preco_compra')
                                <div class=" text-danger alert-danger mt-2">
                                    {{ $errors->get('preco_compra')[0] }}
                                </div>
                            @enderror
                        </div>

                    </div>

                    @if (session('success'))
                        <div class="text-success alert-success mt-2 text-center">
                            {{ session()->get('success') }}
                        </div>
                    @endif

                    <div class="row justify-content-between mt-3">
                        <div class="col-sm-12 col-md-3 col-lg-3 my-2">
                            <a href="{{ route('destroy.compras', $compra->id) }}" class="btn btnSecondary w-100">Cancelar</a>
                        </div>

                        <div class="col-sm-12 col-md-3 col-lg-3 my-2">
                            <button type="submit" class="btn btnPrimary w-100">Adicionar</button>
                        </div>

                        <div class="col-sm-12 col-md-4 col-lg-4 my-2">
                            @if (count($pedido) > 0)
                            <a href="{{ route('show.compras') }}" class="btn btnSuccess w-100">Fechar Pedido</a>
                        @endif
                        </div>
                    </div>

                    @if (session('error_create'))
                        <div class="text-danger alert-danger mt-2 text-center">
                            {{ session()->get('error_create') }}
                        </div>
                    @endif

                </div>
            </form>
        </div>
    </div>
@endsection
