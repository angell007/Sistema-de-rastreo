// OrdersCliente
var SITEURL = document.location.origin;
document.addEventListener('DOMContentLoaded', function () {
    $.fn.dataTable.ext.errMode = 'none';

    // datatables settings
    dtOrdersCliente = $('#dataTableOrdersCliente').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth: false,
        stateSave: true,
        dataType: 'jsonp',


        ajax: SITEURL + "/clientes/OrdersCliente/" + cliente,

        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },

            {
                data: 'fecha_ingreso',
                name: 'fecha_ingreso',
            },

            {
                data: 'referencia',
                name: 'referencia',
            },

            {
                data: 'serial',
                name: 'serial',
            },

            {
                data: 'consecutivo',
                name: 'consecutivo',
            },


            {
                data: 'estado',
                name: 'estado',
            },

            {
                data: 'diagnostico',
                name: 'diagnostico',
            },

            {
                data: 'action',
                name: 'action',
                orderable: false
            },
        ],
        order: [
            [0, 'asc']
        ],

        language: {
            paginate: {
                first: "",
                previous: " ← ",
                next: " → ",
                last: ""
            },
        }

    });
});
