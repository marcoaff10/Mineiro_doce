<div class="row mt-3 py-5">
    <div class="row ">
        <h1 class="mb-3 fs-4 d-block">Entradas</h1>
    </div>
    <div class="col-12" style="max-width: 100%; overflow-x: auto">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <th class="text-center align-middle">Produto</th>
                <th class="text-center align-middle">Motivo</th>
                <th class="text-center align-middle">Quantidade</th>
                <th class="text-center align-middle">Preço Unidade</th>
                <th class="text-center align-middle">Fornecedor</th>
                <th class="text-center align-middle">Entrada</th>
                <th class="text-center align-middle">Usuário</th>
            </thead>
            <tbody>
                @foreach ($entradas->items() as $entrada)
                    <tr>
                        <td class=" align-middle">{{ $entrada->produto }}</td>
                        <td class=" align-middle">{{ motivoEntrada($entrada->motivo) }}</td>
                        <td class="text-center align-middle">{{ $entrada->quantidade }}</td>
                        <td class="text-center align-middle {{($entrada->preco_compra == null) ? 'text-center' : '' }}">
                            {{ ($entrada->preco_compra == null) ? '-' : 'R$ ' . preco($entrada->preco_compra) }}
                        </td>
                        <td class=" align-middle {{($entrada->fornecedor == null) ? 'text-center' : '' }}">
                            {{ ($entrada->fornecedor == null) ? '-' : primeiro_nome($entrada->fornecedor) }}
                        </td>
                        <td class="text-center align-middle">
                            {{ date('d/m/Y', strtotime($entrada->created_at)) }}
                        </td>
                        <td class="text-center align-middle">{{ auth()->user()->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <x-pagination :paginator="$entradas" :appends="$filters" />
</div>
<hr class="mb-1">
<hr class="mt-1">
