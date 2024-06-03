@extends('dashboard.dashboard')
@section('title', 'Produtos')
@section('content')
    <div class="row align-items-center justify-content-center">
        <div class="col">

            <div class="row py-3">
                <div class="col">
                    <h1 class="mb-3 fs-4 d-block">Produtos <i class="bi bi-box ms-1 align-middle"></i></h1>
                </div>
                <div class="col text-end">
                    <a href=" {{ route('create.produtos') }} " class="btn btn-primary">
                        Cadastrar Produto
                    </a>
                </div>
            </div>

            <div class="row justify-content-between">
                <div class="col-lg-5 col-sm-12 d-flex justify-content-between">
                    <div class="col-sm-5 col-lg-4 mb-3">
                        <a href="" class="btn btn-success" data-bs-target="#entrada" data-bs-toggle="modal">
                            Entrada
                            <i class="bi bi-plus-circle-fill ms-1"></i>
                        </a>
                    </div>
                    <!--===============================================Modal Entrada===================================================================================== -->
                    <div class="modal fade" id="entrada" aria-hidden="true" aria-labelledby="entradaLabel" tabindex="-1">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5 text-success text-center" id="entradaLabel">
                                        Entrada
                                        <i class="bi bi-plus-circle-fill ms-1"></i>
                                    </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <form action="{{ route('entrada.produtos') }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="motivo" class="form-label">Motivo</label>
                                            <select name="motivo" id="motivo" class="form-select" required>
                                                <option value="">Selecione um motivo para a entrada</option>
                                                <option value="compra">Compra</option>
                                                <option value="doacao">Doação</option>
                                                <option value="avulso">Avulso</option>
                                            </select>
                                        </div>

                                        <div class="mb-3 d-none" id="fornecedor">
                                            <label for="fornecedor" class="form-label">Fornecedor</label>
                                            <select name="fornecedor" class="form-select">
                                                @foreach ($fornecedores as $fornecedor)
                                                    <option value="{{ $fornecedor->id }}">{{ $fornecedor->fornecedor }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="produto" class="form-label">Produto</label>
                                            <select name="produto" id="produto" class="form-select" required>
                                                @foreach ($produtos->items() as $produto)
                                                    <option value="{{ $produto->id }}">{{ $produto->produto }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="d-md-flex d-lg-flex justify-content-between mb-4">
                                            <div class="col-sm-12 col-md-5 col-lg-5 mb-3 d-flex justify-content-between">
                                                <div class="col-5">
                                                    <label for="quantidade" class="form-label">Quantidade</label>
                                                    <input type="number" name="quantidade" id="quantidade"
                                                        class="form-control" required>
                                                </div>

                                                <div class="col-5">
                                                    <label for="valor_unidade" class="form-label">Valor Uni.</label>
                                                    <input type="number" name="valor_unidade" id="valor_unidade"
                                                        class="form-control" required>
                                                </div>
                                            </div>

                                            <div class="col-sm-12 col-md-5 col-lg-5 mb-3 d-flex justify-content-between">
                                                <div class="col-5">
                                                    <label for="frete" class="form-label">Frete</label>
                                                    <input type="number" name="frete" id="frete"
                                                        class="form-control" required>
                                                </div>

                                                <div class="col-5">
                                                    <label for="valor_total" class="form-label">Total</label>
                                                    <input type="number" name="valor_total" id="valor_total"
                                                        class="form-control" required>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <button type="submit" class="btn btn-success">
                                                Salvar
                                            </button>
                                        </div>

                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!--===============================================Fim Modal Entrada===================================================================================== -->
                    <div class="col-sm-5 col-lg-4 mb-3">
                        <a href="" class="btn btn-secondary">
                            Saida
                            <i class="bi bi-dash-circle-fill ms-1"></i>
                        </a>
                    </div>
                </div>

                <div class="col-sm-12 col-lg-5">
                    <form action="" method="GET">

                        <div class="mb-3 d-flex">
                            <input type="text" name="filter" id="filter"
                                class="form-control me-3 h-25 rounded-pill" placeholder="Pesquisar"
                                value="{{ $filters['filter'] ?? '' }}">
                            <button type="submit" class="me-3 align-middle fs-5 fw-bold">
                                <strong><i class="bi bi-search"></i></strong>
                            </button>
                            @if ($filters['filter'] != '')
                                <a href="{{ route('show.produtos') }}" class="fw-bold text-danger ms-3 fs-5 align-middle">
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
                            <th class="text-center">Peso</th>
                            <th class="text-center">QTDE. Min</th>
                            <th class="text-center">Estoque</th>
                            <th class="text-center">Detalhes</th>
                        </thead>
                        <tbody>
                            @foreach ($produtos->items() as $produto)
                                <tr>
                                    <td class="w-25 align-middle"> {{ $produto->produto }} </td>
                                    <td class="align-middle"> {{ $produto->categoria }} </td>
                                    <td class="text-center align-middle">
                                        {{ $produto->peso >= 1000 ? $produto->peso / 1000 . 'kg' : $produto->peso . 'g' }}
                                    </td>
                                    <td class="text-center align-middle">
                                        {{ $produto->minimo }} uni.
                                    </td>
                                    <td class="text-center align-middle">{{ !empty($produto->quantidade) ? $produto->quantidade : '0' }}</td>
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
                                    <td class="text-center align-middle">{{ !empty($produto->quantidade) ? $produto->quantidade : '0' }}</td>
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
                                    <td class="text-center align-middle"> {{ $produto->minimo }} uni. </td>
                                    <td class="text-center align-middle">{{ !empty($produto->quantidade) ? $produto->quantidade : '0' }}</td>
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

    <x-scriptEntradaProduto />
@endsection
