<div class="w-100 col-12" style="max-width: 100%; overflow-x: auto">
    <table class="table table-striped table-bordered " id="datatables">
        <thead class="table-dark">
            <th class="text-center align-middle">Compra</th>
            <th class="text-center align-middle">Fornecedor</th>
            <th class="text-center align-middle">Ativa</th>
            <th class="text-center align-middle">Fechada</th>
            <th class="text-center align-middle">Produtos</th>
            <th class="text-center align-middle">Valor</th>
            <th class="text-center align-middle">Detalhes</th>
        </thead>
        <tbody>
            @foreach ($compras->items() as $compra)
                <tr>
                    <td class="w-25 align-middle"> {{ $compra->compra }} </td>
                    <td class="align-middle"> {{ primeiro_nome($compra->fornecedor) }} </td>
                    <td class="text-center align-middle "> {{ $compra->ativa == 1 ? 'SIM' : 'NÃO' }} </td>
                    <td class="text-center align-middle"> {{ $compra->entrada == 1 ? 'SIM' : 'NÃO' }} </td>
                    <td class="text-center align-middle"> {{ $compra->produtos }} </td>
                    <td class="text-center align-middle"> R$ {{ preco($compra->valor) }} </td>
                    <td class="text-center align-middle">
                        <a href=" {{ route('detalhes.compra', $compra->id) }} "
                            class="text-decoration-none text-success ">
                            <i class="bi bi-arrow-right-circle-fill"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <x-pagination :paginator="$compras" :appends="$filters" />
</div>
