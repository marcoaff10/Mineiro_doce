// $(document).ready(function () {

//     // datatable
//     $('#datatables').DataTable({
//         responsive: true,
//         columnDefs: [
//             { responsivePriority: 1, targets: 0 },
//             { responsivePriority: 2, targets: -1 }
//         ],
//         pageLength: 10,
//         pagingType: "full_numbers",
//         language: {
//             decimal: "",
//             emptyTable: "Sem dados disponíveis na tabela.",
//             info: "Mostrando _START_ até _END_ de _TOTAL_ registos",
//             infoEmpty: "Mostrando 0 até 0 de 0 registos",
//             infoFiltered: "(Filtrando _MAX_ total de registos)",
//             infoPostFix: "",
//             thousands: ",",
//             lengthMenu: "Mostrando _MENU_ registos por página.",
//             loadingRecords: "Carregando...",
//             processing: "Processando...",
//             search: "Filtrar:",
//             zeroRecords: "Nenhum registro encontrado.",
//             paginate: {
//                 first: "<i class='bi bi-caret-left-fill'></i><i class='bi bi-caret-left-fill'></i>",
//                 last: "<i class='bi bi-caret-right-fill'></i><i class='bi bi-caret-right-fill'></i>",
//                 next: "<i class='bi bi-caret-right-fill'></i>",
//                 previous: "<i class='bi bi-caret-left-fill'></i>"
//             },
//             aria: {
//                 sortAscending: ": ative para classificar a coluna em ordem crescente.",
//                 sortDescending: ": ative para classificar a coluna em ordem decrescente."
//             }
//         }
//     });
// })

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
                throw Error('CNPJ inválido.')
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
