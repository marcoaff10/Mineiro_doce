<div class="w-100 col-12 overflowTable">
    <table class="colorTables table-striped table table table-hover table-responsive">
        <thead>
            <th scope="col" class="align-middle">Venda</th>
            <th scope="col" class="align-middle">Cliente</th>
            <th scope="col" class="align-middle">Status</th>
            <th scope="col" class="align-middle">Estoque</th>
            <th scope="col" class="align-middle">Produtos</th>
            <th scope="col" class="align-middle">Valor</th>
            <th scope="col" class="align-middle">Detalhes</th>
        </thead>
        <tbody>
            @foreach ($vendas->items() as $venda)
                <tr>
                    <td scope="row" class="w-25 align-middle"> {{ $venda->venda }} </td>
                    <td scope="row" class="align-middle"> {{ primeiro_nome($venda->cliente) }} </td>
                    <td scope="row" class="align-middle "> {{ $venda->ativa == 1 ? 'Ativa' : 'Fechada' }} </td>
                    <td scope="row" class="align-middle"> {{ $venda->saida == 1 ? 'Saiu' : 'Não Saiu' }} </td>
                    <td scope="row" class="align-middle"> {{ $venda->produtos }} </td>
                    <td scope="row" class="align-middle"> R$ {{ preco($venda->valor) }} </td>
                    <td scope="row" class="align-middle">
                        <a href=" {{ route('detalhes.venda', $venda->id)}} "
                            class="text-decoration-none text-secondary ">
                            <i class="bi bi-arrow-right-circle-fill"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<x-pagination :paginator="$vendas" :appends="$filters" />
