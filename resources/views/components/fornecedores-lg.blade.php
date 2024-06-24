<div class="w-100 col-12 overflowTable">
    <table class="colorTables colorTables table table table-light table-hover table-responsive">
        <thead>
            <th scope="col" class="align-middle">Fornecedor</th>
            <th scope="col" class="align-middle">CNPJ</th>
            <th scope="col" class="align-middle">Telefone</th>
            <th scope="col" class="align-middle">E-mail</th>
            <th scope="col" class="align-middle">Cidade</th>
            <th scope="col" class="align-middle">CEP</th>
            <th scope="col" class="align-middle">
                @if (request()->routeIs('show.fornecedores'))
                    Detalhes
                @elseif (request()->routeIs('fornecedores.inativados'))
                    Reativar
                @endif
            </th>
        </thead>
        <tbody>
            @foreach ($fornecedores->items() as $fornecedor)
                <tr>
                    <td scope="row" class="align-middle"> {{ primeiro_nome($fornecedor->fornecedor) }}
                    </td>
                    <td scope="row"class="align-middle">
                        {{ cnpj($fornecedor->cnpj) }}
                    </td>
                    <td scope="row" class="align-middle">
                        {{ $fornecedor->telefone == null ? '-' : telefone($fornecedor->telefone) }}
                    </td>
                    <td scope="row" class="align-middle">
                        {{ $fornecedor->email == null ? '-' : $fornecedor->email }}
                    </td>
                    <td scope="row" class="align-middle"> {{ $fornecedor->cidade }} </td>
                    <td scope="row" class="align-middle"> {{ cep($fornecedor->cep) }} </td>
                    @if (request()->routeIs('show.fornecedores'))
                        <td scope="row" class="align-middle">
                            <a href=" {{ route('detalhes.fornecedores', ['id' => $fornecedor->id]) }} "
                                class="text-decoration-none text-secondary">
                                <i class="bi bi-arrow-right-circle-fill"></i>
                            </a>
                        </td>
                    @elseif (request()->routeIs('fornecedores.inativados'))
                        <td scope="row" class="align-middle">
                            <a href="{{ route('reativar.fornecedor', $fornecedor->id) }}"
                                class="text-decoration-none text-success ">
                                <i class="bi bi-check-circle"></i>
                            </a>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<x-pagination :paginator="$fornecedores" :appends="$filters" />
