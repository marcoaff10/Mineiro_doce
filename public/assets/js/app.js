$(document).ready(function () {
    let grafico;

    $.ajax({
        url: "/lucro_total",
        dataType: 'json',
        data: {
            'de': $('#de').val(),
            'ate': $('#ate').val()
        },
        success: (data) => {
            console.log(data);
            if (grafico) {
                grafico.destroy();
            }
            const ctx = document.getElementById('lucroChart');

            grafico = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Lucro Total', 'Receita Total', 'Custo Total'],
                    datasets: [{
                        data: [
                            data.lucro_total,
                            data.receita_total,
                            data.custo_total,
                        ],
                        borderWidth: 1
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
            }, 'json');

        },
        error: (error) => {
            console.log(error);
        }
    });

    let lucroFilter = $('#lucroFilter');

    lucroFilter.click(() => {
        $.ajax({
            url: "/lucro_total",
            method: 'GET',
            dataType: 'json',
            data: {
                'de': $('#de').val(),
                'ate': $('#ate').val()
            },
            success: (data) => {
                console.log(data);
                if (grafico) {
                    grafico.destroy();
                }
                const ctx = document.getElementById('lucroChart');

                grafico = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: ['Lucro Total', 'Receita Total', 'Custo Total'],
                        datasets: [{
                            data: [
                                data.lucro_total,
                                data.receita_total,
                                data.custo_total,
                            ],
                            borderWidth: 1
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
                }, 'json');

            },
            error: (error) => {
                console.log(error);
            }
        });
    })
})


