<script>
    entrada();
    saida();
    //====================================================================================================
    function entrada() {
        const motivo = document.querySelector('#motivoEntrada');

        motivo.onchange = function(event) {
            
            let compra = document.querySelector('#modalCompras');
            let entradas = document.querySelector('#modalEntradas');
            let motivoEntrada = event.target.options[event.target.selectedIndex].dataset.motivo
            let valor_motivo = document.querySelector('#motivo');
            

            if (motivo.value === 'compra') {

                compra.classList.remove('d-none');
                entradas.classList.add('d-none');

            } else {

                if (motivo.value === 'doacao' || motivo.value === 'acerto_de_estoque') {
                    valor_motivo.value = motivoEntrada;
                    entradas.classList.remove('d-none');
                    compra.classList.add('d-none');
                }
            }
        };

    //====================================================================================================

        var select = document.querySelector('#compraEntrada');

        select.onchange = function(event) {
            var id = event.target.options[event.target.selectedIndex].dataset.compra;
            url = "{{ route('entrada.compra', ':id') }}";
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
        }

    }

    //====================================================================================================
    function saida() {
        const motivo = document.querySelector('#motivoSaida');

        motivo.addEventListener('change', () => {

            if (motivo.value === 'venda') {
                let cliente = document.querySelector('#cliente');
                cliente.classList.remove('d-none');
            } else {
                cliente.classList.add('d-none');
            }
        });

        estoque();

    }
    //====================================================================================================
    function estoque() {
        var select = document.querySelector('#produtoSaida');

        select.onchange = function(event) {
            var id = event.target.options[event.target.selectedIndex].dataset.estoque;
            url = "{{ route('qtde.estoque', ':id') }}";
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
                    }
                }
            }, 'json');
        }

        var quantidade = document.querySelector('#quantidadeSaida')

        quantidade.addEventListener('focusout', () => {
            var estoque = document.querySelector('#estoqueHidden');

            if (parseInt(quantidade.value) > estoque.value || estoque.value == 0) {
                let error = document.querySelector('#error');
                error.classList.remove('d-none');
                let baixar = document.querySelector('#baixar');
                baixar.setAttribute('disabled', true)
            } else {
                error.classList.add('d-none');
                baixar.disabled = false;
            }

        });

    }
</script>
