<div class="modal fade mt-5" tabindex="-1" role="dialog" data-backdrop="static" data-ajax-modal
    id="modalEquipoRegister">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content ">

            <div class="card-header text-dark">Registrar Orden
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="card-body">

                <form id="formEquipoRegister" method="POST" action="{{route('orders.store')}}">
                    @csrf
                    <div class="modal-body">
                        <div class="row">

                            <div class="form-group col-md-6">
                                <label class="text-dark">Tecnico asignado</label>
                                <select class="selectpicker" style="width: 100%" required="required" name="user_id" id="user_id">
                                    @foreach ($tecnicos as $tecnico)
                                    <option value="{{$tecnico->id}}">{{$tecnico->fullname}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark">Propietrio</label>
                                <select class="selectpicker" style="width: 100%" required="required" data-live-search="true"
                                    name="cliente_id" id="cliente_id">
                                    @foreach ($clientes as $cliente)
                                    <option value="{{$cliente->id}}">{{$cliente->fullname}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark">Referencia de equipo </label>
                                <input type="text" class="form-control" id="referencia" required="required"
                                    name="referencia" placeholder="referencia ...">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark">Serial de equipo </label>
                                <input type="text" class="form-control" id="serial" required="required" name="serial"
                                    placeholder="serial ...">
                            </div>

                            <div class="form-group col-md-6">
                                @forelse ($acciones as $accion)
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" costo="{{$accion->valor}}"
                                        id="{{$accion->id}}" onclick="sumar()" name="accion_id[{{$accion->nombre}}]">
                                    <label class="custom-control-label m-2"
                                        for="{{$accion->id}}">{{$accion->nombre}}</label>
                                </div>
                                @empty

                                <p class="text-dark"> Registre acciones a aplicar </p>

                                @endforelse

                            </div>


                            <div class="form-group col-md-6">
                                <label class="text-dark">Estado</label>
                                <select class="form-control" style="width: 100%" required="required" name="estado" id="estado">
                                    <option value="En proceso">En proceso</option>
                                    <option value="Listo para entregar">Listo para entregar</option>
                                    <option value="Entregado">Entregado</option>
                                </select>
                            </div>

                            <div class="form-group col-md-12">
                                <label class="text-dark">Total de orden</label>
                                <input type="text" class="form-control" id="total" required="required" name="total"
                                    placeholder="000">
                            </div>

                            <div class="form-group col-md-12">
                                <label class="text-dark">Observacion</label>
                                <textarea type="text" class="form-control" id="observaciones" name="observaciones"
                                    placeholder="Observacion"></textarea>
                            </div>

                            <div class="form-group col-md-12">
                                <label class="text-dark">Diagnostico</label>
                                <textarea type="text" class="form-control" id="diagnostico" name="diagnostico"
                                    placeholder="Diagnostico"></textarea>
                            </div>

                            <div class="form-group col-md-3">
                                <input type="submit" class="btn btn-outline-info  btn-sm" id="btnSaveEquipo"
                                    value="Enviar">
                                <button type="button" class="btn btn-outline-dark btn-sm"
                                    data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
