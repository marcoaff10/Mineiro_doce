<div class="row mt-3 py-5">
    <div class="row ">
        <h1 class="mb-3 fs-4 d-block">Vendas Fechadas</h1>
    </div>
    <div class="w-100 col-12 overflowTable">
        <table class="colorTables colorTables table table table-hover table-responsive">
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
                @foreach ($fechadas->items() as $fechada)
                    <tr>
                        <td scope="row" class=" align-middle">
                            {{ $fechada->venda }}
                        </td>
                        <td scope="row" class="align-middle">
                            {{ $fechada->ativa == 0 ? 'Fechada' : '' }}
                        </td>
                        <td scope="row" class="align-middle">
                            {{ $fechada->saida == 1 ? 'SIM' : '' }}
                        </td>
                        <td scope="row" class="align-middle">
                            {{ $fechada->frete == null ? '-' : 'R$ ' . preco($fechada->frete) }}
                        </td>
                        <td scope="row" class="align-middle">
                            {{ 'R$ ' . preco($fechada->valor) }}
                        </td>
                        <td scope="row" class="align-middle">
                            {{ date('d/m/Y', strtotime($fechada->created_at)) }}
                        </td>
                        <td scope="row" class="align-middle">
                            <a href=" {{ route('detalhes.venda', $fechada->id) }} "
                                class="text-decoration-none text-success">
                                <i class="bi bi-arrow-right-circle-fill"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <x-pagination :paginator="$fechadas" :appends="$filters" />
</div>
