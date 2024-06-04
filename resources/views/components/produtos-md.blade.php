<div class="d-none d-md-block d-lg-none">
    <table class="table table-striped table-bordered " id="datatables">
        <thead class="table-dark">
            <th class="text-center">Produto</th>
            <th class="text-center">Categoria</th>
            <th class="text-center">QTDE. Min</th>
            <th class="text-center">Estoque</th>
            <th class="text-center">Detalhes</th>
        </thead>
        <tbody>
            @foreach ($produtos->items() as $produto)
                <tr>
                    <td class=" align-middle"> {{ $produto->produto }} </td>
                    <td class=" align-middle"> {{ $produto->categoria }} </td>
                    <td class="text-center align-middle"> {{ $produto->minimo }} uni. </td>
                    <td
                        class="text-center align-middle fw-bold {{ min_estoque($produto->minimo, $produto->quantidade) }}">
                        {{ $produto->quantidade > 0 ? $produto->quantidade : '0' }}</td>
                    <td class="text-center align-middle">
                        <a href=" {{ route('detalhes.produtos', ['id' => $produto->id]) }} "
                            class="text-decoration-none text-success">
                            <i class="bi bi-arrow-right-circle-fill"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <x-pagination :paginator="$produtos" :appends="$filters" />
</div>