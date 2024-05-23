@extends('auth.dashboard.dashboard')
@section('content')
    <div class="row align-items-center justify-content-evenly">

        <div class="col-xl-5 card p-3 mb-5" style="min-height: 400px">
            <div class="row">
                <h1 class="mb-3 fs-4">
                    Produtos
                    <i class="bi bi-box ms-1"></i>
                </h1>
            </div>
            <div class="row">
                <div class="mb-3">
                    <p>Total em Estoque: 300</p>
                </div>

                <div class="mb-3">
                    <p>Valor do Estoque: R$ 3000</p>
                </div>
            </div>
            <div class="row">
                <canvas id="myChart"></canvas>
            </div>
        </div>

        <div class="col-xl-5 card p-3 mb-5" style="min-height: 400px">
            <div class="row">
                <h1 class="mb-3 fs-4">
                    Pedidos
                    <i class="bi bi-cart"></i>
                </h1>
            </div>
            <div class="row">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid, amet fugiat, adipisci obcaecati quae
                    corrupti numquam consequuntur odio totam ratione eius, culpa hic repellendus possimus quaerat enim
                    laborum facilis debitis.</p>
            </div>
        </div>

        <div class="col-xl-5 card p-3 mb-5" style="min-height: 400px">
            <div class="row">
                <h1 class="mb-3 fs-4">
                    Clientes
                    <i class="bi bi-people"></i>
                </h1>
            </div>
            <div class="row">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid, amet fugiat, adipisci obcaecati quae
                    corrupti numquam consequuntur odio totam ratione eius, culpa hic repellendus possimus quaerat enim
                    laborum facilis debitis.</p>
            </div>
        </div>

        <div class="col-xl-5 card p-3 mb-5" style="min-height: 400px">
            <div class="row">
                <h1 class="mb-3 fs-4">
                    Fornecedores
                    <i class="bi bi-shop"></i>
                </h1>
            </div>
            <div class="row">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid, amet fugiat, adipisci obcaecati quae
                    corrupti numquam consequuntur odio totam ratione eius, culpa hic repellendus possimus quaerat enim
                    laborum facilis debitis.</p>
            </div>
        </div>
    </div>
@endsection
