<div class="text-lg-right text-nowrap">

    <a class="btn btn-primary" href="<?php echo e(route('users.show', $id)); ?>">
        <i class="fa fa-fw fa-eye"></i>
    </a>

    <a class="btn btn-xs btn-icon btn-danger delete-usser" href="javascript:void(0)" onclick="eliminarUser(<?php echo e($id); ?>)"
        data-toggle="tooltip" title="Eliminar">
        <i class="fa fa-fw fa-trash"></i>
    </a>

</div>
<?php /**PATH C:\laragon\www\SRastreo\resources\views/admin/users/actions.blade.php ENDPATH**/ ?>