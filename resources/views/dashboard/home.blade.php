@extends('dashboard.dashboard')
@section('title', 'Home')
@section('content')
    <div class="row align-items-center justify-content-around">
        <div class="col-lg-5 card mb-3 p-3 " >
            <div class="row" >
                <h1 class="fs-4 fw-bold text-info" ><i class="bi bi-graph-up-arrow me-1 align-middle"></i>Lucro</h1>
                <div class="col-12">
                    <x-lucro-total />
                </div>
            </div>
        </div>
        <div class="col-lg-5 card mb-3 p-3">
            <div class="row">
                <h1 class="fs-4 fw-bold text-info"><i class="bi bi-box me-1 align-middle"></i>Produtos</h1>
                <div class="col-12">
                    <x-estatisticas-produtos />
                </div>
            </div>
        </div>


        <div class="col-lg-5 card mb-3 p-3">
            <div class="row">
                <h1 class="fs-4 fw-bold text-info">Vendas<i class="bi bi-truck ms-1 align-middle"></i></h1>
            </div>
        </div>
        <div class="col-lg-5 card mb-3 p-3">
            <div class="row">
                <h1 class="fs-4 fw-bold text-info">Compras<i class="bi bi-cart-plus ms-1 align-middle"></i></h1>
            </div>
        </div>
        <div class="col-lg-5 card mb-3 p-3">
            <div class="row">
                <h1 class="fs-4 fw-bold text-info">Fornecedores<i class="bi bi-shop ms-1 align-middle"></i></h1>
            </div>
        </div>
        <div class="col-lg-5 card mb-3 p-3">
            <div class="row">
                <h1 class="fs-4 fw-bold text-info">Clientes<i class="bi bi-people ms-1 align-middle"></i></h1>
            </div>
        </div>

    </div>

@endsection
