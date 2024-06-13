<div class="row mt-3 py-5">
    <div class="row ">
        <h1 class="mb-3 fs-4 d-block">Compras Ativas</h1>
    </div>
    <div class="col-12" style="max-width: 100%; overflow-x: auto">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <th class="text-center align-middle">Compra</th>
                <th class="text-center align-middle">Status</th>
                <th class="text-center align-middle">Entrada</th>
                <th class="text-center align-middle">Frete</th>
                <th class="text-center align-middle">Valor Compra</th>
                <th class="text-center align-middle">Data Compra</th>
                <th class="text-center align-middle">Detalhes</th>

            </thead>
            <tbody>
                @foreach ($ativas->items() as $ativa)
                    <tr>
                        <td class=" align-middle">
                            {{ $ativa->compra }}
                        </td>
                        <td class="text-center align-middle">
                            {{ $ativa->ativa == 1 ? 'Ativa' : '' }}
                        </td>
                        <td class="text-center align-middle">
                            {{ $ativa->entrada == 0 ? 'NÃO' : '' }}
                        </td>
                        <td class="text-center align-middle">
                            {{ $ativa->frete == null ? '-' : 'R$ ' . preco($ativa->frete) }}
                        </td>
                        <td class="text-center align-middle">
                            {{ 'R$ ' . preco($ativa->valor) }}
                        </td>
                        <td class="text-center align-middle">
                            {{ date('d/m/Y', strtotime($ativa->created_at)) }}
                        </td>
                        <td class="text-center align-middle">
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
