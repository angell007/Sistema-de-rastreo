var SITEURL = document.location.origin;

var formClausulaRegister = document.getElementById('formClausulaRegister');
formClausulaRegister.addEventListener('submit', ajaxFormRegisterClausulas);

var formClausulaUpdate = document.getElementById('formClausulaUpdate');
formClausulaUpdate.addEventListener('submit', ajaxFormUpdateClausula);

document.addEventListener('DOMContentLoaded', function () {
    $.fn.dataTable.ext.errMode = 'none';

    // datatables settings
    dtClausulas = $('#dataTableClausulas').DataTable({
        processing: true,
        serverSide: true,
        stateSave: true,
        responsive: true,
        autoWidth: false,
        searchable:true,
        orderable:true,

        ajax: SITEURL + "/clausulas/",

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
                data: 'descripcion',
                name: 'descripcion'
            },
            {
                data: 'action',
                name: 'action',
                orderable: true
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
function ajaxFormRegisterClausulas(event) {

    event.preventDefault();

    document.getElementById("btnSaveClausula").value = "Enviando...";

    const dataRegister = new FormData(formClausulaRegister);

    fetch(formClausulaRegister.action, {
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
                    dtClausulas.draw();
                    $('#formClausulaRegister').trigger("reset");
                    $('#modalClausulaRegister').modal('hide');
                })
                document.getElementById("btnSaveClausula").value = "Enviar";
            } else {
                response.json().then(error => {
                    Object.keys(error.errors).forEach(key => {
                        toastr.error('Error', error.errors[key])
                    })
                    // console.log(error);
                });
                document.getElementById("btnSaveClausula").value = "Enviar";
            }
        })
        .catch(error => {
            console.log(error);
        })
}

// Traer datos de Clausula
function editarClausula(ente_id) {
    const url = SITEURL + '/clausulas/' + ente_id + '/edit'
    const formClausulaUpdate = document.getElementById('formClausulaUpdate');
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
                    formClausulaUpdate.id.value = success.id;
                    formClausulaUpdate.nombre.value = success.nombre;
                    formClausulaUpdate.descripcion.value = success.descripcion;
                    $('#modalClausulaUpdate').modal('show')
                });
            }
        })
        .catch(error => {
            console.log('request failed');
        });
};


//Envio de datos ajax a actualizar
function ajaxFormUpdateClausula(event) {
    event.preventDefault();

    const dataUpdate = new FormData(formClausulaUpdate);
    document.getElementById("btnUpdateClausula").value = "Enviando...";

    fetch(formClausulaUpdate.action, {
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
                    dtClausulas.draw();
                    $('#formClausulaUpdate').trigger("reset");
                    $('#modalClausulaUpdate').modal('hide');
                    document.getElementById("btnUpdateClausula").value = "Enviar";
                })
            } else {
                response.json().then(error => {
                    console.log(error);
                    Object.keys(error.errors).forEach(key =>
                        toastr.error('Error', error.errors[key]))
                })

                document.getElementById("btnUpdateClausula").value = "Enviar";
            }
        })
        .catch(error => {
            console.log(error);
        });
}

// Eliminar Clausula
function eliminarClausula(ente_id) {
    toastr.options.preventDuplicates = true;
    toastr.warning("<br /><button class='btn btn-sm btn-danger m-1' type='button' value='yes'>Yes</button> <button class='btn btn-sm btn-dark m-1' type ='button'  value='no' > No </button>", 'Desea eliminar este elemento ?', {
        allowHtml: true,
        onclick: function (toast) {
            value = toast.target.value
            if (value == 'yes') {
                const url = SITEURL + '/clausulas/' + ente_id
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
                                dtClausulas.draw();
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
