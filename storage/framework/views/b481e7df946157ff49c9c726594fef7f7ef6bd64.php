<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Mi sistema')); ?></title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="css/bootstrap.min.css">

    <style>
        body,
        html {
            height: 100%;
        }
    </style>
</head>

<body class="bg-light" style=" background-image: url(img/bg-img/bg-10.png);
                                background-position: center;
                                background-repeat: no-repeat;
                                background-size: contain;
                                background-size: contain;
                                -webkit-background-size: contain;
                                -moz-background-size: contain;
                                -o-background-size: contain;
">

    <nav class="navbar navbar-expand-md navbar-light shadow-sm bg-white" style="background-color:;">
        <div class="container">
            <a class="nav-link pr-0" href="<?php echo e(route('/')); ?>" role="button" aria-haspopup="true" aria-expanded="false">

                <div class="media align-items-center">
                    <span class="avatar avatar-sm rounded-circle">
                        <img src="<?php echo e(asset('/img/logo.png')); ?>" class="img-fluid img-thumbnail " alt="Logo" style=" vertical-align: middle;
                        width: 50px;
                        height: 50px;
                        border-radius: 50%;
                        margin:2px;
                        ">
                    </span>
                </div>

            </a>

            <a class="navbar-brand font-weight-normal font-italic" href="<?php echo e(url('/')); ?>" style=" font-size:1.2em; ">
                <?php echo e(config('app.name')); ?>

            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="<?php echo e(__('Toggle navigation')); ?>">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    <?php if(auth()->guard()->check()): ?>
                    <li class="nav-item">
                        <a class="navbar-brand font-weight-bold font-italic" href="<?php echo e(route('orders.index')); ?>"
                            style=" font-size:1.2em; line-height: 2em">
                            <i class="ni ni-settings-gear-65"></i>
                            <span> Gestión </span>
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    <?php if(auth()->guard()->guest()): ?>
                    <li class="nav-item">
                        <a class="nav-link  font-weight-bold font-italic"
                            href="<?php echo e(route('login')); ?>"><?php echo e(__('Ingresar')); ?></a>
                    </li>
                    <?php if(Route::has('register')): ?>
                    <li class="nav-item">
                        <a class="nav-link  font-weight-bold font-italic"
                            href="<?php echo e(route('register')); ?>"><?php echo e(__('Registrar')); ?></a>
                    </li>
                    <?php endif; ?>
                    <?php else: ?>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle font-weight-bold font-italic " href="#"
                            role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <?php echo e(Auth::user()->name); ?> <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">

                            <div class="dropdown-divider"></div>
                            <a href="<?php echo e(route('logout')); ?>" class="dropdown-item" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                <i class="ni ni-user-run"></i>
                                <span>Salir</span>
                            </a>

                            <form action="<?php echo e(route('logout')); ?>" id="logout-form" method="POST" style="display: none;">
                                <?php echo csrf_field(); ?>
                            </form>
                        </div>

                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>


    <?php if(session('status')): ?>
    <div class="alert alert-danger alert-dismissible fade show " role="alert">
        <strong>Error!</strong> <?php echo e(session('status')); ?>.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php endif; ?>





    <?php echo $__env->yieldContent('content'); ?>



    <!-- jQuery (Necessary for All JavaScript Plugins) -->
    <script src="<?php echo e(asset('/js/jquery-3.3.1.js')); ?>"></script>
    <!-- Popper js -->
    <script src="<?php echo e(asset('/js/popper.min.js')); ?>"></script>
    <!-- Bootstrap js -->
    <script src="<?php echo e(asset('/js/bootstrap.min.js')); ?>"></script>

    <script src="<?php echo e(asset('js/change.js')); ?>"></script>


</body>

</html>
<?php /**PATH C:\laragon\www\SRastreo\resources\views/welcome.blade.php ENDPATH**/ ?>