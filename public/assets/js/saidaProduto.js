$(document).ready(() => {
    saida();
    //====================================================================================================
    function saida() {


        const motivo = $('#motivoSaida');
        var quantidade = $('#quantidadeSaida')


        // definindo motivo de venda
        motivo.change(() => {
            quantidade.val(null);
            let vendas = $('#modalVendas');
            let saidas = $('#modalSaidas');
            let motivoSaida = motivo.find(':selected').attr('data-motivo')
            let valor_motivo = $('#inputMotivo');

            if (motivo.val() === 'venda') {
                vendas.removeClass('d-none');
                saidas.addClass('d-none');

            } else {

                if (motivo.val() === 'doacao' || motivo.val() === 'acerto_de_estoque') {
                    // função para consultar quantidade em estoque caso o motivo seje outro diferente de venda
                    estoque();
                    valor_motivo.val(motivoSaida);
                    saidas.removeClass('d-none');
                    vendas.addClass('d-none');
                }
            }
        })

        // Adicionando tabela com informações de venda na página
        tableVenda();

    }
    //====================================================================================================
    function estoque() {
        var select = $('#produtoSaida');
        var quantidade = $('#quantidadeSaida')
        select.change(() => {
            quantidade.val(null);
            var id = select.find(':selected').attr('data-estoque');
            url = "/estoque_disponivel_vendas/" + id;
            url = url.replace(':id', id)
            $.ajax({
                url: url,
                success: (data) => {

                    if (data.estoque === null) {
                        var semEstoque = 0;
                        $('#estoque').html(semEstoque);
                        $('#estoqueHidden').val(semEstoque)
                    } else {
                        $('#estoque').html(data.estoque);
                        $('#estoqueHidden').val(data.estoque)
                        baixar.disabled = false;
                    }
                }
            }, 'json');
        });

        var quantidade = $('#quantidadeSaida')

        // Verificando se quantidade desejada para saida de produto é superior a quantidade existente em estoque, se for retorna erro.
        quantidade.keyup(() => {
            var estoque = $('#estoqueHidden');
            let error = $('#error');
            if (parseInt(quantidade.val()) > parseInt(estoque.val()) || parseInt(estoque.val()) == 0) {

                error.removeClass('d-none');
                let baixar = $('#baixar');
                baixar.attr('disabled', true)
            } else {
                error.addClass('d-none');
                baixar.disabled = false;
            }
        })

    }

    //====================================================================================================
    function tableVenda() {
        var select = $('#vendaSaida');

        select.change(() => {
            var id = select.find(':selected').attr('data-venda');
            url = "/venda_saida/" + id;
            url = url.replace(':id', id)
            $.ajax({
                url: url,
                success: (data) => {
                    if (data == null) {
                        throw error
                    } else {
                        var table = document.querySelector('#tableVenda');
                        table.innerHTML = null;
                        data.forEach(itens => {

                            var tr = document.createElement('tr');
                            var td =
                                `<td class="text-center align-middle"> ${itens.produto} </td>`;
                            td +=
                                `<td class="text-center align-middle"> ${itens.quantidade} </td>`;
                            tr.innerHTML = td;
                            table.appendChild(tr);
                        });

                        $('#itensVenda').removeClass('d-none')
                    }
                }
            }, 'json');
        })
    }
})

