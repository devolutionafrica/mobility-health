<?php use Illuminate\Support\Facades\URL; ?>


<?php $__env->startSection('title', $insurancePolicy->name); ?>

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
    <?php
    $page = \Illuminate\Support\Facades\Request::query('page','package')
    ?>
    <div class="row">
        <div class="col-auto">
            <a href="<?php echo e(route("insurance_policies.index")); ?>" class="btn btn-icon btn-label-primary">
                <i class="ti ti-chevron-left fs-xlarge"></i>
            </a>
        </div>
        <div class="col">
            <div class="d-flex flex-column flex-sm-row align-items-center justify-content-sm-between mb-6 text-center text-sm-start gap-2">
                <div class=" mb-sm-0">
                    <h4 class="mb-1">
                        <?php echo e($insurancePolicy->name); ?>

                    </h4>
                </div>
                <div class="">
                    <a href="<?php echo e(route("insurance_policies.edit", ["insurancePolicy" => $insurancePolicy->id])); ?>"
                       class="btn btn-secondary">
                      Editer
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Customer-detail Sidebar -->
        <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
            <!-- Customer-detail Card -->
            <div class="card mb-6">
                <div class="card-body pt-12">
                    <div class="customer-avatar-section">
                        <div class="d-flex align-items-center flex-column">
                            <img class="img-fluid rounded-sm mb-4"
                                 style="max-width: 100%;"
                                 src="<?php echo e(urlGen(src:route("image.indexUrl",["path"=>$insurancePolicy->miniature->path]),width: 360,height: 360,fit: "contain")); ?>"
                                  alt="<?php echo e($insurancePolicy->name); ?>" />

                        </div>
                    </div>
                    <div class="info-container px-1">
                        <h5 class="text-capitalize mt-2">
                            <?php echo e($insurancePolicy->name); ?>

                        </h5>
                        <p>
                            <?php echo e($insurancePolicy->summary); ?>

                        </p>
                    </div>
                    <div class="my-4 row flex-column gap-2">
                        <a href="<?php echo e(route("insurance_policies.show", ["insurancePolicy" => $insurancePolicy->id])); ?>"
                            class="<?php echo \Illuminate\Support\Arr::toCssClasses(['d-block text-dark text-center fw-semibold border rounded py-3 px-4','btn-label-primary'=>$page!="description"]); ?>">
                            Tarification
                        </a>
                        <a href="<?php echo e(route("insurance_policies.show", ["insurancePolicy" => $insurancePolicy->id,'page'=>'description'])); ?>"
                            class="<?php echo \Illuminate\Support\Arr::toCssClasses(['d-block text-dark text-center fw-semibold border rounded py-3 px-4','btn-label-primary'=>$page=="description"]); ?>">
                            Description complète
                        </a>
                    </div>
                    <?php if($insurancePolicy->fileAttach->isNotEmpty()): ?>
                        <div class="info-container">
                            <h5 class="text-capitalize mt-6">
                                Piéces jointes
                            </h5>
                            <div class="">
                                <?php $__currentLoopData = $insurancePolicy->fileAttach; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="row py-3 px-1 border-bottom">
                                        <div class="col-auto">
                                            <i class="ti ti-file"></i>
                                        </div>
                                        <div class="col">
                                            <a href="/storage/<?php echo e($file->path); ?>" target="_blank"><?php echo e($file->name); ?></a>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>

                    <?php endif; ?>

                </div>
            </div>
            <!-- /Customer-detail Card -->
        </div>
        <!--/ Customer Sidebar -->


        <!-- Customer Content -->
        <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
            <?php if($page!="description"): ?>
                <div class="card mb-6">
                    <div class="card-header border-bottom">
                        <h5 class="card-title mb-0">
                            Tarifications
                        </h5>
                    </div>
                    <div class="card-datatable table-responsive">
                        <table class="mh-datatable table"
                               data-location="<?php echo e(\Illuminate\Support\Facades\URL::current()); ?>"
                               data-create="<?php echo e(route("package.create",["insurancePolicy"=>$insurancePolicy->id])); ?>"
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
            <?php else: ?>
                <div class="row text-nowrap">
                    <div class="col-md-12 mb-6">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="card-info">
                                    <h5 class="card-title mb-2 border-bottom">
                                        Description
                                    </h5>
                                    <div class="w-100 text-wrap">
                                        <?php echo $insurancePolicy->description; ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <!--/ Customer Content -->
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/layoutMaster', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u438288564/domains/ibemscreative.in/public_html/mobility/resources/views/pages/insurance-policies/show.blade.php ENDPATH**/ ?>