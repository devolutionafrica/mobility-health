<?php $__env->startSection('title', $type =="prospects" ? "Prospects":"Clients"); ?>

<!-- Vendor Styles -->
<?php $__env->startSection('vendor-style'); ?>
    <?php echo app('Illuminate\Foundation\Vite')([
      'resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss',
      'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss',
      'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss',
      'resources/assets/vendor/libs/select2/select2.scss',
      'resources/assets/vendor/libs/@form-validation/form-validation.scss',
      'resources/assets/vendor/libs/animate-css/animate.scss',
      'resources/assets/vendor/libs/sweetalert2/sweetalert2.scss'
    ]); ?>
<?php $__env->stopSection(); ?>

<!-- Vendor Scripts -->
<?php $__env->startSection('vendor-script'); ?>
    <?php echo app('Illuminate\Foundation\Vite')([
      'resources/assets/vendor/libs/moment/moment.js',
      'resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js',
      'resources/assets/vendor/libs/select2/select2.js',
      'resources/assets/vendor/libs/@form-validation/popular.js',
      'resources/assets/vendor/libs/@form-validation/bootstrap5.js',
      'resources/assets/vendor/libs/@form-validation/auto-focus.js',
      'resources/assets/vendor/libs/cleavejs/cleave.js',
      'resources/assets/vendor/libs/cleavejs/cleave-phone.js',
      'resources/assets/vendor/libs/sweetalert2/sweetalert2.js'
    ]); ?>
<?php $__env->stopSection(); ?>

<!-- Page Scripts -->
<?php $__env->startSection('page-script'); ?>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/js/table/table-manager.js']); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    
    <!-- Users List Table -->
    <div class="card">
        <div class="card-header border-bottom">
            <h5 class="card-title mb-0">
                <?php if($type =="prospects"): ?>
                    Prospects
                <?php else: ?>
                    Clients
                <?php endif; ?>
            </h5>
        </div>
        <div class="card-datatable table-responsive">

            <table class="mh-datatable table"
                   data-location="<?php echo e(\Illuminate\Support\Facades\URL::current()); ?>"
                   data-config="<?php echo e(json_encode($table["columns"])); ?>">
                <thead class="border-top">

                <tr>
                    <?php $__currentLoopData = $table["fields"]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $col => $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <th style="max-width: <?php echo e($size); ?>"><?php echo e($col); ?></th>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tr>
                </thead>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/layoutMaster', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u438288564/domains/ibemscreative.in/public_html/mobility/resources/views/pages/customers/index.blade.php ENDPATH**/ ?>