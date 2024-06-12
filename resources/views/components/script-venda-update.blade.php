<script>

    updateVendaProduto()
    function updateVendaProduto() {
        var select = document.querySelector('#produtoUpdateVenda');
        var venda = document.querySelector('#venda');
        var id = venda.value;
        select.onchange = function(event) {
            var produto_id = event.target.options[event.target.selectedIndex].dataset.disponivel;
            url = "{{ route('itens.venda', ['produto_id' => ':produto_id', 'id' => ':id']) }}";
            url = url.replace(':produto_id', produto_id);
            url = url.replace(':id', id);
            $.ajax({
                url: url,
                success: (data) => {
                    $('#estoqueDisponivel').html('Estoque Disponível: ' +
                        `<strong>${data.estoque}</strong>`);
                    $('#estoque').val(data.estoque);
                    $('#quantidadeVenda').val(data.quantidade);
                    $('#precoVenda').val(data.preco_venda);
                }
            }, 'json');
        }

        var quantidade = document.querySelector('#quantidadeVenda');

        quantidade.addEventListener('focusout', () => {
            var estoque = document.querySelector('#estoque');

            if (parseInt(quantidade.value) > estoque.value) {
                let error = document.querySelector('#error');
                error.classList.remove('d-none');
                let editarVenda = document.querySelector('#editarVenda');
                editarVenda.setAttribute('disabled', true)
            } else {
                error.classList.add('d-none');
                editarVenda.disabled = false;
            }

        });
    }
</script>
