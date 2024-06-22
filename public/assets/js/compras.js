$(document).ready(() => {
    editarCompra();

    function editarCompra() {
        var produto = $('#produtoCompra')
        produto.change((e) => {
            e.preventDefault();
            var id = produto.find(':selected').attr('data-produto');
            url = "/itens_compra/" + id;
            url = url.replace(':id', id)
            $.ajax({
                url: url,
                success: (data) => {
                    $('#quantidadeCompra').val(data.quantidade);
                    $('#precoCompra').val(data.preco_compra);
                }
            }, 'json');
        });

    }
});