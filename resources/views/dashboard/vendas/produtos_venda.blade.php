@extends('dashboard.dashboard')
@section('title', 'Produtos da Venda')
@section('content')
    <div class="row justify-content-center align-items-center p-3">
        <div class="col-lg-6 p-2">
            <form action="{{ route('store.produtos.venda') }}" method="POST">
                @csrf
                <h3 class="text-center mb-3 fw-bold fs-4">{{ $venda->venda }} <i
                        class="bi bi-cart-plus ms-1 align-middle"></i></h3>
                <div class="row justify-content-center">
                    <input type="hidden" name="venda" value="{{ $venda->id }}">
                    <div class="mb-3 row justify-content-between">

                        <div class="col-lg-12 col-sm-12 mb-3">
                            <label for="produto" class="form-label">Produto em estoque</label>
                            <select name="produto" id="produto" class="form-select">
                                <option value="" selected>Selecione um Produto</option>
                                @foreach ($produtos as $produto)
                                    <option value="{{ $produto->id }}" data-disponivel="{{ $produto->id }}">
                                        {{ $produto->produto }}
                                    </option>
                                @endforeach
                            </select>
                            @error('produto')
                                <div class="text-center text-danger alert-danger mt-2">
                                    {{ $errors->get('produto')[0] }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <span id="estoqueDisponivel"></span>
                            <input type="hidden" id="estoque">
                        </div>

                        
                        <div class="col-lg-12 col-sm-12 mb-3">
                            <label for="quantidade" class="form-label">Quantidade</label>
                            <input type="text" name="quantidade" id="quantidadeVenda" class="form-control"
                                placeholder="Quantidade..." value="{{ old('quantidade') }}">
                                <div class="d-none text-center text-danger alert-danger mt-2" id="error">
                                    Estoque insuficiente.
                                </div>
                            @error('quantidade')
                                <div class="text-center text-danger alert-danger mt-2">
                                    {{ $errors->get('quantidade')[0] }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-lg-12 col-sm-12 mb-3">
                            <label for="preco_venda" class="form-label">Preço da unidade</label>
                            <input type="text" name="preco_venda" id="preco_venda" class="form-control"
                                placeholder="Preço..." value="{{ old('preco_venda') }}">
                            @error('preco_venda')
                                <div class="text-center text-danger alert-danger mt-2">
                                    {{ $errors->get('preco_venda')[0] }}
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
                            <a href="{{ route('destroy.vendas', $venda->id) }}"
                                class="btn btn-secondary w-100">Cancelar</a>
                        </div>

                        <div class="col-sm-12 col-md-3 col-lg-3 my-2">
                            <button type="submit" class="btn btn-primary w-100" id="adicionar">Adicionar</button>
                        </div>

                        <div class="col-sm-12 col-md-4 col-lg-4 my-2">
                            @if (count($pedido) > 0)
                                <a href="{{ route('show.vendas') }}" class="btn btn-success w-100">Fechar Pedido</a>
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

    <x-script-venda />
@endsection
