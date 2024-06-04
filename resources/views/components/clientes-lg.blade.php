<div class="d-none d-lg-block d-xl-block d-xxl-block w-100 col-12">
    <table class="table table-striped table-bordered " id="datatables">
        <thead class="table-dark">
            <th class="text-center">Cliente</th>
            <th class="text-center">CNPJ</th>
            <th class="text-center">Telefone</th>
            <th class="text-center">E-mail</th>
            <th class="text-center">Cidade</th>
            <th class="text-center">CEP</th>
            <th class="text-center">Detalhes</th>
        </thead>
        <tbody>
            @foreach ($clientes->items() as $cliente)
                <tr>
                    <td class="w-25 align-middle"> {{ $cliente->cliente }} </td>
                    <td class="text-center align-middle"> {{ cnpj($cliente->cnpj) }} </td>
                    <td class="text-center align-middle"> {{ telefone($cliente->telefone) }} </td>
                    <td class=" align-middle"> {{ $cliente->email }} </td>
                    <td class=" align-middle"> {{ $cliente->cidade . ', ' . uf($cliente->uf) }} </td>
                    <td class="text-center align-middle"> {{ cep($cliente->cep) }} </td>
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
