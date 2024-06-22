<form action="{{ route('entrar.compra') }}" method="POST">
    @csrf
    <div class="mb-3" id="compra">
        <label class="form-label">Compras</label>
        <select name="compra" id="compraEntrada" class="form-select">
            <option value="">Selecione uma Compra</option>
            @foreach ($entradas as $entrada)
                <option value="{{ $entrada->id }}" data-compra="{{ $entrada->id }}">
                    {{ $entrada->compra }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3 d-none" id="itensCompra">
        <h1 class="mb-3">Itens da Compra</h1>
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <th class="text-center align-middle">Produto</th>
                <th class="text-center align-middle">Quantidade</th>
            </thead>
            <tbody id="table">

            </tbody>
        </table>
    </div>

    <div class="mb-3">
        <button type="submit" class="btn btn-success" @if (count($entradas) < 1) disabled @endif>
            Entrar
        </button>
    </div>
</form>
