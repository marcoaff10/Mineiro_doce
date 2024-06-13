<form action="{{ route('saida.produtos') }}" method="POST">
    @csrf
    <input type="hidden" name="motivo" id="inputMotivo">
    <div class="mb-3 row justify-content-between align-items-center">
        <div class="col-12 mb-3">
            <label class="form-label">Produto</label>
            <select name="produto" id="produtoSaida" class="form-select" required>
                <option value="">Selecione um Produto</option>
                @foreach ($produtos->items() as $produto)
                    <option value="{{ $produto->id }}" data-estoque="{{ $produto->id }}">
                        {{ $produto->produto }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-12 mb-3">
            <label class="form-label d-block">Estoque Disponível:</label>
            <span id="estoque"></span>
            <input type="hidden" id="estoqueHidden">
        </div>
    </div>

    <div class="d-flex justify-content-between mb-4">
        <div class="col-12" id="divQuantidade">
            <label class="form-label">Quantidade</label>
            <input type="number" name="quantidade" id="quantidadeSaida" class="form-control" required>
            <div class="text-danger text-center alert-danger mt-2 d-none" id="error">
                Estoque insuficiente.
            </div>
        </div>
    </div>

    <div class="mb-3">
        <button type="submit" class="btn btn-secondary" id="baixar">
            Baixar
        </button>
    </div>

</form>
