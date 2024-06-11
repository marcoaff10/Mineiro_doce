<script>
    editarCompra();
    
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
