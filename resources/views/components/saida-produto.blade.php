<div class="row mt-5">
    <div class="row ">
        <h1 class="mb-3 fs-4 d-block">Saidas</h1>
    </div>
    <div class="w-100 col-12 overflowTable">
        <table class="colorTables colorTables table table table-hover table-responsive">
            <thead>
                <th scope="col" class="align-middle">Produto</th>
                <th scope="col" class="align-middle">Motivo</th>
                <th scope="col" class="align-middle">Quantidade</th>
                <th scope="col" class="align-middle">Preço Unidade</th>
                <th scope="col" class="align-middle">Cliente</th>
                <th scope="col" class="align-middle">Saida</th>
                <th scope="col" class="align-middle">Usuário</th>
            </thead>
            <tbody>
                @foreach ($saidas->items() as $saida)
                    <tr>
                        <td scope="row" class=" align-middle"> {{ $saida->produto }} </td>
                        <td scope="row" class=" align-middle"> {{ motivoSaida($saida->motivo) }} </td>
                        <td scope="row" class="align-middle"> {{ $saida->quantidade }} </td>
                        <td scope="row" class="align-middle {{ $saida->preco_venda == null ? 'text-center' : '' }}">
                            {{ $saida->preco_venda == null ? '-' : 'R$' . preco($saida->preco_venda) }}
                        </td>
                        <td scope="row" class=" align-middle {{ $saida->cliente == null ? 'text-center' : '' }}">
                            {{ $saida->cliente == null ? '-' : primeiro_nome($saida->cliente) }}
                        </td>
                        <td scope="row" class="align-middle"> {{ date('d/m/Y', strtotime($saida->created_at)) }} </td>
                        <td scope="row" class="align-middle"> {{ auth()->user()->name }} </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <x-pagination :paginator="$saidas" :appends="$filters" />
</div>
