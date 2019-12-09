<!DOCTYPE html>

<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Mi sistema')); ?></title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

    <link href="<?php echo e(asset('/css/custom/argon-dashboard.css')); ?>" rel="stylesheet">

    <link href="<?php echo e(asset('css/custom/nucleo.css')); ?>" rel="stylesheet" type="text/css" />

    <link href="<?php echo e(asset('css/datatablecss/dataTables.bootstrap4.min.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('css/datatablecss/responsive.bootstrap.min.css')); ?>" rel="stylesheet" type="text/css" />

    <link href="<?php echo e(asset('css/datatablecss/toastr.min.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('/fontawesome/css/all.min.css')); ?>" rel="stylesheet" type="text/css" />


</head>

<style>
    .table td {
        white-space: nowrap;
        text-overflow: ellipsis;
        word-break: break-all;
        overflow: hidden;
    }

    .table.dataTable.dtr-inline.collapsed>tbody>tr>td.details-control:first-child:before {
        display: none;
    }

    .table.dataTable th,
    .table.dataTable td {
        white-space: normal;
    }

    .child {
        table-layout: fixed color: black
    }

    .child td {
        word-wrap: break-word;
        white-space: normal !important;
    }
</style>

<body class="">

    <?php if(auth()->guard()->check()): ?>
    <?php echo $__env->make('layouts.side', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

    <div class="main-content">
        <!-- Navbar -->
        <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
            <div class="container-fluid">
                <?php if(auth()->guard()->check()): ?>
                <?php echo $__env->make('layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>
            </div>
        </nav>
        <!-- End Navbar -->
        <!-- Header -->
        <div class="header bg-gradient-primary pb-5 pt-5 pt-md-8">
            <div class="container-fluid">
                <div class="header-body">
                </div>
            </div>
        </div>
        <!-- Page content -->

        <div class="container-fluid mt--7">
            <div class="row">
                <div class="col">
                    <div class="card shadow">

                        <?php echo $__env->yieldContent('content'); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo e(asset('js/jquery-3.3.1.js')); ?>"></script>
    <script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/popper.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/datatablejs/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/datatablejs/dataTables.bootstrap4.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/datatablejs/dataTables.responsive.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/toastr.min.js')); ?>"></script>

    <?php echo $__env->yieldContent('scripts'); ?>

</body>

</html>
<?php /**PATH C:\laragon\www\SRastreo\resources\views/layouts/app.blade.php ENDPATH**/ ?>