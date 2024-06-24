<div class="row mt-3 py-5">
    <div class="row ">
        <h1 class="mb-3 fs-4 d-block">Vendas Ativas</h1>
    </div>
    <div class="w-100 col-12 overflowTable">
        <table class="colorTables colorTables table table table-hover table-responsive ">
            <thead>
                <th scope="col" class="align-middle">Venda</th>
                <th scope="col" class="align-middle">Status</th>
                <th scope="col" class="align-middle">Saida</th>
                <th scope="col" class="align-middle">Frete</th>
                <th scope="col" class="align-middle">Valor Venda</th>
                <th scope="col" class="align-middle">Data Venda</th>
                <th scope="col" class="align-middle">Detalhes</th>

            </thead>
            <tbody>
                @foreach ($ativas->items() as $ativa)
                    <tr>
                        <td scope="row" class=" align-middle">
                            {{ $ativa->venda }}
                        </td>
                        <td scope="row" class="align-middle">
                            {{ $ativa->ativa == 1 ? 'Ativa' : '' }}
                        </td>
                        <td scope="row" class="align-middle">
                            {{ $ativa->saida == 0 ? 'NÃO' : '' }}
                        </td>
                        <td scope="row" class="align-middle">
                            {{ $ativa->frete == null ? '-' : 'R$ ' . preco($ativa->frete) }}
                        </td>
                        <td scope="row" class="align-middle">
                            {{ 'R$ ' . preco($ativa->valor) }}
                        </td>
                        <td scope="row" class="align-middle">
                            {{ date('d/m/Y', strtotime($ativa->created_at)) }}
                        </td>
                        <td scope="row" class="align-middle">
                            <a href=" {{ route('detalhes.compra', $ativa->id) }} "
                                class="text-decoration-none text-success">
                                <i class="bi bi-arrow-right-circle-fill"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <x-pagination :paginator="$ativas" :appends="$filters" />
</div>
<hr class="mb-1">
<hr class="mt-1">
