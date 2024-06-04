<div class="d-lg-none d-md-none d-xl-none d-xxl-none d-block">
    <table class="table table-striped table-bordered" id="datatables">
        <thead class="table-dark">
            <th class="text-center">Cliente</th>
            <th class="text-center">Detalhes</th>
        </thead>
        <tbody>
            @foreach ($clientes->items() as $cliente)
                <tr>
                    <td class="w-75 align-middle"> {{$cliente->cliente}} </td>
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
