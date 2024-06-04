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

        const total = document.querySelector('#valor_total');
        const quantidade = document.querySelector('#quantidade');
        const unidade = document.querySelector('#valor_unidade');
        const frete = document.querySelector('#frete');

        frete.addEventListener('change', () => {

            total.value = (parseInt(quantidade.value) * parseInt(unidade.value)) + parseInt(frete.value);
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

        const total = document.querySelector('#valor_totalSaida');
        const quantidade = document.querySelector('#quantidadeSaida');
        const unidade = document.querySelector('#valor_unidadeSaida');
        const frete = document.querySelector('#freteSaida');

        frete.addEventListener('change', () => {

            total.value = (parseInt(quantidade.value) * parseInt(unidade.value)) - parseInt(frete.value);
        });
    }
</script>
