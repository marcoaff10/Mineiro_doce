<form action="{{ route('entrada.produtos') }}" method="POST">
    @csrf
    <input type="hidden" name="motivo" value="" id="motivo">
    <div class="mb-3">
        <label class="form-label">Produtos</label>
        <select name="produto" id="produto" class="form-select">
            <option value="">Selecione um produto</option>
            @foreach ($produtos->items() as $produto)
                <option value="{{ $produto->id }}" >
                    {{ $produto->produto }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Quantidade</label>
        <input type="text" name="quantidade" id="quantidade" class="form-control" placeholder="Quantidade">
    </div>

    <div class="mb-3">
        <button type="submit" class="btn btn-success">
            Entrar
        </button>
    </div>

</form>
