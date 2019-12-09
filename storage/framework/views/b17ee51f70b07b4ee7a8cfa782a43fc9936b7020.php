<div class="modal fade mt-5" tabindex="-1" role="dialog" data-backdrop="static" data-ajax-modal id="modalEquipoUpdate">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content ">

            <div class="card-header text-dark">Actualizar Orden
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="card-body">

                <form id="formEquipoUpdate" method="" action="<?php echo e(route('orders.update')); ?>">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PATCH'); ?>
                    <div class="modal-body">
                        <div class="row">

                            <input type="hidden" name="id" id="id">

                            <div class="form-group col-md-6">
                                <label class="text-dark">Tecnico asignado</label>
                                <select class="form-control" required="required" name="user_id" id="user_id">
                                    <?php $__currentLoopData = $tecnicos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tecnico): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($tecnico->id); ?>"><?php echo e($tecnico->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark">Propietrio</label>
                                <select class="form-control" required="required" name="cliente_id" id="cliente_id">
                                    <?php $__currentLoopData = $clientes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cliente): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($cliente->id); ?>"><?php echo e($cliente->nombre); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                                <?php $__currentLoopData = $acciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $accion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" costo="<?php echo e($accion->valor); ?>"
                                        id="<?php echo e($accion->nombre); ?>" onclick="sumarUp()"
                                        name="accion_id[<?php echo e($accion->nombre); ?>]">
                                    <label class="custom-control-label m-2"
                                        for="<?php echo e($accion->nombre); ?>"><?php echo e($accion->nombre); ?></label>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark">Estado</label>
                                <select class="form-control" required="required" name="estado" id="estado">
                                    <option value="En proceso">En proceso</option>
                                    <option value="Listo para entregar">Listo para entregar</option>
                                    <option value="Entregado">Entregado</option>
                                </select>
                            </div>

                            <div class="form-group col-md-12">
                                <label class="text-dark">Total de orden</label>
                                <input type="text" class="form-control" id="totalUp" required="required" name="total"
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
                                <input type="submit" class="btn btn-outline-info btn-sm" id="btnUpdateEquipo"
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
<?php /**PATH C:\laragon\www\SRastreo\resources\views/admin/orders/partials/formUpdate.blade.php ENDPATH**/ ?>