<script>
    saida();
    //====================================================================================================


    //====================================================================================================
    function saida() {

        const motivo = document.querySelector('#motivoSaida');

        motivo.onchange = function(event) {

            let vendas = document.querySelector('#modalVendas');
            let saidas = document.querySelector('#modalSaidas');
            let motivoSaida = event.target.options[event.target.selectedIndex].dataset.motivo
            let valor_motivo = document.querySelector('#inputMotivo');


            if (motivo.value === 'venda') {

                vendas.classList.remove('d-none');
                saidas.classList.add('d-none');

            } else {

                if (motivo.value === 'doacao' || motivo.value === 'acerto_de_estoque') {
                    valor_motivo.value = motivoSaida;
                    saidas.classList.remove('d-none');
                    vendas.classList.add('d-none');
                }
            }
        };

        //====================================================================================================
        var select = document.querySelector('#vendaSaida');

        select.onchange = function(event) {
            var id = event.target.options[event.target.selectedIndex].dataset.venda;
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

        estoque();

        //====================================================================================================
        tableVenda()


    }
    //====================================================================================================
    function estoque() {
        var select = document.querySelector('#produtoSaida');

        select.onchange = function(event) {
            var id = event.target.options[event.target.selectedIndex].dataset.estoque;
            url = "{{ route('estoque.disponivel.vendas', ':id') }}";
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

        quantidade.addEventListener('keyup', () => {
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

    function tableVenda() {
        var select = document.querySelector('#vendaSaida');

        select.onchange = function(event) {
            var id = event.target.options[event.target.selectedIndex].dataset.venda;
            url = "{{ route('saida.venda', ':id') }}";
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
        }
    }
</script>
