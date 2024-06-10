<script>
    // entrada();
    // saida();
    editarCompra();
    //====================================================================================================


    //====================================================================================================

    //====================================================================================================
    // function entrada() {
    //     const motivo = document.querySelector('#motivoEntrada');

    //     motivo.addEventListener('change', () => {

    //         if (motivo.value === 'compra') {
    //             let fornecedor = document.querySelector('#fornecedor');
    //             let fornecedorSelect = document.querySelector('#fornecedorSelect');
    //             fornecedor.classList.remove('d-none');
    //             fornecedorSelect.setAttribute('required', true)
    //         } else {
    //             fornecedor.classList.add('d-none');
    //             fornecedorSelect.required = false
    //         }
    //     });

    // }

    // //====================================================================================================
    // function saida() {
    //     const motivo = document.querySelector('#motivoSaida');

    //     motivo.addEventListener('change', () => {

    //         if (motivo.value === 'venda') {
    //             let cliente = document.querySelector('#cliente');
    //             cliente.classList.remove('d-none');
    //         } else {
    //             cliente.classList.add('d-none');
    //         }
    //     });

    //     estoque();

    // }
    // //====================================================================================================
    // function estoque() {
    //     var select = document.querySelector('#produtoSaida');

    //     select.onchange = function(event) {
    //         var id = event.target.options[event.target.selectedIndex].dataset.estoque;
    //         url = "{{ route('qtde.estoque', ':id') }}";
    //         url = url.replace(':id', id)
    //         $.ajax({
    //             url: url,
    //             success: (data) => {
    //                 if (data.estoque === null) {
    //                     var semEstoque = 0;
    //                     $('#estoque').html(semEstoque);
    //                     $('#estoqueHidden').val(semEstoque)
    //                 } else {
    //                     $('#estoque').html(data.estoque);
    //                     $('#estoqueHidden').val(data.estoque)
    //                 }
    //             }
    //         }, 'json');
    //     }

    //     var quantidade = document.querySelector('#quantidadeSaida')

    //     quantidade.addEventListener('focusout', () => {
    //         var estoque = document.querySelector('#estoqueHidden');

    //         if (parseInt(quantidade.value) > estoque.value || estoque.value == 0) {
    //             let error = document.querySelector('#error');
    //             error.classList.remove('d-none');
    //             let baixar = document.querySelector('#baixar');
    //             baixar.setAttribute('disabled', true)
    //         } else {
    //             error.classList.add('d-none');
    //             baixar.disabled = false;
    //         }

    //     });

    // }

    function editarCompra() {
        var select = document.querySelector('#produtoCompra');
        select.onchange = function(event) {
            var id = event.target.options[event.target.selectedIndex].dataset.produto;
            url = "{{ route('itens.compra', ':id') }}";
            url = url.replace(':id', id)
            $.ajax({
                url: url,
                success: (data) => {
                    $('#quantidadeCompra').val(data.quantidade);
                    $('#precoCompra').val(data.preco_compra);
                }
            }, 'json');
        }
    }
</script>
