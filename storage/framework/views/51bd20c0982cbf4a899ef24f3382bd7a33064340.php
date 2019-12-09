<div class="text-lg-right text-nowrap">
    <a class="btn btn-success edit-cliente" href="javascript:void(0)" onclick="editarCliente(<?php echo e($id); ?>)" 
    title="Editar">
        <i class="fa fa-edit"></i>
    </a>

    <a class="btn btn-danger delete-cliente" href="javascript:void(0)" onclick="eliminarCliente(<?php echo e($id); ?>)"
       
    title="Eliminar">
        <i class="fa fa-fw fa-trash"></i>
    </a>

    <a class="btn btn-primary delete-cliente" href="<?php echo e(route('clientes.show', $id)); ?>" 
    title="Datalles">
        <i class="fa fa-fw fa-eye"></i>
    </a>
</div><?php /**PATH C:\laragon\www\SRastreo\resources\views/admin/clientes/actions.blade.php ENDPATH**/ ?>