<div class="row mt-3 py-5">
    <div class="row ">
        <h1 class="mb-3 fs-4 d-block">Vendas Fechadas</h1>
    </div>
    <div class="col-12" style="max-width: 100%; overflow-x: auto">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <th class="text-center align-middle">Venda</th>
                <th class="text-center align-middle">Status</th>
                <th class="text-center align-middle">Saida</th>
                <th class="text-center align-middle">Frete</th>
                <th class="text-center align-middle">Valor Venda</th>
                <th class="text-center align-middle">Data Venda</th>
                <th class="text-center align-middle">Detalhes</th>
            </thead>
            <tbody>
                @foreach ($fechadas->items() as $fechada)
                    <tr>
                        <td class=" align-middle">
                            {{ $fechada->venda }}
                        </td>
                        <td class="text-center align-middle">
                            {{ $fechada->ativa == 0 ? 'Fechada' : '' }}
                        </td>
                        <td class="text-center align-middle">
                            {{ $fechada->saida == 1 ? 'SIM' : '' }}
                        </td>
                        <td class="text-center align-middle">
                            {{ $fechada->frete == null ? '-' : 'R$ ' . preco($fechada->frete) }}
                        </td>
                        <td class="text-center align-middle">
                            {{ 'R$ ' . preco($fechada->valor) }}
                        </td>
                        <td class="text-center align-middle">
                            {{ date('d/m/Y', strtotime($fechada->created_at)) }}
                        </td>
                        <td class="text-center align-middle">
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
