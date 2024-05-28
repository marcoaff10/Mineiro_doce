@extends('dashboard.dashboard')
@section('title', 'Fornecedores')
@section('content')
    <div class="row align-items-center justify-content-center">
        <div class="col">
            <div class="row">
                <div class="col">
                    <h1 class="mb-3 fs-4 d-block">Fornecedores <i class="bi bi-box ms-1"></i></h1>
                </div>

                <div class="col text-end">
                    <a href=" {{ route('create.fornecedores') }} " class="btn btn-primary"><i
                            class="bi bi-plus-circle-dotted"></i></a>
                </div>
            </div>
            @if (count($fornecedores) > 0)
                <table class="table table-striped table-bordered d-none d-lg-block d-xl-block d-xxl-block w-100 col-12"
                    id="datatables">
                    <thead class="table-dark">
                        <th class="text-center">COD.</th>
                        <th class="text-center">Fornecedor</th>
                        <th class="text-center">CNPJ</th>
                        <th class="text-center">Telefone</th>
                        <th class="text-center">E-mail</th>
                        <th class="text-center">Cidade</th>
                        <th class="text-center">CEP</th>
                        <th class="text-center">Detalhes</th>
                    </thead>
                    <tbody>
                        @foreach ($fornecedores as $fornecedor)
                            <tr>
                                <td class="text-center"> {{ cod($fornecedor['id_fornecedor']) }} </td>
                                <td class="w-25"> {{ $fornecedor['fornecedor'] }} </td>
                                <td class="text-center"> {{ cnpj($fornecedor['cnpj']) }} </td>
                                <td class="text-center"> {{ telefone($fornecedor['telefone']) }} </td>
                                <td> {{ $fornecedor['email'] }} </td>
                                <td> {{ $fornecedor['cidade'] . ', ' . uf($fornecedor['uf']) }} </td>
                                <td class="text-center"> {{ cep($fornecedor['cep']) }} </td>
                                <td class="text-center">
                                    <a href=" {{ route('detalhes.fornecedores', ['id' => Crypt::encrypt($fornecedor['id_fornecedor'])]) }} "
                                        class="text-decoration-none text-success">
                                        <i class="bi bi-arrow-right-circle-fill"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!--===============================================MD===================================================================================== -->
                <table class="table table-striped table-bordered d-none d-md-block d-lg-none " id="datatables">
                    <thead class="table-dark">
                        <th class="text-center">COD.</th>
                        <th class="text-center">Fornecedor</th>
                        <th class="text-center">CNPJ</th>
                        <th class="text-center">Detalhes</th>
                    </thead>
                    <tbody>
                        @foreach ($fornecedores as $fornecedor)
                            <tr>
                                <td class="text-center"> {{ cod($fornecedor['id_fornecedor']) }} </td>
                                <td> {{ $fornecedor['fornecedor'] }} </td>
                                <td class="text-center"> {{ cnpj($fornecedor['cnpj']) }} </td>
                                <td class="text-center">
                                    <a href=" {{ route('detalhes.fornecedores', ['id' => Crypt::encrypt($fornecedor['id_fornecedor'])]) }} "
                                        class="text-decoration-none text-success">
                                        <i class="bi bi-arrow-right-circle-fill"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!--================================================SM==================================================================================== -->
                <table class="table table-striped table-bordered d-lg-none d-md-none d-xl-none d-xxl-none d-block "
                    id="datatables">
                    <thead class="table-dark">
                        <th class="text-center">COD.</th>
                        <th class="text-center">Fornecedor</th>
                        <th class="text-center">Detalhes</th>
                    </thead>
                    <tbody>
                        @foreach ($fornecedores as $fornecedor)
                            <tr>
                                <td class="text-center"> {{ cod($fornecedor['id_fornecedor']) }} </td>
                                <td class="w-25"> {{ primeiro_nome($fornecedor['fornecedor']) }} </td>
                                <td class="text-center">
                                    <a href=" {{ route('detalhes.fornecedores', ['id' => Crypt::encrypt($fornecedor['id_fornecedor'])]) }} "
                                        class="text-decoration-none text-success">
                                        <i class="bi bi-arrow-right-circle-fill"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class=" text-center opacity-50">Sem fornecedores cadastrados.</p>
            @endif
        </div>
    </div>
@endsection
