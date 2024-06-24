<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @yield('title') </title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="{{ asset('assets/DataTables/datatables.min.css') }}">
    <!-- Scripts Fornecedo -->
    @if (request()->routeIs('create.fornecedores') || request()->routeIs('update.fornecedores'))
        <script src="{{ asset('assets/js/cnpjFornecedor.js') }}"></script>
    @endif
    <!-- Scripts Clientes -->
    @if (request()->routeIs('create.clientes') || request()->routeIs('update.clientes'))
        <script src="{{ asset('assets/js/cnpjCliente.js') }}"></script>
    @endif
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>

    <!-- Scripts Dashboard -->
    @if (request()->routeIs('dashboard'))
        <script src="{{ asset('assets/js/app.js') }}"></script>
    @endif

    <!-- Scripts atualizar compras -->
    @if (request()->routeIs('update.compra'))
        <script src="{{ asset('assets/js/compras.js') }}"></script>
    @endif

    <!-- Scripts entrada de produtos no estoque -->
    @if (request()->routeIs('estoque.produtos'))
        <script src="{{ asset('assets/js/entradaProduto.js') }}"></script>
        <script src="{{ asset('assets/js/saidaProduto.js') }}"></script>
    @endif

    @if (request()->routeIs('produtos.venda') || request()->routeIs('update.venda'))
        <script src="{{ asset('assets/js/vendas.js') }}"></script>
    @endif

    @if (request()->routeIs('movimentacao.produtos'))
        <script src="{{ asset('assets/js/analiseProdutos.js') }}"></script>
    @endif



    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased min-vh-100">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    <!-- Bootstrap JS -->

    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

</body>

</html>
