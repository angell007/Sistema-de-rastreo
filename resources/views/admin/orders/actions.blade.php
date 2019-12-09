<div class="text-lg-right text-nowrap">
    <a class="btn btn-xs btn-icon   btn-primary edit-equipo" href="javascript:void(0)" onclick="editarEquipo({{$id}})"
        data-toggle="tooltip" title="Editar">
        <i class="fa fa-edit fa-fw" aria-hidden="true"></i>
    </a>

    <a class="btn btn-xs btn-dark" href="{{route('orders.show', $id)}}" title="Historial">
        <i class="fa fa-fw fa-calendar"></i>
    </a>

    <a class="btn btn-xs btn-warning" href="{{route('orders.printOrder', $id)}}" target="_blank" title="Descargar">
        <i class="fa fa-fw fa-print"></i>
    </a>

    <a class="btn btn-xs btn-success" id="btnOrderEnviar"  onclick="orderEnviar({{$id}})" href="javascript:void(0)" title="enviar">
        <i class="fa fa-paper-plane" aria-hidden="true"></i>

    </a>

    <a class="btn btn-xs btn-icon btn-danger delete-equipo" href="javascript:void(0)" onclick="eliminarEquipo({{$id}})"
        data-toggle="tooltip" title="Eliminar">
        <i class="fa fa-fw fa-trash"></i>
    </a>
</div>
