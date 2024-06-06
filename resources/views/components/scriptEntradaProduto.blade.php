<script>
    entrada();
    saida();
    //====================================================================================================


    //====================================================================================================

    //====================================================================================================
    function entrada() {
        const motivo = document.querySelector('#motivoEntrada');

        motivo.addEventListener('change', () => {

            if (motivo.value === 'compra') {
                let fornecedor = document.querySelector('#fornecedor');
                fornecedor.classList.remove('d-none');
            } else {
                fornecedor.classList.add('d-none');
            }
        });

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

        const total = document.querySelector('#valor_totalSaida');
        const quantidade = document.querySelector('#quantidadeSaida');
        const unidade = document.querySelector('#valor_unidadeSaida');
        const frete = document.querySelector('#freteSaida');

        frete.addEventListener('change', () => {

            total.value = (parseInt(quantidade.value) * parseInt(unidade.value)) - parseInt(frete.value);
        });
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
