<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($pageTitle); ?></title> <?php echo app('Illuminate\Foundation\Vite')('resources/sass/app.scss'); ?>
</head>

<body>

    

    <?php $__env->startSection('content'); ?>
        
        <div class="container mt-4">
            <h4><?php echo e($pageTitle); ?></h4>
            <hr>
            <div class="d-flex align-items-center py-2 px-4 bg-light rounded-3 border">
                <div class="bi-house-fill me-3 fs-1"></div>
                <h4 class="mb-0">Well done! this is <?php echo e($pageTitle); ?>.</h4>
            </div>
        </div> <?php echo app('Illuminate\Foundation\Vite')('resources/js/app.js'); ?>
    </body>

    </html>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><?php echo e(__('Dashboard')); ?></div>

                    <div class="card-body">
                        <?php if(session('status')): ?>
                            <div class="alert alert-success" role="alert">
                                <?php echo e(session('status')); ?>

                            </div>
                        <?php endif; ?>

                        <?php echo e(__('You are logged in!')); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\firma\modul_8\resources\views/home.blade.php ENDPATH**/ ?>