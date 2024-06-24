<div class="row mt-3 py-5">
    <div class="row ">
        <h1 class="mb-3 fs-4 d-block">Entradas</h1>
    </div>
    <div class="w-100 col-12 overflowTable">
        <table class="colorTables colorTables table table table-hover table-responsive ">
            <thead>
                <th scope="col" class="align-middle">Produto</th>
                <th scope="col" class="align-middle">Motivo</th>
                <th scope="col" class="align-middle">Quantidade</th>
                <th scope="col" class="align-middle">Preço Unidade</th>
                <th scope="col" class="align-middle">Fornecedor</th>
                <th scope="col" class="align-middle">Entrada</th>
                <th scope="col" class="align-middle">Usuário</th>
            </thead>
            <tbody>
                @foreach ($entradas->items() as $entrada)
                    <tr>
                        <td scope="row" class=" align-middle">{{ $entrada->produto }}</td>
                        <td scope="row" class=" align-middle">{{ motivoEntrada($entrada->motivo) }}</td>
                        <td scope="row" class="align-middle">{{ $entrada->quantidade }}</td>
                        <td scope="row" class="align-middle {{($entrada->preco_compra == null) ? 'text-center' : '' }}">
                            {{ ($entrada->preco_compra == null) ? '-' : 'R$ ' . preco($entrada->preco_compra) }}
                        </td>
                        <td scope="row" class=" align-middle {{($entrada->fornecedor == null) ? 'text-center' : '' }}">
                            {{ ($entrada->fornecedor == null) ? '-' : primeiro_nome($entrada->fornecedor) }}
                        </td>
                        <td scope="row" class="align-middle">
                            {{ date('d/m/Y', strtotime($entrada->created_at)) }}
                        </td>
                        <td scope="row" class="align-middle">{{ auth()->user()->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <x-pagination :paginator="$entradas" :appends="$filters" />
</div>
<hr class="mb-1">
<hr class="mt-1">
