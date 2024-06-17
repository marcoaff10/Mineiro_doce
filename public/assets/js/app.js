$(document).ready(function () {
    getLucro();
    getProdutos();
    getProdutosFilter();
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
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                            ],
                            borderColor: [
                                'rgb(153, 102, 255)',
                                'rgb(255, 99, 132)',
                                'rgb(75, 192, 192)',
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
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                ],
                                borderColor: [
                                    'rgb(153, 102, 255)',
                                    'rgb(255, 99, 132)',
                                    'rgb(75, 192, 192)',
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
                    label: 'Os ' + produto.length + ' produtos vendidos do mês R$ ',
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
                    'produto': $('#produto').val()
                },
                success: (data) => {
                    var produto = [];
                    var venda = [];
                    var mes = [];
                    var ano = [];

                    for (let i = 0; i < data.length; i++) {
                        produto.push(data[i].produto);
                        venda.push(data[i].valor);
                        mes.push(data[i].mes);
                        ano.push(data[i].ano);

                    }

                    chartProdutosFilter(produto, venda, mes, ano)

                },
                error: (error) => {
                    console.log(error);
                }
            }, 'json');
        });
    }

    //==========================================================================================================
    function chartProdutosFilter(produto, venda, mes, ano) {

        if (chartProduto) {
            chartProduto.destroy();
        }
        const ctx = document.getElementById('produtoChart');

        chartProduto = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: keyExists(mes),
                datasets: [{
                    label: $('#tipoFilterProduto').val() == 'preco' ? 'Valor mensal ' + produto[0] : 'Quantidade mensal ' + produto[0],
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
    function keyExists(data) {
        var month = [];
        for (let i = 0; i < data.length; i++) {
            switch (data[i]) {
                case 1:
                    month.push("Janeiro");
                    break;
                case 2:
                    month.push("Fevereiro");
                    break;
                case 3:
                    month.push("Março");
                    break;
                case 4:
                    month.push("Abril");
                    break;
                case 5:
                    month.push("Maio");
                    break;
                case 6:
                    month.push("Junho");
                    break;
                case 7:
                    month.push("Julho");
                    break;
                case 8:
                    month.push("Agosto");
                    break;
                case 9:
                    month.push("Setembro");
                    break;
                case 10:
                    month.push("Outubro");
                    break;
                case 11:
                    month.push("Novembro");
                    break;
                case 12:
                    month.push("Dezembro");
                    break;
                default:
                    month.push("Mês inválido.");
            }

        }
        return month;

    }

    //==========================================================================================================
    // Produtos
    //==========================================================================================================
    let chartVendas;

});





