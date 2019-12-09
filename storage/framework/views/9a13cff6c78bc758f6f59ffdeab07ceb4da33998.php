<?php $__env->startSection('content'); ?>

<div class="ml-auto d-flex align-items-center secondary-menu text-center m-2">

    <a href="javascript:history.back()" class="tooltip-wrapper" data-toggle="tooltip" data-placement="top" title=""
        data-original-title="Regresar">
        <i class="fa fa-reply btn btn-icon text-primary"></i>
    </a>


    <a href="javascript:void(0)" class="tooltip-wrapper" data-toggle="modal" data-placement="top"
        data-target="#modalEquipoRegister" title="Registrar">
        <i class="fa fa-edit btn btn-icon text-success"></i>
    </a>


    <div class="card-header bg-transparent">
        <h3 class="mb-0">Ordenes</h3>
    </div>

</div>

<div class="row">
    <div class="col-lg-12">

        <div class="card card-statistics">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-3">
                        <input type="text" class="form-control" id="min" name="min" placeholder="De:"
                            onfocus="(this.type='date')">
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" id="max" name="max" placeholder="Hasta:"
                            onfocus="(this.type='date')">
                    </div>
                    <div class="col-md-5 ">
                        <button type="submit" onclick="filtrar()" class="btn btn-success">Filtrar</button>
                    </div>
                </div>

                <div class="export-table-wrapper table-responsive">
                    <table class="table table-bordered dT display" style="color:black" id="dataTableEquipos"
                        width="100%" cellspacing="0">

                        <thead class="thead">
                            <tr>
                                <th>S. No</th>
                                <th>Fecha Ingreso</th>
                                <th>Referencia</th>
                                <th>Serial</th>
                                <th>Nº Orden</th>
                                <th>Estado</th>
                                <th>Diagnostico</th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<?php echo $__env->make('admin.orders.partials.formUpdate', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('admin.orders.partials.formRegister', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>

<script src="<?php echo e(asset('/apis/apiOrder.js')); ?>"></script>
<script src="<?php echo e(asset('/js/addvalor.js')); ?>"></script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\SRastreo\resources\views/admin/orders/index.blade.php ENDPATH**/ ?>