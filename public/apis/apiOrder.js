var SITEURL = document.location.origin;
var formEquipoRegister = document.getElementById('formEquipoRegister');
formEquipoRegister.addEventListener('submit', ajaxFormRegisterEquipos);

var formEquipoUpdate = document.getElementById('formEquipoUpdate');
formEquipoUpdate.addEventListener('submit', ajaxFormUpdateEquipo);

document.addEventListener('DOMContentLoaded', function () {
    $.fn.dataTable.ext.errMode = 'none';
    document.getElementById('box').style.display = 'none';

    $.extend($.fn.dataTable.defaults, {
        responsive: true
    });

    // datatables settings
    dtEquipos = $('#dataTableEquipos').DataTable({

        processing: true,
        serverSide: true,
        // stateSave: true,
        // autoWidth: false,

        lengthMenu: [
            [20, 50, 70, 120],
            [20, 50, 70, 120]
        ],

        ajax: './data',


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

        language: {
            paginate: {
                first: "",
                previous: " ← ",
                next: " → ",
                last: ""
            },
        },
        cache: true, // to load page fast
    });

});



function filtrar() {
    inicio = document.getElementById('min').value;
    fin = document.getElementById('max').value;
    box = document.getElementById('box');

    if (inicio.length == 0 || fin.length == 0) {
        toastr.error('Error', 'Complete los campos')
        box.style.display = 'none';
        dtEquipos.ajax.url(SITEURL + '/orders').load();

    } else {
        document.getElementById('resultTotal').innerHTML = 'Cargando..';
        console.time('Measuring time');
        fetch(SITEURL + '/orders/filter/' + inicio + '/' + fin, {
                method: 'GET',
                mode: "cors",
                headers: {
                    accept: "application/json",
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            })
            .then(response => {
                response.json().then(res => {
                    var suma = 0;
                    let index = 0;
                    data = res.data;

                    for (index; index < data.length; index++) {
                        suma = (parseFloat(data[index].total) + suma)
                    }

                    box.style.display = 'block';
                    document.getElementById('resultTotal').innerHTML = `Ordenes obtenidas ${index}
                    Valor total : $ ${suma.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')} `;
                })
            }).then(() =>
                dtEquipos.ajax.url(SITEURL + '/orders/filter/' + inicio + '/' + fin).load());
        console.timeEnd('Measuring time');
    }
}


//Envio de email ajax
function orderEnviar(ente_id) {
    const url = SITEURL + '/orders/enviar/email/' + ente_id;
    toastr.info('Info', 'Enviando...', {
        timeOut: 150000
    })

    fetch(url, {
            method: 'GET',
            mode: "cors",
            headers: {
                accept: "application/json",
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        .then(response => {
            if (response.ok) {
                response.text().then(success => {
                    toastr.remove()
                    toastr.info('Success', success)
                })
            } else {
                response.json().then(error => {
                    console.log(error);
                });
            }
        })
        .catch(error => {
            console.log(error);
        })
}


//Envio de datos ajax
function ajaxFormRegisterEquipos(event) {

    event.preventDefault();

    document.getElementById("btnSaveEquipo").value = "Enviando...";

    const dataRegister = new FormData(formEquipoRegister);

    fetch(formEquipoRegister.action, {
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
                    // toastr.info('Success', success)
                    console.log(success);

                    dtEquipos.draw();
                    $('#formEquipoRegister').trigger("reset");
                    $('#modalEquipoRegister').modal('hide');
                })
                document.getElementById("btnSaveEquipo").value = "Enviar";
            } else {
                response.json().then(error => {
                    Object.keys(error.errors).forEach(key => {
                        toastr.error('Error', error.errors[key])
                    })
                    // console.log(error);
                });
                document.getElementById("btnSaveEquipo").value = "Enviar";
            }
        })
        .catch(error => {
            console.log(error);
        })
}

// Traer datos de Equipo
function editarEquipo(ente_id) {
    const url = SITEURL + '/orders/' + ente_id + '/edit'
    const formEquipoUpdate = document.getElementById('formEquipoUpdate');
    $('#formEquipoUpdate').trigger("reset");
    fetch(url, {
            method: 'GET',
            mode: "cors",
            headers: {
                accept: "application/json",
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        .then(response => {
            if (response.ok) {
                response.json().then(success => {
                    formEquipoUpdate.id.value = success.order.id;
                    formEquipoUpdate.user_id.value = success.order.user_id;
                    formEquipoUpdate.cliente_id.value = success.order.cliente_id;
                    formEquipoUpdate.referencia.value = success.order.referencia;
                    formEquipoUpdate.serial.value = success.order.serial;
                    formEquipoUpdate.total.value = success.order.total;
                    formEquipoUpdate.fecha_salida.value = success.order.fecha_salida;

                    if (isNaN(success.order.fecha_salida)) {
                        document.getElementById('bloque_fs').style.display = 'block';
                        document.getElementById("fecha_salida").required = true;

                    } else {
                        document.getElementById('bloque_fs').style.display = 'none';
                        document.getElementById("fecha_salida").required = false;
                        document.getElementById("fecha_salida").value = '';
                    }

                    formEquipoUpdate.estado.value = success.order.estado;
                    formEquipoUpdate.observaciones.value = success.order.observaciones;
                    formEquipoUpdate.diagnostico.value = success.order.diagnostico;
                    for (let index = 0; index < success.accions.length; index++) {
                        const element = success.accions[index];
                        formEquipoUpdate.elements[element.nombre].checked = true;
                    }
                    // console.log(success);

                    $('#modalEquipoUpdate').modal('show')
                });
            }
        })
        .catch(error => {
            console.log('request failed');
        });
};


//Envio de datos ajax a actualizar
function ajaxFormUpdateEquipo(event) {
    event.preventDefault();

    const dataUpdate = new FormData(formEquipoUpdate);
    document.getElementById("btnUpdateEquipo").value = "Enviando...";

    fetch(formEquipoUpdate.action, {
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
                    dtEquipos.draw();
                    $('#formEquipoUpdate').trigger("reset");
                    $('#modalEquipoUpdate').modal('hide');
                    document.getElementById("btnUpdateEquipo").value = "Enviar";
                })
            } else {
                response.json().then(error => {
                    console.log(error);
                    Object.keys(error.errors).forEach(key =>
                        toastr.error('Error', error.errors[key]))
                })

                document.getElementById("btnUpdateEquipo").value = "Enviar";
            }
        })
        .catch(error => {
            console.log(error);
        });
}

// Eliminar Equipo
function eliminarEquipo(ente_id) {
    toastr.options.preventDuplicates = true;
    toastr.warning("<br /><button class='btn btn-sm btn-danger m-1' type='button' value='yes'>Yes</button> <button class='btn btn-sm btn-dark m-1' type ='button'  value='no' > No </button>", 'Desea eliminar este elemento ?', {
        allowHtml: true,
        onclick: function (toast) {
            value = toast.target.value
            if (value == 'yes') {
                const url = SITEURL + '/orders/' + ente_id
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
                                dtEquipos.draw();
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
