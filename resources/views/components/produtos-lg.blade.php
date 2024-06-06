<div class="d-none d-lg-block d-xl-block d-xxl-block w-100 col-12">
    <table class="table table-striped table-bordered " id="datatables">
        <thead class="table-dark">
            <th class="text-center">Produto</th>
            <th class="text-center">Categoria</th>
            <th class="text-center">Peso</th>
            <th class="text-center">QTDE. Min</th>
            <th class="text-center">Estoque</th>
            <th class="text-center">Movimentações</th>
        </thead>
        <tbody>
            @foreach ($produtos->items() as $produto)
                <tr>
                    <td class="w-25 align-middle"> {{ $produto->produto }} </td>
                    <td class="align-middle"> {{ $produto->categoria }} </td>
                    <td class="text-center align-middle ">
                        {{ $produto->peso >= 1000 ? $produto->peso / 1000 . 'kg' : $produto->peso . 'g' }}
                    </td>
                    <td class="text-center align-middle">
                        {{ $produto->minimo }} uni.
                    </td>
                    <td class="text-center align-middle fw-bold {{ min_estoque($produto->minimo, $produto->estoque) }}">
                        {{ $produto->estoque }}</td>
                    <td class="text-center align-middle">
                        <a href=" {{ route('detalhes.produtos', ['id' => $produto->id]) }} "
                            class="text-decoration-none text-success {{ movimentacao($produto->id) }}">
                            <i class="bi bi-arrow-right-circle-fill"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <x-pagination :paginator="$produtos" :appends="$filters" />
</div>
