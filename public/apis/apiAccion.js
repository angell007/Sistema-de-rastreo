var SITEURL = document.location.origin;
var formAccionRegister = document.getElementById('formAccionRegister');
formAccionRegister.addEventListener('submit', ajaxFormRegisterAcciones);

var formAccionUpdate = document.getElementById('formAccionUpdate');
formAccionUpdate.addEventListener('submit', ajaxFormUpdateAccion);

document.addEventListener('DOMContentLoaded', function () {
    $.fn.dataTable.ext.errMode = 'none';

    // datatables settings
    dtAcciones = $('#dataTableAcciones').DataTable({
        processing: true,
        serverSide: true,
        stateSave: true,
        responsive: true,
        autoWidth: false,

        ajax: SITEURL + "/acciones/",

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
                data: 'valor',
                name: 'valor'
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
function ajaxFormRegisterAcciones(event) {

    event.preventDefault();

    document.getElementById("btnSaveAccion").value = "Enviando...";

    const dataRegister = new FormData(formAccionRegister);

    fetch(formAccionRegister.action, {
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
                    dtAcciones.draw();
                    $('#formAccionRegister').trigger("reset");
                    $('#modalAccionRegister').modal('hide');
                })
                document.getElementById("btnSaveAccion").value = "Enviar";
            } else {
                response.json().then(error => {
                    Object.keys(error.errors).forEach(key => {
                        toastr.error('Error', error.errors[key])
                    })
                    // console.log(error);
                });
                document.getElementById("btnSaveAccion").value = "Enviar";
            }
        })
        .catch(error => {
            console.log(error);
        })
}

// Traer datos de accion
function editarAccion(ente_id) {
    const url = SITEURL + '/acciones/' + ente_id + '/edit'
    const formAccionUpdate = document.getElementById('formAccionUpdate');
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
                    formAccionUpdate.id.value = success.id;
                    formAccionUpdate.nombre.value = success.nombre;
                    formAccionUpdate.valor.value = success.valor;
                    formAccionUpdate.descripcion.value = success.descripcion;
                    $('#modalAccionUpdate').modal('show')
                });
            }
        })
        .catch(error => {
            console.log('request failed');
        });
};


//Envio de datos ajax a actualizar
function ajaxFormUpdateAccion(event) {
    event.preventDefault();

    const dataUpdate = new FormData(formAccionUpdate);
    document.getElementById("btnUpdateAccion").value = "Enviando...";

    fetch(formAccionUpdate.action, {
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
                    dtAcciones.draw();
                    $('#formAccionUpdate').trigger("reset");
                    $('#modalAccionUpdate').modal('hide');
                    document.getElementById("btnUpdateAccion").value = "Enviar";
                })
            } else {
                response.json().then(error => {
                    console.log(error);
                    Object.keys(error.errors).forEach(key =>
                        toastr.error('Error', error.errors[key]))
                })

                document.getElementById("btnUpdateAccion").value = "Enviar";
            }
        })
        .catch(error => {
            console.log(error);
        });
}

// Eliminar accion
function eliminarAccion(ente_id) {
    toastr.options.preventDuplicates = true;
    toastr.warning("<br /><button class='btn btn-sm btn-danger m-1' type='button' value='yes'>Yes</button> <button class='btn btn-sm btn-dark m-1' type ='button'  value='no' > No </button>", 'Desea eliminar este elemento ?', {
        allowHtml: true,
        onclick: function (toast) {
            value = toast.target.value
            if (value == 'yes') {
                const url = SITEURL + '/acciones/' + ente_id
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
                                dtAcciones.draw();
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
