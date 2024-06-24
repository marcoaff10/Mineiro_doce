<form action="{{ route('sair.venda') }}" method="POST">
    @csrf
   
    <div class="mb-3" id="compra">
        <label class="form-label">Vendas</label>
        <select name="venda" id="vendaSaida" class="form-select">
            <option value="">Selecione uma Venda</option>
            @foreach ($saidas as $saida)
                <option value="{{ $saida->id }}" data-venda="{{ $saida->id }}">
                    {{ $saida->venda }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3 d-none" id="itensVenda">
        <h1 class="mb-3">Itens da Venda</h1>
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <th class="text-center align-middle">Produto</th>
                <th class="text-center align-middle">Quantidade</th>
            </thead>
            <tbody id="tableVenda">

            </tbody>
        </table>
    </div>

    <div class="mb-3">
        <button type="submit" class="btn btnDanger" @if (count($saidas) < 1) disabled @endif>
            Baixar
        </button>
    </div>
</form>