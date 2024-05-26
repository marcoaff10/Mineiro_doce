$(document).ready(function () {

    // datatable
    $('#datatables').DataTable({
        responsive: true,
        columnDefs: [
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 2, targets: -1 }
        ],
        pageLength: 10,
        pagingType: "full_numbers",
        language: {
            decimal: "",
            emptyTable: "Sem dados disponíveis na tabela.",
            info: "Mostrando _START_ até _END_ de _TOTAL_ registos",
            infoEmpty: "Mostrando 0 até 0 de 0 registos",
            infoFiltered: "(Filtrando _MAX_ total de registos)",
            infoPostFix: "",
            thousands: ",",
            lengthMenu: "Mostrando _MENU_ registos por página.",
            loadingRecords: "Carregando...",
            processing: "Processando...",
            search: "Filtrar:",
            zeroRecords: "Nenhum registro encontrado.",
            paginate: {
                first: "<i class='bi bi-caret-left-fill'></i><i class='bi bi-caret-left-fill'></i>",
                last: "<i class='bi bi-caret-right-fill'></i><i class='bi bi-caret-right-fill'></i>",
                next: "<i class='bi bi-caret-right-fill'></i>",
                previous: "<i class='bi bi-caret-left-fill'></i>"
            },
            aria: {
                sortAscending: ": ative para classificar a coluna em ordem crescente.",
                sortDescending: ": ative para classificar a coluna em ordem decrescente."
            }
        }
    });
})