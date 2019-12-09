<ul class="navbar-nav align-items-center d-none d-md-flex">
    <li class="nav-item dropdown">
        <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
                    <img src="<?php echo e(asset('/img/logo.png')); ?>" class="navbar-brand-img" alt="Logo">
                </span>
                <div class="media-body ml-2 d-none d-lg-block">
                    <span class="mb-0 text-sm  font-weight-bold"><?php echo e(Auth::user()->name); ?></span>
                </div>
            </div>
        </a>
        <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
            <div class=" dropdown-header noti-title">
                <h6 class="text-overflow m-0">Welcome!</h6>
            </div>

            <!-- Authentication Links -->
            <?php if(auth()->guard()->guest()): ?>
            <a class="nav-link" href="<?php echo e(route('login')); ?>"><?php echo e(__('Login')); ?>

                <i class="ni ni-single-02"></i>
                <span>My profile</span>
            </a>
            <?php if(Route::has('register')): ?>
            <a class="nav-link" href="<?php echo e(route('register')); ?>">
                <i class="ni ni-single-02"></i>
                <span>My profile</span>
                <?php echo e(__('Register')); ?></a>
            <?php endif; ?>
            <?php else: ?>
            <?php endif; ?>

            <div class="dropdown-divider"></div>
            <a href="<?php echo e(route('logout')); ?>" class="dropdown-item" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
                <i class="ni ni-user-run"></i>
                <span>Logout</span>
            </a>

            <form action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                <?php echo csrf_field(); ?>
            </form>

        </div>
    </li>
</ul>
<?php /**PATH C:\laragon\www\SRastreo\resources\views/layouts/nav.blade.php ENDPATH**/ ?>