@extends('dashboard.dashboard')
@section('title', 'Produtos')
@section('content')
    <div class="row align-items-center justify-content-center">
        <div class="col">

            <div class="row">
                <div class="col">
                    <h1 class="mb-3 fs-4 d-block">Produtos <i class="bi bi-box ms-1 align-middle"></i></h1>
                </div>
            </div>

            <div class="row justify-content-between">
                <div class="col-sm-12 col-lg-4 mb-3">
                    <a href=" {{ route('create.produtos') }} " class="btn btn-primary"><i
                            class="bi bi-plus-circle-dotted"></i></a>
                </div>

                <div class="col-sm-12 col-lg-6">
                    <form action="" method="GET">

                        <div class="mb-3 d-flex">
                            <input type="text" name="filter" id="filter" class="form-control me-3 h-25 rounded-pill"
                                placeholder="Pesquisar" value="{{ $filters['filter'] ?? '' }}">
                            <button type="submit" class="me-3 align-middle fs-5 fw-bold">
                                <strong><i class="bi bi-search"></i></strong>
                            </button>
                            @if ($filters['filter'] != '')
                                <a href="{{ route('show.produtos') }}"
                                    class="fw-bold text-danger ms-3 fs-5 align-middle">
                                    <strong><i class="bi bi-x-lg align-middle"></i></strong>
                                </a>
                            @endif
                        </div>
                    </form>
                </div>


            </div>

            @if (count($produtos->items()) > 0)
                <div class="d-none d-lg-block d-xl-block d-xxl-block w-100 col-12">
                    <table class="table table-striped table-bordered " id="datatables">
                        <thead class="table-dark">
                            <th class="text-center">Produto</th>
                            <th class="text-center">Categoria</th>
                            <th class="text-center">Fornecedor</th>
                            <th class="text-center">Peso</th>
                            <th class="text-center">QTDE. Min</th>
                            <th class="text-center">Estoque</th>
                            <th class="text-center">Detalhes</th>
                        </thead>
                        <tbody>
                            @foreach ($produtos->items() as $produto)
                                <tr>
                                    <td class="w-25 align-middle"> {{ $produto->produto }} </td>
                                    <td class="text-center align-middle"> {{ $produto->categoria }} </td>
                                    <td class="align-middle"> {{ $produto->fornecedor }} </td>
                                    <td class="text-center align-middle"> {{ $produto->peso }} </td>
                                    <td class="text-center align-middle"> {{ $produto->minimo }} </td>
                                    <td class="text-center align-middle">  </td>
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

                <!--===============================================MD===================================================================================== -->
                <div class="d-none d-md-block d-lg-none">
                    <table class="table table-striped table-bordered " id="datatables">
                        <thead class="table-dark">
                            <th class="text-center">Produto</th>
                            <th class="text-center">Categoria</th>
                            <th class="text-center">Fornecedor</th>
                            <th class="text-center">QTDE. Min</th>
                            <th class="text-center">Estoque</th>
                            <th class="text-center">Detalhes</th>
                        </thead>
                        <tbody>
                            @foreach ($produtos->items() as $produto)
                                <tr>
                                    <td class=" align-middle"> {{ $produto->produto }} </td>
                                    <td class=" align-middle"> {{ $produto->categoria }} </td>
                                    <td class=" align-middle"> {{ $produto->fornecedor }} </td>
                                    <td class="text-center align-middle"> {{ $produto->minimo }} </td>
                                    <td class="text-center align-middle">  </td>
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

                <!--================================================SM==================================================================================== -->
                <div class="d-lg-none d-md-none d-xl-none d-xxl-none d-block">
                    <table class="table table-striped table-bordered " id="datatables">
                        <thead class="table-dark">
                            <th class="text-center align-middle">Produto</th>
                            <th class="text-center align-middle">QTDE. Min</th>
                            <th class="text-center align-middle">Estoque</th>
                            <th class="text-center align-middle">Detalhes</th>
                        </thead>
                        <tbody>
                            @foreach ($produtos->items() as $produto)
                                <tr>
                                    <td class="text-center align-middle"> {{ $produto->produto }} </td>
                                    <td class="text-center align-middle"> {{ $produto->minimo }} </td>
                                    <td class="text-center align-middle">  </td>
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
            @else
                <p class=" text-center opacity-50 mt-5">Sem produtos cadastrados.</p>
            @endif
        </div>
    </div>
@endsection
