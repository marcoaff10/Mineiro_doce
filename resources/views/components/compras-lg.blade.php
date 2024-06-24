<div class="w-100 col-12 overflowTable">
    <table class="colorTables colorTables table table table-hover table-responsive">
        <thead >
            <th scope="col" class="align-middle">Compra</th>
            <th scope="col" class="align-middle">Fornecedor</th>
            <th scope="col" class="align-middle">Status</th>
            <th scope="col" class="align-middle">Estoque</th>
            <th scope="col" class="align-middle">Produtos</th>
            <th scope="col" class="align-middle">Valor</th>
            <th scope="col" class="align-middle">Detalhes</th>
        </thead>
        <tbody>
            @foreach ($compras->items() as $compra)
                <tr>
                    <td scope="row" class="w-25 align-middle"> {{ $compra->compra }} </td>
                    <td scope="row" class="align-middle"> {{ primeiro_nome($compra->fornecedor) }} </td>
                    <td scope="row" class="align-middle "> {{ $compra->ativa == 1 ? 'Ativa' : 'Fechada' }} </td>
                    <td scope="row" class="align-middle"> {{ $compra->entrada == 1 ? 'Entrou' : 'Não Entrou' }} </td>
                    <td scope="row" class="align-middle"> {{ $compra->produtos }} </td>
                    <td scope="row" class="align-middle"> R$ {{ preco($compra->valor) }} </td>
                    <td scope="row" class="align-middle">
                        <a href=" {{ route('detalhes.compra', $compra->id) }} "
                            class="text-decoration-none text-secondary ">
                            <i class="bi bi-arrow-right-circle-fill"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <x-pagination :paginator="$compras" :appends="$filters" />
</div>
