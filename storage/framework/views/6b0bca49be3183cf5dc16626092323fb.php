<?php $__env->startSection('title', 'Fonctionnalité en cours de développement.'); ?>

<?php $__env->startSection('vendor-style'); ?>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/assets/vendor/libs/apex-charts/apex-charts.scss']); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('vendor-script'); ?>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/assets/vendor/libs/apex-charts/apexcharts.js']); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-script'); ?>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/assets/js/dashboards-crm.js']); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row g-6">
        <div class="col-lg-8">
            <div class="card h-lg-100">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <img style="width: 200px;" src="/logo/mobile-ux.svg" alt="">
                        </div>
                        <div class="col-12 col-lg">
                            <h2>Fonctionnalité en chantier</h2>
                            <h6>Cette fonctionnalité est actuellement en cours d'élaboration.</h6>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/layoutMaster', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u438288564/domains/ibemscreative.in/public_html/mobility/resources/views/pages/dashboard/under_construction.blade.php ENDPATH**/ ?>