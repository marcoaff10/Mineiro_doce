<x-app-layout>
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
                            data-bs-target="#vendas-collapse" aria-expanded="false">
                            <i class="bi bi-truck"></i>
                            Vendas
                            <i class="bi bi-caret-down align-middle "></i>
                        </button>
                        <div class="collapse" id="vendas-collapse">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                <li class="ms-4"><a href="{{ route('show.vendas') }}" class="link-dark rounded">
                                    Vendas</a></li>
                                <li class="ms-4"><a href="{{ route('create.vendas') }}"
                                        class="link-dark rounded">Novo</a></li>

                            </ul>
                        </div>
                    </li>

                    <li class="mb-1">
                        <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse"
                            data-bs-target="#compras-collapse" aria-expanded="false">
                            <i class="bi bi-cart-plus"></i>
                            Compras
                            <i class="bi bi-caret-down align-middle "></i>
                        </button>
                        <div class="collapse" id="compras-collapse">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                <li class="ms-4"><a href="{{ route('show.compras') }}" class="link-dark rounded">
                                    Compras</a></li>
                                <li class="ms-4"><a href="{{ route('create.compras') }}"
                                        class="link-dark rounded">Novo</a></li>

                            </ul>
                        </div>
                    </li>

                    
                    <li class="mb-1">
                        <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse"
                            data-bs-target="#produtos-collapse" aria-expanded="false">
                            <i class="bi bi-box"></i>
                            Produtos
                            <i class="bi bi-caret-down align-middle "></i>
                        </button>
                        <div class="collapse" id="produtos-collapse">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                <li class="ms-4"><a href="{{ route('estoque.produtos') }}" class="link-dark rounded">Produtos</a></li>
                                <li class="ms-4"><a href="{{ route('create.produtos') }}"
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
                                <li class="ms-4"><a href="{{ route('show.clientes') }}" class="link-dark rounded">Clientes</a></li>
                                <li class="ms-4"><a href="{{ route('create.clientes') }}" class="link-dark rounded">Novo</a></li>
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
                                <li class="ms-4"><a href="{{ route('show.fornecedores') }}" class="link-dark rounded">Fornecedores</a></li>
                                <li class="ms-4"><a href="{{ route('create.fornecedores') }}" class="link-dark rounded">Novo</a></li>
                            </ul>
                        </div>
                    </li>

                    <li class="mb-1">
                        <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse"
                            data-bs-target="#categorias-collapse" aria-expanded="false">
                            <i class="bi bi-bookmark"></i>
                            Categorias
                            <i class="bi bi-caret-down align-middle "></i>
                        </button>
                        <div class="collapse" id="categorias-collapse" style="">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                <li class="ms-4"><a href="{{ route('show.categorias') }}" class="link-dark rounded">Categorias</a></li>
                                <li class="ms-4"><a href="{{ route('create.categorias') }}" class="link-dark rounded">Novo</a></li>
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
    <div class="container-fluid">
        <div class="row py-4  ">
            <div class="col">
                <a class="btn btn-dark " data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
                    aria-controls="offcanvasExample">
                    <i class="bi bi-arrow-bar-right"></i>
                </a>
            </div>
        </div>


        <div class="row pb-4 ">
            <div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
