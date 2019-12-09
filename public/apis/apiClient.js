var SITEURL = document.location.origin;
var formClienteRegister = document.getElementById('formClienteRegister');
formClienteRegister.addEventListener('submit', ajaxFormRegisterClientes);

var formClienteUpdate = document.getElementById('formClienteUpdate');
formClienteUpdate.addEventListener('submit', ajaxFormUpdateCliente);

document.addEventListener('DOMContentLoaded', function () {
    // datatables settings

    $.fn.dataTable.ext.errMode = 'none';
    dtClientes = $('#dataTableClientes').DataTable({
        processing: true,
        serverSide: true,
        stateSave: true,
        responsive: true,
        autoWidth: false,

        ajax: SITEURL + "/clientes/",

        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },
            {
                data: 'nombre',
                name: 'nombre'
            },
            {
                data: 'email',
                name: 'email'
            },
            {
                data: 'direccion',
                name: 'direccion'
            },
            {
                data: 'barrio',
                name: 'barrio'
            },
            {
                data: 'ciudad',
                name: 'ciudad'
            },
            {
                data: 'departamento',
                name: 'departamento'
            },
            {
                data: 'telefono',
                name: 'telefono'
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




//Envio de datos ajax
function ajaxFormRegisterClientes(event) {

    event.preventDefault();

    document.getElementById("btnSaveCliente").value = "Enviando...";

    const dataRegister = new FormData(formClienteRegister);

    fetch(formClienteRegister.action, {
            method: 'POST',
            body: dataRegister,
            mode: "cors",
            headers: {
                accept: "application/json",
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        .then(response => {
            if (response.ok) {
                response.text().then(success => {
                    toastr.info('Success', success)
                    dtClientes.draw();
                    $('#formClienteRegister').trigger("reset");
                    $('#modalClienteRegister').modal('hide');
                })
                document.getElementById("btnSaveCliente").value = "Enviar";
            } else {
                response.json().then(error => {
                    Object.keys(error.errors).forEach(key => {
                        toastr.error('Error', error.errors[key])
                    })
                    // console.log(error);
                });
                document.getElementById("btnSaveCliente").value = "Enviar";
            }
        })
        .catch(error => {
            console.log(error);
        })
}

// Traer datos de cliente
function editarCliente(ente_id) {
    const url = SITEURL + '/clientes/' + ente_id + '/edit'
    const formClienteUpdate = document.getElementById('formClienteUpdate');
    fetch(url, {
            // method: 'GET',
            mode: "cors",
            headers: {
                accept: "application/json",
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        .then(response => {
            if (response.ok) {
                response.json().then(success => {
                    formClienteUpdate.id.value = success.id;
                    formClienteUpdate.nombre.value = success.nombre;
                    formClienteUpdate.apellido.value = success.apellido;
                    formClienteUpdate.email.value = success.email;
                    formClienteUpdate.tipo_identificacion.value = success.tipo_identificacion;
                    formClienteUpdate.identificacion.value = success.identificacion;
                    formClienteUpdate.direccion.value = success.direccion;
                    formClienteUpdate.ciudad.value = success.ciudad;
                    formClienteUpdate.departamento.value = success.departamento;
                    formClienteUpdate.barrio.value = success.barrio;
                    formClienteUpdate.telefono.value = success.telefono;
                    formClienteUpdate.opcional_telefono.value = success.opcional_telefono
                    $('#modalClienteUpdate').modal('show')
                });
            }
        })
        .catch(error => {
            console.log('request failed');
        });
};


//Envio de datos ajax a actualizar
function ajaxFormUpdateCliente(event) {
    event.preventDefault();

    const dataUpdate = new FormData(formClienteUpdate);
    document.getElementById("btnUpdateCliente").value = "Enviando...";

    fetch(formClienteUpdate.action, {
            method: 'POST',
            body: dataUpdate,
            mode: "cors",
            headers: {
                accept: "application/json",
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        .then(response => {
            if (response.ok) {
                response.text().then(success => {
                    toastr.info('Success', success)
                    dtClientes.draw();
                    $('#formClienteUpdate').trigger("reset");
                    $('#modalClienteUpdate').modal('hide');
                    document.getElementById("btnUpdateCliente").value = "Enviar";
                })
            } else {
                response.json().then(error => {
                    console.log(error);
                    Object.keys(error.errors).forEach(key =>
                        toastr.error('Error', error.errors[key]))
                })

                document.getElementById("btnUpdateCliente").value = "Enviar";
            }
        })
        .catch(error => {
            console.log(error);
        });
}

// Eliminar cliente
function eliminarCliente(ente_id) {
    toastr.options.preventDuplicates = true;
    toastr.warning("<br /><button class='btn btn-sm btn-danger m-1' type='button' value='yes'>Yes</button> <button class='btn btn-sm btn-dark m-1' type ='button'  value='no' > No </button>", 'Desea eliminar este elemento ?', {
        allowHtml: true,
        onclick: function (toast) {
            value = toast.target.value
            if (value == 'yes') {
                const url = SITEURL + '/clientes/' + ente_id
                fetch(url, {
                        method: 'DELETE',
                        mode: "cors",
                        headers: {
                            accept: "application/json",
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    })
                    .then(response => {
                        if (response.ok) {
                            response.text().then(success => {
                                dtClientes.draw();
                                toastr.remove()
                                toastr.info('Success:', success);
                            });
                        } else {
                            response.text().then(error => {
                                toastr.remove()
                                // toastr.error('Error:', error);
                                console.log('request failed', error);

                            })
                        }
                    })
                    .catch(error => {
                        console.log('request failed', error);
                    });
            } else {
                toastr.remove()
            }
        }
    });
}

