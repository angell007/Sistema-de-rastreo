<?php $__env->startSection('content'); ?>

<div class="ml-auto d-flex align-items-center secondary-menu text-center m-2">

    <a href="javascript:history.back()" class="tooltip-wrapper" data-toggle="tooltip" data-placement="top" title=""
        data-original-title="Regresar">
        <i class="fa fa-reply btn btn-icon text-primary"></i>
    </a>

    <div class="card-header bg-transparent">
        <h3 class="mb-0"><?php echo e('Detalles de Orden Nº : '. $order->consecutivo); ?></h3>
    </div>

</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card card-statistics">
            <div class="card-body">
                <div class="export-table-wrapper table-responsive">
                    <table class="table table-bordered dT display" style="color:black" id="dataTAbleClienteShow"
                        width="100%" cellspacing="0">
                        <thead class="thead">
                            <tr>
                                <th>Fecha Ingreso</th>
                                <th>Referencia</th>
                                <th>Serial</th>
                                <th>Nº Orden</th>
                                <th>Estado</th>
                                <th>Diagnostico</th>
                                <th>Observacion</th>
                            </tr>
                        <tbody>
                            <tr>
                                <th><?php echo e($order->fecha_ingreso); ?></th>
                                <th><?php echo e($order->referencia); ?></th>
                                <th><?php echo e($order->serial); ?></th>
                                <th><?php echo e($order->consecutivo); ?></th>
                                <th><?php echo e($order->estado); ?></th>
                                <th><?php echo e($order->diagnostico); ?></th>
                                <th><?php echo e($order->observaciones); ?></th>
                            </tr>
                        </tbody>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card card-statistics">
            <div class="card-body">
                <div class="export-table-wrapper table-responsive">
                    <table class="table table-bordered dT" style="color:black" id="dataTableHistoria" width="100%"
                        cellspacing="0">
                        <thead class="thead">
                            <tr>
                                <th>S. No</th>
                                <th>Responsable</th>
                                <th width="350px">Accion</th>
                                <th>Estado</th>
                                <th>Fecha Ingreso</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script>
    var orden = <?php echo json_encode($order->id, 15, 512) ?>;
    dtHistoria = $('#dataTAbleClienteShow').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth: false,
        stateSave: true,
    });

</script>
<script src="<?php echo e(asset('/apis/apiSeguimientos.js')); ?>"></script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\SRastreo\resources\views/admin/seguimientos/show.blade.php ENDPATH**/ ?>