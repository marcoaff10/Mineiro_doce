<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Mineiro Doce</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div>
                <ul class="list-unstyled ps-0">

                    <li class="mb-1">
                        <a href="{{ route('dashboard') }}" class=" text-decoration-none btn">
                            <i class="bi bi-house"></i>
                            Home
                        </a>
                    </li>

                    
                    <li class="mb-1">
                        <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse"
                            data-bs-target="#compras-collapse" aria-expanded="false">
                            <i class="bi bi-box"></i>
                            Produtos
                            <i class="bi bi-caret-down align-middle "></i>
                        </button>
                        <div class="collapse" id="compras-collapse">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                <li class="ms-4"><a href="{{ route('show.produtos') }}" class="link-dark rounded">Visão
                                        Geral</a></li>
                                <li class="ms-4"><a href="{{ route('create.produtos') }}"
                                        class="link-dark rounded">Novo</a></li>

                            </ul>
                        </div>
                    </li>

                    <li class="mb-1">
                        <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse"
                            data-bs-target="#compras-collapse" aria-expanded="false">
                            <i class="bi bi-bag"></i>
                            Compras
                            <i class="bi bi-caret-down align-middle "></i>
                        </button>
                        <div class="collapse" id="compras-collapse">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                <li class="ms-4"><a href="{{ route('show.compras') }}" class="link-dark rounded">Visão
                                        Geral</a></li>
                                <li class="ms-4"><a href="{{ route('create.compras') }}"
                                        class="link-dark rounded">Nova</a></li>

                            </ul>
                        </div>
                    </li>

                    <li class="mb-1">
                        <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse"
                            data-bs-target="#pedidos-collapse" aria-expanded="false">
                            <i class="bi bi-cart"></i>
                            Pedidos
                            <i class="bi bi-caret-down align-middle "></i>
                        </button>
                        <div class="collapse" id="pedidos-collapse" style="">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                <li class="ms-4"><a href="{{ route('show.pedidos') }}" class="link-dark rounded">Visão
                                        Geral</a></li>
                                <li class="ms-4"><a href="{{ route('create.pedidos') }}"
                                        class="link-dark rounded">Novo</a></li>
                            </ul>
                        </div>
                    </li>

                    <li class="mb-1">
                        <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse"
                            data-bs-target="#clientes-collapse" aria-expanded="false">
                            <i class="bi bi-people"></i>
                            Clientes
                            <i class="bi bi-caret-down align-middle "></i>
                        </button>
                        <div class="collapse" id="clientes-collapse" style="">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                <li class="ms-4"><a href="#" class="link-dark rounded">Visão Geral</a></li>
                                <li class="ms-4"><a href="#" class="link-dark rounded">Novo</a></li>
                            </ul>
                        </div>
                    </li>

                    <li class="mb-1">
                        <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse"
                            data-bs-target="#fornecedores-collapse" aria-expanded="false">
                            <i class="bi bi-shop"></i>
                            Fornecedores
                            <i class="bi bi-caret-down align-middle "></i>
                        </button>
                        <div class="collapse" id="fornecedores-collapse" style="">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                <li class="ms-4"><a href="{{ route('show.fornecedores') }}" class="link-dark rounded">Visão Geral</a></li>
                                <li class="ms-4"><a href="{{ route('create.fornecedores') }}" class="link-dark rounded">Novo</a></li>
                            </ul>
                        </div>
                    </li>

                    <li class="mb-1">
                        <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse"
                            data-bs-target="#relatorios-collapse" aria-expanded="false">
                            <i class="bi bi-file-earmark-medical"></i>
                            Relatórios
                            <i class="bi bi-caret-down align-middle "></i>
                        </button>
                        <div class="collapse" id="relatorios-collapse" style="">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                <li class="ms-4"><a href="#" class="link-dark rounded">Visão Geral</a></li>
                                <li class="ms-4"><a href="#" class="link-dark rounded">Produtos</a></li>
                                <li class="ms-4"><a href="#" class="link-dark rounded">Compras</a></li>
                                <li class="ms-4"><a href="#" class="link-dark rounded">Vendas</a></li>
                                <li class="ms-4"><a href="#" class="link-dark rounded">Clientes</a></li>
                            </ul>
                        </div>
                    </li>

                </ul>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row py-4 px-lg-5 ">
            <div class="col">
                <a class="btn btn-dark " data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
                    aria-controls="offcanvasExample">
                    <i class="bi bi-arrow-bar-right"></i>
                </a>
            </div>
        </div>


        <div class="row pb-4 ">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
