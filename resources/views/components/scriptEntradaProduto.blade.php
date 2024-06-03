<script>

    const motivo = document.querySelector('#motivo');

    motivo.addEventListener('change', () => {

        if (motivo.value === 'compra') {
            let fornecedor = document.querySelector('#fornecedor');
            fornecedor.classList.remove('d-none');
        } else {
            fornecedor.classList.add('d-none');
        }
    })
//====================================================================================================
    const total = document.querySelector('#valor_total');
    const quantidade = document.querySelector('#quantidade');
    const unidade = document.querySelector('#valor_unidade');
    const frete = document.querySelector('#frete');

    frete.addEventListener('change', () => {
        total.value = (quantidade.value * unidade.value) - frete.value;
    });


</script>
