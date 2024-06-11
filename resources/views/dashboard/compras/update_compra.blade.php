@extends('dashboard.dashboard')
@section('title', 'Editar Compra')
@section('content')
    <div class="row justify-content-center align-items-center p-3">
        <div class="col-lg-6 p-2">
            <form action="{{ route('update.submit.compra') }}" method="POST">
                @method('PUT')
                @csrf
                <h3 class="text-center mb-3 fw-bold fs-4">Editar Compra <i class="bi bi-cart-plus ms-1 align-middle"></i></h3>
                <div class="row justify-content-center">
                    <input type="hidden" name="compra" value="{{ $compra[0]->id }}">
                    <div class="mb-3 row justify-content-between">

                        <div class="col-lg-12 col-sm-12 mb-3">
                            <label for="produto" class="form-label">Qual produto deseja alterar ?</label>
                            <select name="produto" id="produtoCompra" class="form-select" required>
                                <option value="" selected>Selecione um Produto</option>
                                @foreach ($compra as $item)
                                    <option value="{{ $item->produto_id }}" data-produto="{{ $item->produto_id }}">
                                        {{ $item->produto }}</option>
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
                            <input type="text" name="quantidade" id="quantidadeCompra" class="form-control "
                                placeholder="Quantidade..." value="{{ old('quantidade') }}" required>
                            @error('quantidade')
                                <div class=" text-danger alert-danger mt-2">
                                    {{ $errors->get('quantidade')[0] }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-lg-12 col-sm-12 mb-3">
                            <label for="preco_compra" class="form-label">Preço da unidade</label>
                            <input type="text" name="preco_compra" id="precoCompra" class="form-control "
                                placeholder="Mín..." value="{{ old('preco_compra') }}" required>
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

                    <div class="mt-3 text-center ">
                        <a href="{{ route('detalhes.compra', $compra[0]->id) }}"
                            class="btn btn-secondary mx-2">Cancelar</a>
                        <button type="submit" class="btn btn-primary mx-2">Editar</button>
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
    <x-script-compra />
@endsection
