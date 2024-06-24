@extends('dashboard.dashboard')
@section('title', 'Home')
@section('content')
    <div class="row align-items-center justify-content-around">
        <div class="col-lg-5 card mb-3 p-3 " >
            <div class="row" >
                <h1 class="fs-4 fw-bold titleGraph" ><i class="bi bi-graph-up-arrow me-2 align-middle"></i>Lucro</h1>
                <div class="col-12">
                    <x-lucro-total />
                </div>
            </div>
        </div>
        <div class="col-lg-5 card mb-3 p-3">
            <div class="row">
                <h1 class="fs-4 fw-bold titleGraph"><i class="bi bi-box me-2 align-middle"></i>Produtos</h1>
                <div class="col-12">
                    <x-estatisticas-produtos />
                </div>
            </div>
        </div>


        <div class="col-lg-5 card mb-3 p-3">
            <div class="row">
                <h1 class="fs-4 fw-bold titleGraph"><i class="bi bi-truck me-2 align-middle"></i>Vendas</h1>
                <div class="col-12">
                    <x-estatisticas-vendas />
                </div>
            </div>
        </div>
        <div class="col-lg-5 card mb-3 p-3">
            <div class="row">
                <h1 class="fs-4 fw-bold titleGraph"><i class="bi bi-cart-plus me-2 align-middle"></i>Compras</h1>
                <div class="col-12">
                    <x-estatisticas-compras />
                </div>
            </div>
        </div>
    </div>

@endsection
