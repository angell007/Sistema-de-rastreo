@extends('layouts.app')
@section('content')

<div class="ml-auto d-flex align-items-center secondary-menu text-center m-2">

    <a href="javascript:history.back()" class="tooltip-wrapper" data-toggle="tooltip" data-placement="top" title=""
        data-original-title="Regresar">
        <i class="fa fa-reply btn btn-icon text-primary"></i>
    </a>

    <div class="card-header bg-transparent">
        <h3 class="mb-0">{{$cliente->nombre}}</h3>
    </div>

</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card card-statistics">
            <div class="card-body">
                <div class="export-table-wrapper table-responsive">
                    <table class="table table-bordered dT" style="color:black" id="dataTableOrdersCliente" width="100%"
                        cellspacing="0">
                        <thead class="thead">
                            <tr>
                                <th>S. No</th>
                                <th>Fecha Ingreso</th>
                                <th>Propietario</th>
                                <th>Referencia</th>
                                <th>Estado</th>
                                <th>Diagnostico</th>
                                <th>Acciones</th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<input type="hidden" name="cliente_id" id="cliente_id" value={{$cliente->id}}>

@stop
@push('scripts')
<script src="{{ asset('/apis/apiOrderCliente.js') }}"></script>
@endpush
