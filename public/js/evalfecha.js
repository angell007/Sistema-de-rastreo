function ingresoFecha(pm) {
    if (pm.value === 'Entregado') {
        document.getElementById('bloque_fs').style.display='block';
        document.getElementById("fecha_salida").required = true;

    }else{
        document.getElementById('bloque_fs').style.display='none';
        document.getElementById("fecha_salida").required = false;
        document.getElementById("fecha_salida").value = '';
    }
}
