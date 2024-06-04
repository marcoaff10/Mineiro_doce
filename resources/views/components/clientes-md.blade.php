<div class="d-none d-md-block d-lg-none">
    <table class="table table-striped table-bordered " id="datatables">
        <thead class="table-dark">
            <th class="text-center">Cliente</th>
            <th class="text-center">CNPJ</th>
            <th class="text-center">Detalhes</th>
        </thead>
        <tbody>
            @foreach ($clientes->items() as $cliente)
                <tr>
                    <td class=" align-middle"> {{ $cliente->cliente }} </td>
                    <td class="text-center align-middle"> {{ cnpj($cliente->cnpj) }} </td>
                    <td class="text-center align-middle">
                        <a href=" {{ route('detalhes.clientes', $cliente->id) }} " class="text-decoration-none text-success">
                            <i class="bi bi-arrow-right-circle-fill"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <x-pagination :paginator="$clientes" :appends="$filters" />
</div>
