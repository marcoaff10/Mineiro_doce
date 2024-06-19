<div class="w-100 col-12 overflowTable">
    <table class="colorTbales colorTbales table table table-hover table-responsive ">
        <thead>
            <th scope="col" class="align-middle">Produto</th>
            <th scope="col" class="align-middle">Categoria</th>
            <th scope="col" class="align-middle">Peso</th>
            <th scope="col" class="align-middle">Min.</th>
            <th scope="col" class="align-middle">Max.</th>
            <th scope="col" class="align-middle">Estoque</th>
            <th scope="col" class="align-middle">
                @if (request()->routeIs('estoque.produtos'))
                    Mov.
                @elseif (request()->routeIs('produto.inativado'))
                    Reativar
                @endif
            </th>
        </thead>
        <tbody>
            @foreach ($produtos->items() as $produto)
                <tr>
                    <td scope="row" class="w-25 align-middle"> {{ $produto->produto }} </td>
                    <td scope="row" class="align-middle"> {{ $produto->categoria }} </td>
                    <td scope="row" class="align-middle ">
                        {{ $produto->peso >= 1000 ? $produto->peso / 1000 . 'kg' : $produto->peso . 'g' }}
                    </td>
                    <td scope="row" class="align-middle">
                        {{ $produto->minimo }}
                    </td>
                    <td scope="row" class="align-middle">
                        {{ $produto->maximo }}
                    </td>
                    <td scope="row" class="align-middle fw-bold ">
                        {{ empty($produto->estoque) ? 0 : $produto->estoque }}
                    </td>
                    @if (request()->routeIs('estoque.produtos'))
                        <td scope="row" class="align-middle">
                            <a href=" {{ route('movimentacao.produtos', ['id' => $produto->id]) }} "
                                class="text-decoration-none text-secondary">
                                <i class="bi bi-arrow-right-circle-fill"></i>
                            </a>
                        </td>
                    @elseif (request()->routeIs('produto.inativado'))
                        <td scope="row" class="align-middle">
                            <a href="{{ route('reativar.produto', $produto->id) }}"
                                class="text-decoration-none text-success ">
                                <i class="bi bi-check-circle"></i>
                            </a>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
    <x-pagination :paginator="$produtos" :appends="$filters" />
</div>
