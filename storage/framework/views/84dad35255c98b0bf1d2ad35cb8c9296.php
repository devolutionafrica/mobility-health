<?php use Illuminate\Support\Facades\URL; ?>


<?php $__env->startSection('title', 'Formules'); ?>

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
    <div class="row align-items-center justify-content-between mb-4">
        <div class="col">
            <div
                class="d-flex flex-column flex-sm-row align-items-center justify-content-sm-between mb-6 text-center text-sm-start gap-2">
                <div class="mb-2 mb-sm-0">
                    <h4 class="mb-1">
                        Formules
                    </h4>
                </div>
            </div>
        </div>
        <div class="col-auto">
            <a href="<?php echo e(route("insurance_policies.create")); ?>" class="btn btn-primary">
                <i class="ti ti-plus"></i>
                <span class="d-inline-block ms-2">Nouveau</span>
            </a>
        </div>
    </div>
    <div class="row">
        <?php $__currentLoopData = $insurancePolicies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $insurancePolicy): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-3 order-1 order-md-0">
                <div class="card mb-6 overflow-hidden">
                    <div class="card-body p-0">
                        <div class="customer-avatar-section">
                            <div class="d-flex align-items-center flex-column">
                                <div class="" style="width: 100%; height:224px;">
                                    <img class="img-fluid mb-4 w-100 h-100"
                                         src="<?php echo e(urlGen(src:route("image.indexUrl",["path"=>$insurancePolicy->miniature->path]),width: 300,height: 300,fit: "contain")); ?>"
                                         alt="<?php echo e($insurancePolicy->name); ?>"/>
                                </div>
                                <div class="customer-info px-3 text-start mb-2">
                                    <h5 class="mb-0 py-2">
                                        <?php echo e($insurancePolicy->name); ?>

                                    </h5>
                                    <p>
                                        <?php echo e($insurancePolicy->summary); ?>

                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="info-container p-2 border-top">
                            <div class="d-flex justify-content-center">
                                <a href="<?php echo e(route("insurance_policies.show",["insurancePolicy"=>$insurancePolicy->id])); ?>"
                                   class="btn btn-text-primary w-100 text-uppercase">Détail</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Customer-detail Card -->
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/layoutMaster', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u438288564/domains/ibemscreative.in/public_html/mobility/resources/views/pages/insurance-policies/index.blade.php ENDPATH**/ ?>