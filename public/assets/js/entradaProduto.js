$(document).ready(() => {
    entrada();
    //====================================================================================================

    function entrada() {
        const motivo = $('#motivoEntrada');

        // adicionando evento ao selecionar um motivo de entrada
        motivo.change(() => {
            let compra = $('#modalCompras');
            let entradas = $('#modalEntradas');
            let motivoEntrada = motivo.find(':selected').attr('data-motivo')
            let valor_motivo = $('#motivo');

            // fechando e/ou abrindo campos que não pertencem ao motivo selecionado
            if (motivo.val() === 'compra') {

                compra.removeClass('d-none');
                entradas.addClass('d-none');

            } else {

                if (motivo.val() === 'doacao' || motivo.val() === 'acerto_de_estoque') {
                    valor_motivo.val(motivoEntrada);
                    entradas.removeClass('d-none');
                    compra.addClass('d-none');
                }
            }
        })

        //====================================================================================================
        
        var select = $('#compraEntrada');
        // Definindo evento ao selecionar uma compra, para trazer informações da mesma
        select.change(() => {
            var id = select.find(':selected').attr('data-compra');
            url = "/compra_entrada/" + id;
            url = url.replace(':id', id)
            $.ajax({
                url: url,
                success: (data) => {
                    if (data == null) {
                        throw error
                    } else {
                        var table = document.querySelector('#table');
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

                        $('#itensCompra').removeClass('d-none')
                    }
                }
            }, 'json');
        });

    }
});