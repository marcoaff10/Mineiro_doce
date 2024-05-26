@extends('dashboard.dashboard')
@section('content')
    <div class="row">
        <div class="col-12">
            <h1 class="mb-3 fs-4">Produtos <i class="bi bi-box ms-1"></i></h1>
            @if (count($produtos) > 0)
                <table class="table table-striped table-bordered" id="datatables">
                    <thead class="table-dark">
                        <th class="text-center">Produto</th>
                        <th class="text-center">Categoria</th>
                        <th class="text-center">Peso</th>
                        <th class="text-center">Estoque</th>
                    </thead>
                    <tbody>
                        @foreach ($produtos as $produto)
                            <tr>
                                <td>{{ $produto['produto'] }}</td>
                                <td> {{ $produto['categoria'] }} </td>
                                <td class="text-center">
                                    {{ $produto['peso'] >= 1000 ? $produto['peso'] / 1000 . 'kg' : $produto['peso'] . 'g' }}
                                </td>
                                <td class="text-center">
                                    <a href="" class="text-decoration-none text-success">
                                        <i class="bi bi-arrow-right-circle-fill"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class=" text-center opacity-50">Sem produtos cadastrados.</p>
            @endif
        </div>
    </div>
@endsection
