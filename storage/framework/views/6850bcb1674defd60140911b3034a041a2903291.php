<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-muted" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main"
            aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"> </span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="<?php echo e(url('/')); ?>">
            <img src="<?php echo e(asset('/img/logo.png')); ?>" class="navbar-brand-img" alt="Logo">
        </a>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                            <img src="<?php echo e(asset('/img/logo.png')); ?>" class="navbar-brand-img" alt="Logo">
                        </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    

                    <div class="dropdown-divider"></div>
                    <a href="<?php echo e(route('logout')); ?>" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>Logout</span>
                    </a>

                    <form action="<?php echo e(route('logout')); ?>" id="logout-form" method="POST" style="display: none;">
                        <?php echo csrf_field(); ?>
                    </form>
                </div>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse"
                            data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false"
                            aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item <?php echo e(!Route::is('/') ?: 'active'); ?>">
                        <a class=" nav-link " href=" <?php echo e(url('/')); ?>"> <i class="ni ni-tv-2 text-primary"></i>
                    Inicio
                    </a>
                </li>
                <li class="nav-item <?php echo e(!Route::is('orders.index') ?: 'active bg-info'); ?>">
                    <a class="nav-link  active " href="<?php echo e(route('orders.index')); ?>">
                        <i class="ni ni-planet text-blue"></i> Ordenes
                    </a>
                </li>

                <li class="nav-item <?php echo e(!Route::is('clientes.index') ?: 'active bg-info'); ?>">
                    <a class="nav-link " href="<?php echo e(route('clientes.index')); ?>">
                        <i class="ni ni-single-02 text-yellow"></i> Clientes
                    </a>
                </li>

                <li class="nav-item <?php echo e(!Route::is('users.index') ?: 'active bg-info'); ?>">
                    <a class="nav-link " href="<?php echo e(route('users.index')); ?>">
                        <i class="ni ni-single-02 text-success"></i> Usuarios
                    </a>
                </li>

                <li class="nav-item <?php echo e(!Route::is('clausulas.index') ?: 'active bg-info'); ?>">
                    <a class="nav-link " href="<?php echo e(route('clausulas.index')); ?>">
                        <i class="ni ni-bullet-list-67 text-red"></i>Clausulas
                    </a>
                </li>

                <li class="nav-item <?php echo e(!Route::is('acciones.index') ?: 'active bg-info'); ?>">
                    <a class="nav-link " href="<?php echo e(route('acciones.index')); ?>">
                        <i class="ni ni-settings-gear-65 text-dark"></i> Configuracion
                    </a>
                </li>

                <li class="nav-item <?php echo e(!Route::is('empresa.index') ?: 'active bg-info'); ?>">
                    <a class="nav-link " href="<?php echo e(route('empresa.index')); ?>">
                        <i class="ni ni-paper-diploma"></i>
                        <?php echo e(config('app.name')); ?>

                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<?php /**PATH C:\laragon\www\SRastreo\resources\views/layouts/side.blade.php ENDPATH**/ ?>