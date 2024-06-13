<script>
    vendaProdutos();
    // ====================================================================================================
    function vendaProdutos() {
        var select = document.querySelector('#produto');
        select.onchange = function(event) {
            var id = event.target.options[event.target.selectedIndex].dataset.disponivel;
            url = "{{ route('estoque.disponivel.vendas', ':id') }}";
            url = url.replace(':id', id)
            $.ajax({
                url: url,
                success: (data) => {
                    $('#estoqueDisponivel').html('Estoque Disponível: ' +
                        `<strong>${data.estoque}</strong>`);
                    $('#estoque').val(data.estoque);
                }
            }, 'json');
        }

        var quantidade = document.querySelector('#quantidadeVenda')

        quantidade.addEventListener('keyup', () => {
            var estoque = document.querySelector('#estoque');

            if (parseInt(quantidade.value) > estoque.value) {
                let error = document.querySelector('#error');
                error.classList.remove('d-none');
                let adicionar = document.querySelector('#adicionar');
                adicionar.setAttribute('disabled', true)
            } else {
                error.classList.add('d-none');
                adicionar.disabled = false;
            }

        });
    }

    // ====================================================================================================



</script>
