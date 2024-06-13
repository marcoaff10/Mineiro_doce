@extends('dashboard.dashboard')
@section('title', 'Fornecedores')
@section('content')
    <div class="row align-items-center justify-content-center">
        <div class="col">

            <div class="row">
                <div class="col">
                    <h1 class="mb-3 fs-4 d-block">Fornecedores <i class="bi bi-shop ms-1 align-middle"></i></h1>
                </div>
            </div>

            <div class="row justify-content-between">
                <div class="col-sm-12 col-lg-4 mb-3">
                    <a href=" {{ route('create.fornecedores') }} " class="btn btn-primary">
                        Cadastrar Fornecedor
                        <i class="bi bi-plus-circle ms-1"></i>
                        </a>
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
                                <a href="{{ route('show.fornecedores') }}"
                                    class="fw-bold text-danger ms-3 fs-5 align-middle">
                                    <strong><i class="bi bi-x-lg align-middle"></i></strong>
                                </a>
                            @endif
                        </div>
                    </form>
                </div>


            </div>

            @if (count($fornecedores->items()) > 0)
                <div class="d-none d-lg-block d-xl-block d-xxl-block w-100 col-12">
                    <table class="table table-striped table-bordered " id="datatables">
                        <thead class="table-dark">
                            <th class="text-center">Fornecedor</th>
                            <th class="text-center">CNPJ</th>
                            <th class="text-center">Telefone</th>
                            <th class="text-center">E-mail</th>
                            <th class="text-center">Cidade</th>
                            <th class="text-center">CEP</th>
                            <th class="text-center">Detalhes</th>
                        </thead>
                        <tbody>
                            @foreach ($fornecedores->items() as $fornecedor)
                                <tr>
                                    <td class="w-25 align-middle"> {{ $fornecedor->fornecedor }} </td>
                                    <td class="text-center align-middle"> {{ cnpj($fornecedor->cnpj) }} </td>
                                    <td class="text-center align-middle"> {{ telefone($fornecedor->telefone) }} </td>
                                    <td class=" align-middle"> {{ $fornecedor->email }} </td>
                                    <td class=" align-middle"> {{ $fornecedor->cidade . ', ' . uf($fornecedor->uf) }} </td>
                                    <td class="text-center align-middle"> {{ cep($fornecedor->cep) }} </td>
                                    <td class="text-center align-middle">
                                        <a href=" {{ route('detalhes.fornecedores', ['id' => $fornecedor->id]) }} "
                                            class="text-decoration-none text-success">
                                            <i class="bi bi-arrow-right-circle-fill"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <x-pagination :paginator="$fornecedores" :appends="$filters" />
                </div>
                
                <!--===============================================MD===================================================================================== -->
                <div class="d-none d-md-block d-lg-none">
                    <table class="table table-striped table-bordered " id="datatables">
                        <thead class="table-dark">
                            <th class="text-center">Fornecedor</th>
                            <th class="text-center">CNPJ</th>
                            <th class="text-center">Detalhes</th>
                        </thead>
                        <tbody>
                            @foreach ($fornecedores->items() as $fornecedor)
                                <tr>
                                    <td class=" align-middle"> {{ $fornecedor->fornecedor }} </td>
                                    <td class="text-center align-middle"> {{ cnpj($fornecedor->cnpj) }} </td>
                                    <td class="text-center align-middle">
                                        <a href=" {{ route('detalhes.fornecedores', ['id' => $fornecedor->id]) }} "
                                            class="text-decoration-none text-success">
                                            <i class="bi bi-arrow-right-circle-fill"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <x-pagination :paginator="$fornecedores" :appends="$filters" />
                </div>
               
                <!--================================================SM==================================================================================== -->
                <div class="d-lg-none d-md-none d-xl-none d-xxl-none d-block">
                    <table class="table table-striped table-bordered" id="datatables">
                        <thead class="table-dark">
                            <th class="text-center">Fornecedor</th>
                            <th class="text-center">Detalhes</th>
                        </thead>
                        <tbody>
                            @foreach ($fornecedores->items() as $fornecedor)
                                <tr>
                                    <td class="w-75 align-middle"> {{ (strlen($fornecedor->fornecedor) > 30 ? primeiro_nome($fornecedor->fornecedor) : $fornecedor->fornecedor) }} </td>
                                    <td class="text-center align-middle">
                                        <a href=" {{ route('detalhes.fornecedores', ['id' => $fornecedor->id]) }} "
                                            class="text-decoration-none text-success">
                                            <i class="bi bi-arrow-right-circle-fill"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <x-pagination :paginator="$fornecedores" :appends="$filters" />
                </div>
            @else
                <p class=" text-center opacity-50 mt-5">Sem fornecedores cadastrados.</p>
            @endif
        </div>
    </div>
@endsection
