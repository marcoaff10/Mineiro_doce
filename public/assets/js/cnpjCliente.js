window.addEventListener("DOMContentLoaded", (event) => {
    const cliente = document.querySelector('#cliente');
    const cep = document.querySelector('#cepCliente');
    const cidade = document.querySelector('#cidadeCliente');
    const bairro = document.querySelector('#bairroCliente');
    const uf = document.querySelector('#ufCliente');
    const endereco = document.querySelector('#enderecoCliente');
    const numero = document.querySelector('#numCliente');

    const cnpj = document.querySelector('#cnpjCliente');
    cnpj.addEventListener('focusout', () => {
        const valor_cnpj = cnpj.value;
        const url = 'https://publica.cnpj.ws/cnpj/' + valor_cnpj

        fetch(url)
            .then(response => {

                if (response.status !== 200) {
                    throw Error('CNPJ não encontrado na base de dados.')
                } else {
                    return response.json()
                }

            })
            .then(data => {
                if (data.estabelecimento.nome_fantasia === null) {
                    cliente.value = data.razao_social
                } else {
                    cliente.value = data.estabelecimento.nome_fantasia
                }
                cep.value = data.estabelecimento.cep;
                cidade.value = data.estabelecimento.cidade.nome;
                bairro.value = data.estabelecimento.bairro;
                uf.value = data.estabelecimento.estado.nome;
                endereco.value = data.estabelecimento.logradouro;
                numero.value = data.estabelecimento.numero;
            })
            .catch(error => {
                if (error.message) {
                    let div_error = document.createElement('div');
                    div_error.classList.add('text-danger', 'text-center', 'alert-danger', 'mt-2');
                    div_error.textContent = error.message;
                    document.querySelector('#div_cnpj').appendChild(div_error);
                    setTimeout(() => {
                        div_error.classList.remove('text-danger', 'text-center', 'alert-danger',
                            'mt-2');
                        div_error.textContent = '';
                    }, 5000)
                }


            });
    });
})