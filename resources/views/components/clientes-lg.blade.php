<div class="w-100 col-12 overflowTable">
    <table class="colorTbales colorTbales table table table-hover table-responsive" id="datatables">
        <thead>
            <th scope="col" class="align-middle">Cliente</th>
            <th scope="col" class="align-middle">CNPJ</th>
            <th scope="col" class="align-middle">Telefone</th>
            <th scope="col" class="align-middle">E-mail</th>
            <th scope="col" class="align-middle">Cidade</th>
            <th scope="col" class="align-middle">CEP</th>
            <th scope="col" class="align-middle">Detalhes</th>
        </thead>
        <tbody>
            @foreach ($clientes->items() as $cliente)
                <tr>
                    <td scope="row" class="w-25 align-middle"> {{ primeiro_nome($cliente->cliente) }} </td>
                    <td scope="row" class="align-middle"> {{ cnpj($cliente->cnpj) }} </td>
                    <td scope="row" class="align-middle"> {{ ($cliente->telefone == null) ? '-' : telefone($cliente->telefone) }} </td>
                    <td scope="row" class="align-middle"> {{ ($cliente->email == null) ? '-' : $cliente->email }} </td>
                    <td scope="row" class="align-middle"> {{ $cliente->cidade }} </td>
                    <td scope="row" class="align-middle"> {{ cep($cliente->cep) }} </td>
                    <td scope="row" class="align-middle">
                        <a href=" {{ route('detalhes.clientes', $cliente->id) }} " class="text-decoration-none text-secondary">
                            <i class="bi bi-arrow-right-circle-fill"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <x-pagination :paginator="$clientes" :appends="$filters" />
</div>
