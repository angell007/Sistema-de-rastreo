@extends('layouts.app')
@section('content')

<div class="ml-auto d-flex align-items-center secondary-menu text-center m-2">

    <a href="javascript:history.back()" class="tooltip-wrapper" data-toggle="tooltip" data-placement="top" title=""
        data-original-title="Regresar">
        <i class="fa fa-reply btn btn-icon text-primary"></i>
    </a>

    <a href="javascript:void(0)" class="tooltip-wrapper" data-toggle="modal" data-placement="top"
        data-target="#modalClienteRegister" title="Registrar">
        <i class="fa fa-edit btn btn-icon text-success"></i>
    </a>

    <div class="card-header bg-transparent">
        <h3 class="mb-0">Clientes</h3>
    </div>


</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card card-statistics">
            <div class="card-body">
                <div class="export-table-wrapper table-responsive">
                    <table class="table table-bordered dT" style="color:black" id="dataTableClientes" width="100%"
                        cellspacing="0">
                        <thead class="thead">
                            <tr>
                                <th>S. No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Direccion</th>
                                <th>Barrio</th>
                                <th>Ciudad</th>
                                <th>Departamento</th>
                                <th>Telefono</th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@include('admin.clientes.partials.formUpdate')
@include('admin.clientes.partials.formRegister')

@stop
@push('scripts')
<script src="{{ asset('/apis/apiClient.js') }}"></script>
@endpush
