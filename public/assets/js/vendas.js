$(document).ready(() => {
    vendaProdutos();
    updateVendaProduto();
    // ====================================================================================================
    function vendaProdutos() {
        var select = $('#produto');

        select.change(() => {
            var id = select.find(':selected').attr('data-disponivel');
            url = "/estoque_disponivel_vendas/" + id;
            url = url.replace(':id', id)
            $.ajax({
                url: url,
                success: (data) => {
                    $('#estoqueDisponivel').html('Estoque Disponível: ' +
                        `<strong>${data.estoque}</strong>`);
                    $('#estoque').val(data.estoque);
                }
            }, 'json');
        });

        var quantidade = $('#quantidadeVenda')

        quantidade.keyup(() => {
            var estoque = $('#estoque');
            let error = $('#error');
            let adicionar = $('#adicionar');
            if (parseInt(quantidade.val()) > parseInt(estoque.val())) {
                
                error.removeClass('d-none');
                
                adicionar.attr('disabled', true)
            } else {
                error.addClass('d-none');
                adicionar.prop("disabled", false);
            }
        })
    }

    // ====================================================================================================
    
    function updateVendaProduto() {
        var select = $('#produtoUpdateVenda');
        var venda = $('#venda');
        var id = venda.val();

        select.change(() => {

            var produto_id = select.find(':selected').attr('data-disponivel');
            url = `/itens_venda/:produto_id/:id`;
            url = url.replace(':produto_id', produto_id);
            url = url.replace(':id', id);
            $.ajax({
                url: url,
                success: (data) => {
                    $('#estoqueDisponivel').html('Estoque Disponível: ' +
                        `<strong>${data.estoque}</strong>`);
                    $('#estoqueUpdate').val(data.estoque);
                    $('#quantidadeVenda').val(data.quantidade);
                    $('#precoVenda').val(data.preco_venda);
                }
            }, 'json');
        })




        var quantidade = $('#quantidadeVenda');

        quantidade.keyup (() => {
            var estoque = $('#estoqueUpdate');
            var error = $('#errorUpdate');
            var editar = $('#editarVenda')
           if (parseInt(quantidade.val()) > parseInt(estoque.val())) {
                
                error.removeClass('d-none');
                
                editar.attr('disabled', true)
            } else {
                error.addClass('d-none');
                editar.prop("disabled", false);
            }

        });
    }
});