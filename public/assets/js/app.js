$(document).ready(function () {
    getLucro();
    getProdutos();
    getProdutosFilter();
    getVendas();
    getVendasFilter();
    getCompras();
    getComprasFilter();

    //==========================================================================================================
    // Lucro
    //==========================================================================================================
    function getLucro() {
        let chartLucro;

        $.ajax({
            url: "/lucro_total",
            success: (data) => {
                if (chartLucro) {
                    chartLucro.destroy();
                }
                const ctx = document.getElementById('lucroChart');

                chartLucro = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Receita Total', 'Custo Total', 'Lucro Total'],
                        datasets: [{
                            label: 'Valores',
                            data: [
                                data.receita,
                                data.custo,
                                data.lucro
                            ],
                            borderWidth: 1,
                            backgroundColor: [
                                'rgba(61, 235, 52, 0.2)',
                                'rgba(212, 41, 25, 0.2)',
                                'rgba(33, 18, 196, 0.2)',
                            ],
                            borderColor: [
                                'rgb(61, 235, 52)',
                                'rgb(212, 41, 25)',
                                'rgb(33, 18, 196)',
                            ]
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });

            },
            error: (error) => {
                console.log(error);
            }
        }, 'json');

        let lucroFilter = $('#lucroFilter');

        lucroFilter.click(() => {
            console.log($('#lucroDe').val(),
                $('#lucroAte').val());
            $.ajax({
                url: "/lucro_total_filtro",
                method: 'GET',
                data: {
                    'de': $('#lucroDe').val(),
                    'ate': $('#lucroAte').val()
                },
                success: (data) => {
                    if (chartLucro) {
                        chartLucro.destroy();
                    }
                    const ctx = document.getElementById('lucroChart');

                    chartLucro = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ['Receita Total', 'Custo Total', 'Lucro Total'],
                            datasets: [{
                                label: 'Valores',
                                data: [
                                    data.receita,
                                    data.custo,
                                    data.lucro
                                ],
                                borderWidth: 1,
                                backgroundColor: [
                                    'rgba(61, 235, 52, 0.2)',
                                    'rgba(212, 41, 25, 0.2)',
                                    'rgba(33, 18, 196, 0.2)',
                                ],
                                borderColor: [
                                    'rgb(61, 235, 52)',
                                    'rgb(212, 41, 25)',
                                    'rgb(33, 18, 196)',
                                ]
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });

                },
                error: (error) => {
                    console.log(error);
                }
            }, 'json');
        });
    }

    //==========================================================================================================
    // Produtos
    //==========================================================================================================

    let chartProduto;
    function getProdutos() {
        $.ajax({
            url: "/estatisticas_produtos",
            dataType: 'json',

            success: (data) => {
                var produto = [];
                var venda = [];

                for (let i = 0; i < data.length; i++) {
                    produto.push(data[i].produto);
                    venda.push(data[i].venda);

                }
                chartProdutos(produto, venda)

            },
            error: (error) => {
                console.log(error);
            }
        }, 'json');
    }

    //==========================================================================================================

    function chartProdutos(produto, venda) {

        if (chartProduto) {
            chartProduto.destroy();
        }
        const ctx = document.getElementById('produtoChart');


        chartProduto = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: produto,
                datasets: [{
                    label: 'Valores dos ' + produto.length + ' produtos mais vendidos',
                    data: venda,
                    borderWidth: 1,
                    backgroundColor: [
                        'rgba(61, 235, 52, 0.2)',
                        'rgba(212, 41, 25, 0.2)',
                        'rgba(33, 18, 196, 0.2)',
                        'rgba(18, 196, 172, 0.2)',
                        'rgba(196, 18, 184, 0.2)',

                    ],
                    borderColor: [
                        'rgb(61, 235, 52)',
                        'rgb(212, 41, 25)',
                        'rgb(33, 18, 196)',
                        'rgb(18, 196, 172)',
                        'rgb(196, 18, 184)',
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        stacked: true
                    },

                    y: {
                        stacked: true
                    }
                }
            }
        });

    }

    //==========================================================================================================
    function getProdutosFilter() {
        let produtoFilter = $('#produtoFilter');

        produtoFilter.click(() => {

            $.ajax({
                url: "/estatisticas_produtos_filtro",
                dataType: 'json',
                data: {
                    'de': $('#produtoDe').val(),
                    'ate': $('#produtoAte').val(),
                    'tipo': $('#tipoFilterProduto').val(),
                },
                success: (data) => {
                    var produto = [];
                    var venda = [];

                    for (let i = 0; i < data.length; i++) {
                        produto.push(data[i].produto);
                        venda.push(data[i].valor);
                    }

                    chartProdutosFilter(produto, venda)

                },
                error: (error) => {
                    console.log(error);
                }
            }, 'json');
        });
    }

    //==========================================================================================================
    function chartProdutosFilter(produto, venda) {

        var deInput = $('#produtoDe').val();
        var de = new Date(deInput);
        de = de.toLocaleDateString('pt-BR', { timeZone: 'UTC' });

        var ateInput = $('#produtoAte').val();
        var ate = new Date(ateInput);
        ate = ate.toLocaleDateString('pt-BR', { timeZone: 'UTC' });

        if (chartProduto) {
            chartProduto.destroy();
        }
        const ctx = document.getElementById('produtoChart');

        chartProduto = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: produto,
                datasets: [{
                    label: $('#tipoFilterProduto').val() == 'preco' ? 'Valores de ' + de + ' à ' + ate : 'Quantidade de ' + de + ' à ' + ate,
                    data: venda,
                    borderWidth: 1,
                    backgroundColor: [
                        'rgba(61, 235, 52, 0.2)',
                        'rgba(212, 41, 25, 0.2)',
                        'rgba(33, 18, 196, 0.2)',
                        'rgba(18, 196, 172, 0.2)',
                        'rgba(196, 18, 184, 0.2)',

                    ],
                    borderColor: [
                        'rgb(61, 235, 52)',
                        'rgb(212, 41, 25)',
                        'rgb(33, 18, 196)',
                        'rgb(18, 196, 172)',
                        'rgb(196, 18, 184)',
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }

    //==========================================================================================================
    // Vendas
    //==========================================================================================================

    let chartVenda;
    function getVendas() {
        $.ajax({
            url: "/estatisticas_vendas",
            dataType: 'json',

            success: (data) => {
                var clientes = [];
                var venda = [];

                for (let i = 0; i < data.length; i++) {
                    clientes.push(data[i].cliente);
                    venda.push(data[i].venda);

                }
                chartVendas(clientes, venda)

            },
            error: (error) => {
                console.log(error);
            }
        }, 'json');
    }

    //==========================================================================================================
    function chartVendas(clientes, venda) {
        if (chartVenda) {
            chartVenda.destroy();
        }

        const ctx = document.getElementById('vendaChart');

        chartVenda = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: clientes,
                datasets: [{
                    label: 'Os ' + clientes.length + ' clientes que mais compram.',
                    data: venda,
                    borderWidth: 1,
                    backgroundColor: [
                        'rgba(61, 235, 52, 0.2)',
                        'rgba(212, 41, 25, 0.2)',
                        'rgba(33, 18, 196, 0.2)',
                        'rgba(18, 196, 172, 0.2)',
                        'rgba(196, 18, 184, 0.2)',

                    ],
                    borderColor: [
                        'rgb(61, 235, 52)',
                        'rgb(212, 41, 25)',
                        'rgb(33, 18, 196)',
                        'rgb(18, 196, 172)',
                        'rgb(196, 18, 184)',
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        stacked: true
                    },

                    y: {
                        stacked: true
                    }
                }
            }
        });
    }

    //==========================================================================================================
    function getVendasFilter() {
        let vendaFilter = $('#vendaFilter');

        vendaFilter.click(() => {

            $.ajax({
                url: "/estatisticas_vendas_filtro",
                dataType: 'json',
                data: {
                    'de': $('#vendaDe').val(),
                    'ate': $('#vendaAte').val(),
                    'tipo': $('#tipoFilterVenda').val(),
                },
                success: (data) => {
                    var clientes = [];
                    var venda = [];

                    for (let i = 0; i < data.length; i++) {
                        clientes.push(data[i].cliente);
                        venda.push(data[i].valor);

                    }

                    chartVendasFilter(clientes, venda)

                },
                error: (error) => {
                    console.log(error);
                }
            }, 'json');
        });
    }

    //==========================================================================================================
    function chartVendasFilter(clientes, venda) {
        var deInput = $('#vendaDe').val();
        var de = new Date(deInput);
        de = de.toLocaleDateString('pt-BR', { timeZone: 'UTC' });

        var ateInput = $('#vendaAte').val();
        var ate = new Date(ateInput);
        ate = ate.toLocaleDateString('pt-BR', { timeZone: 'UTC' });

        if (chartVenda) {
            chartVenda.destroy();
        }

        const ctx = document.getElementById('vendaChart');

        chartVenda = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: clientes,
                datasets: [{
                    label: $('#tipoFilterVenda').val() == 'preco' ? 'Valores de ' + de + ' à ' + ate : 'Quantidade de ' + de + ' à ' + ate,
                    data: venda,
                    borderWidth: 1,
                    backgroundColor: [
                        'rgba(61, 235, 52, 0.2)',
                        'rgba(212, 41, 25, 0.2)',
                        'rgba(33, 18, 196, 0.2)',
                        'rgba(18, 196, 172, 0.2)',
                        'rgba(196, 18, 184, 0.2)',

                    ],
                    borderColor: [
                        'rgb(61, 235, 52)',
                        'rgb(212, 41, 25)',
                        'rgb(33, 18, 196)',
                        'rgb(18, 196, 172)',
                        'rgb(196, 18, 184)',
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        stacked: true
                    },

                    y: {
                        stacked: true
                    }
                }
            }
        });
    }

    //==========================================================================================================
    // Vendas
    //==========================================================================================================
    let chartCompra;
    function getCompras() {
        $.ajax({
            url: "/estatisticas_compras",
            dataType: 'json',
            success: (data) => {
                var fornecedores = [];
                var compra = [];

                for (let i = 0; i < data.length; i++) {
                    fornecedores.push(data[i].fornecedor);
                    compra.push(data[i].compra);

                }
                chartCompras(fornecedores, compra)

            },
            error: (error) => {
                console.log(error);
            }
        }, 'json');
    }

    //==========================================================================================================
    function chartCompras(fornecedores, compra) {
        if (chartCompra) {
            chartCompra.destroy();
        }

        const ctx = document.getElementById('compraChart');

        chartCompra = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: fornecedores,
                datasets: [{
                    label: 'Os ' + fornecedores.length + ' fornecedores que você mais compra.',
                    data: compra,
                    borderWidth: 1,
                    backgroundColor: [
                        'rgba(61, 235, 52, 0.2)',
                        'rgba(212, 41, 25, 0.2)',
                        'rgba(33, 18, 196, 0.2)',
                        'rgba(18, 196, 172, 0.2)',
                        'rgba(196, 18, 184, 0.2)',

                    ],
                    borderColor: [
                        'rgb(61, 235, 52)',
                        'rgb(212, 41, 25)',
                        'rgb(33, 18, 196)',
                        'rgb(18, 196, 172)',
                        'rgb(196, 18, 184)',
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        stacked: true
                    },

                    y: {
                        stacked: true
                    }
                }
            }
        });
    }

    //==========================================================================================================
    function getComprasFilter() {
        let compraFilter = $('#compraFilter');

        compraFilter.click(() => {

            $.ajax({
                url: "/estatisticas_compras_filtro",
                dataType: 'json',
                data: {
                    'de': $('#compraDe').val(),
                    'ate': $('#compraAte').val(),
                    'tipo': $('#tipoFilterCompra').val(),
                },
                success: (data) => {
                    console.log(data);
                    var fornecedores = [];
                    var compra = [];

                    for (let i = 0; i < data.length; i++) {
                        fornecedores.push(data[i].fornecedor);
                        compra.push(data[i].valor);

                    }

                    chartComprasFilter(fornecedores, compra)

                },
                error: (error) => {
                    console.log(error);
                }
            }, 'json');
        });
    }

    //==========================================================================================================
    function chartComprasFilter(fornecedores, compra) {
        var deInput = $('#compraDe').val();
        var de = new Date(deInput);
        de = de.toLocaleDateString('pt-BR', { timeZone: 'UTC' });

        var ateInput = $('#compraAte').val();
        var ate = new Date(ateInput);
        ate = ate.toLocaleDateString('pt-BR', { timeZone: 'UTC' });

        if (chartCompra) {
            chartCompra.destroy();
        }

        const ctx = document.getElementById('compraChart');

        chartCompra = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: fornecedores,
                datasets: [{
                    label: $('#tipoFilterCompra').val() == 'preco' ? 'Valores de ' + de + ' à ' + ate : 'Quantidade de ' + de + ' à ' + ate,
                    data: compra,
                    borderWidth: 1,
                    backgroundColor: [
                        'rgba(61, 235, 52, 0.2)',
                        'rgba(212, 41, 25, 0.2)',
                        'rgba(33, 18, 196, 0.2)',
                        'rgba(18, 196, 172, 0.2)',
                        'rgba(196, 18, 184, 0.2)',

                    ],
                    borderColor: [
                        'rgb(61, 235, 52)',
                        'rgb(212, 41, 25)',
                        'rgb(33, 18, 196)',
                        'rgb(18, 196, 172)',
                        'rgb(196, 18, 184)',
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        stacked: true
                    },

                    y: {
                        stacked: true
                    }
                }
            }
        });
    }










    function converterMesAno(data, ano) {
        var month = [];
        for (let i = 0; i < data.length; i++) {
            switch (data[i]) {
                case 1:
                    month.push("Janeiro" + "/" + ano[i]);
                    break;
                case 2:
                    month.push("Fevereiro" + "/" + ano[i]);
                    break;
                case 3:
                    month.push("Março" + "/" + ano[i]);
                    break;
                case 4:
                    month.push("Abril" + "/" + ano[i]);
                    break;
                case 5:
                    month.push("Maio" + "/" + ano[i]);
                    break;
                case 6:
                    month.push("Junho" + "/" + ano[i]);
                    break;
                case 7:
                    month.push("Julho" + "/" + ano[i]);
                    break;
                case 8:
                    month.push("Agosto" + "/" + ano[i]);
                    break;
                case 9:
                    month.push("Setembro" + "/" + ano[i]);
                    break;
                case 10:
                    month.push("Outubro" + "/" + ano[i]);
                    break;
                case 11:
                    month.push("Novembro" + "/" + ano[i]);
                    break;
                case 12:
                    month.push("Dezembro" + "/" + ano[i]);
                    break;
                default:
                    month.push("Mês inválido." + "/" + ano[i]);
            }

        }
        return month;

    }
});





