<div class="w-100 col-12 my-3" style="max-width: 100%; overflow-x: auto">
    <table class="table table-striped table-bordered " id="datatables">
        <thead class="table-dark">
            <th class="text-center align-middle">Venda</th>
            <th class="text-center align-middle">Cliente</th>
            <th class="text-center align-middle">Ativa</th>
            <th class="text-center align-middle">Fechada</th>
            <th class="text-center align-middle">Produtos</th>
            <th class="text-center align-middle">Valor</th>
            <th class="text-center align-middle">Detalhes</th>
        </thead>
        <tbody>
            @foreach ($vendas->items() as $venda)
                <tr>
                    <td class="w-25 align-middle"> {{ $venda->venda }} </td>
                    <td class="align-middle"> {{ primeiro_nome($venda->cliente) }} </td>
                    <td class="text-center align-middle "> {{ $venda->ativa == 1 ? 'SIM' : 'NÃO' }} </td>
                    <td class="text-center align-middle"> {{ $venda->saida == 1 ? 'SIM' : 'NÃO' }} </td>
                    <td class="text-center align-middle"> {{ $venda->produtos }} </td>
                    <td class="text-center align-middle"> R$ {{ preco($venda->valor) }} </td>
                    <td class="text-center align-middle">
                        <a href=" {{ route('detalhes.venda', $venda->id)}} "
                            class="text-decoration-none text-success ">
                            <i class="bi bi-arrow-right-circle-fill"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<x-pagination :paginator="$vendas" :appends="$filters" />
