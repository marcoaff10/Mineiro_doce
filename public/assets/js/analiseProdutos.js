$(document).ready(() => {
    getAnaliseProduto();
    getAnaliseProdutoFiltro();
    var chartAnalise;
    // ===============================================================================================
    function getAnaliseProduto() {
        var id = $('#produtoId');
        $.ajax({
            url: "/analise_produto/" + id.val(),
            success: (data) => {
                var mes = [];
                var quantidade = [];
                var ano = [];
                for (let i = 0; i < data.length; i++) {
                    mes.push(data[i].mes);
                    quantidade.push(data[i].valor);
                    ano.push(data[i].ano);
                }
                chartAnaliseProduto(quantidade, mes, ano);


            },
            error: (error) => {
                console.log(error);
            }
        }, 'json');
    }

    function chartAnaliseProduto(quantidade, mes, ano) {
        if (chartAnalise) {
            chartAnalise.destroy();
        }
        const ctx = $('#analiseProdutoChart');

        chartAnalise = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: converterMesAno(mes, ano),
                datasets: [{
                    label: 'Preço de venda Por mês',
                    data: quantidade,
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
    // ===============================================================================================
    function getAnaliseProdutoFiltro() {
        var filter = $('#analiseProdutoFilter');

        filter.click(() => {
            var dataFilter = {
                id: $('#produtoId').val(),
                de: $('#produtoDe').val(),
                ate: $('#produtoAte').val(),
                tipo: $('#tipoFilterProduto').val(),
                por: $('#por').val(),

            }

            $.ajax({
                url: "/analise_produto_filtro",
                dataType: 'json',
                data: dataFilter,
                success: (data) => {
                    console.log(data);
                    var mes = [];
                    var quantidade = [];
                    var ano = [];
                    for (let i = 0; i < data.length; i++) {
                        mes.push(data[i].mes);
                        quantidade.push(data[i].valor);
                        ano.push(data[i].ano);
                    }

                    chartAnaliseProdutoFiltro(quantidade, mes, ano)

                },
                error: (error) => {
                    console.log(error);
                }
            }, 'json');
        });

    }

    function chartAnaliseProdutoFiltro(quantidade, mes, ano) {

        var deInput = $('#produtoDe').val();
        var de = new Date(deInput);
        de = de.toLocaleDateString('pt-BR', { timeZone: 'UTC' });

        var ateInput = $('#produtoAte').val();
        var ate = new Date(ateInput);
        ate = ate.toLocaleDateString('pt-BR', { timeZone: 'UTC' });

        var labelsFilter = {
            de: de,
            ate: ate,
            tipo: $('#tipoFilterProduto').val(),
            por: $('#por').val(),

        }

        if (chartAnalise) {
            chartAnalise.destroy();
        }

        const ctx = $('#analiseProdutoChart');

        chartAnalise = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: converterMesAno(mes, ano),
                datasets: [{
                    label: labelFilter(labelsFilter),
                    data: quantidade,
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
    // ===============================================================================================
    // Convertendo numero do mes no nome
    function converterMesAno(mes, ano) {
        var month = [];
        for (let i = 0; i < mes.length; i++) {
            switch (mes[i]) {
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

    function labelFilter(data) {
        if (data.tipo == 'venda' && data.por == 'preco') {
            return `Valores de vendas de ${data.de} até ${data.ate}.`

        } else if (data.tipo == 'venda' && data.por == 'quantidade') {
            return `Quantidade de vendas de ${data.de} até ${data.ate}.`

        } else if (data.tipo == 'compra' && data.por == 'preco') {
            return `Valores de compras de ${data.de} até ${data.ate}.`
            
        } else if (data.tipo == 'compra' && data.por == 'quantidade') {
            return `Quantidade de compras de ${data.de} até ${data.ate}.`
        }
    }
});