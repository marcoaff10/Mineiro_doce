<div class="row mt-5">
    <div class="row ">
        <h1 class="mb-3 fs-4 d-block">Saidas</h1>
    </div>
    <div class="col-12" style="max-width: 100%; overflow-x: auto">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <th class="text-center align-middle">Produto</th>
                <th class="text-center align-middle">Motivo</th>
                <th class="text-center align-middle">Quantidade</th>
                <th class="text-center align-middle">Preço Unidade</th>
                <th class="text-center align-middle">Cliente</th>
                <th class="text-center align-middle">Saida</th>
                <th class="text-center align-middle">Usuário</th>
            </thead>
            <tbody>
                @foreach ($saidas->items() as $saida)
                    <tr>
                        <td class=" align-middle"> {{ $saida->produto }} </td>
                        <td class=" align-middle"> {{ motivoSaida($saida->motivo) }} </td>
                        <td class="text-center align-middle"> {{ $saida->quantidade }} </td>
                        <td class="text-center align-middle {{ $saida->preco_venda == null ? 'text-center' : '' }}">
                            {{ $saida->preco_venda == null ? '-' : 'R$' . preco($saida->preco_venda) }}
                        </td>
                        <td class=" align-middle {{ $saida->cliente == null ? 'text-center' : '' }}">
                            {{ $saida->cliente == null ? '-' : primeiro_nome($saida->cliente) }}
                        </td>
                        <td class="text-center align-middle"> {{ date('d/m/Y', strtotime($saida->created_at)) }} </td>
                        <td class="text-center align-middle"> {{ auth()->user()->name }} </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <x-pagination :paginator="$saidas" :appends="$filters" />
</div>
