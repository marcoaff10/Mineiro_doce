//============================================================================================================
// API CNPJ
//============================================================================================================

// preenchimento automatico
const fornecedor = document.querySelector('#fornecedor');
const cep = document.querySelector('#cep');
const cidade = document.querySelector('#cidade');
const bairro = document.querySelector('#bairro');
const uf = document.querySelector('#uf');
const endereco = document.querySelector('#endereco');
const numero = document.querySelector('#num');

const cnpj = document.querySelector('#cnpj');

cnpj.addEventListener('change', () => {
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
                fornecedor.value = data.razao_social
            } else {
                fornecedor.value = data.estabelecimento.nome_fantasia
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
                    div_error.classList.remove('text-danger', 'text-center', 'alert-danger', 'mt-2');
                    div_error.textContent = '';
                }, 5000)
            }


        });
});

//============================================================================================================
// Entrada de Produtos Imput Fornecedor
//============================================================================================================
