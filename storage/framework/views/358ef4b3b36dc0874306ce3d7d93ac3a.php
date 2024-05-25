<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($pageTitle); ?></title>
    <?php echo app('Illuminate\Foundation\Vite')('resources/sass/app.scss'); ?>
</head>

<body>

    

    <?php $__env->startSection('content'); ?>
        

        

        <div class="container mt-4">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        
                    </div>
                </div>
            </div>
        </div>

        <div class="p-6 m-20 bg-white rounded shadow">
            <?php echo $chart->container(); ?>

        </div>

        <script src="<?php echo e($chart->cdn()); ?>"></script>
        <?php echo e($chart->script()); ?>

    <?php $__env->stopSection(); ?>

    <?php echo app('Illuminate\Foundation\Vite')('resources/js/app.js'); ?>
</body>

</html>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\modul 10 framework\resources\views/home.blade.php ENDPATH**/ ?>