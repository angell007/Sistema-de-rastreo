function sumar(){
    obj = document.getElementById('formEquipoRegister');
    totalChecks = obj.length;
    totalSumado = 0;
    for( i=0; i<totalChecks; i++){
        if( obj[i].checked == true ){
            valor = obj[i].getAttribute('costo');
            totalSumado = totalSumado + parseInt(valor);
        }
    }
    document.getElementById('total').value =  totalSumado;
}

function sumarUp(){
    obj = document.getElementById('formEquipoUpdate');
    totalChecks = obj.length;
    totalSumado = 0;
    for( i=0; i<totalChecks; i++){
        if( obj[i].checked == true ){
            valor = obj[i].getAttribute('costo');
            totalSumado = totalSumado + parseInt(valor);
        }
    }
    document.getElementById('totalUp').value =  totalSumado;
}
