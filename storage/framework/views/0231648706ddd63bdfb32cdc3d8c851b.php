<?php $__env->startSection('title', 'Profil client'); ?>

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
    <div class="row align-items-center">
        <div class="col-auto">
            <a href="<?php echo e(route("customer.index",["type"=>$type])); ?>" class="btn btn-icon btn-label-primary">
                <i class="ti ti-chevron-left fs-xlarge"></i>
            </a>
        </div>
        <div class="col">
            <div class="d-flex flex-column flex-sm-row align-items-center justify-content-sm-between mb-6 text-center text-sm-start gap-2">
                <div class="mb-2 mb-sm-0">
                    <h4 class="mb-1 text-capitalize">
                        <?php echo e($customer->name); ?>

                    </h4>
                    <p class="mb-0">
                        <?php echo e($customer->email); ?>

                    </p>
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
                            <img class="img-fluid rounded mb-4"
                                 style="width: 124px;height: 124px;"
                                 src="<?php echo e($customer->avatar == null ? "/storage/fake/user.png" : urlGen(src: route("image.indexUrl", ["path" => $customer->avatar?->path]), width: 200, height: 200, fit: "contain")); ?>"
                                 height="120" width="120" alt="User avatar" />
                            <div class="customer-info text-center mb-6">
                                <h5 class="mb-0 text-uppercase"><?php echo e($customer->name); ?></h5>
                                <span><?php echo e($customer->email); ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="info-container">
                        <h5 class="pb-2 border-bottom text-capitalize mt-6 mb-4">Informations</h5>
                        <ul class="list-unstyled mb-6">
                            <li class="mb-2">
                                <span class="h6 me-1">Nom:</span>
                                <span><?php echo e($customer->lastname); ?></span>
                            </li>
                            <li class="mb-2">
                                <span class="h6 me-1">Prénom:</span>
                                <span><?php echo e($customer->firstname); ?></span>
                            </li>
                            <li class="mb-2">
                                <span class="h6 me-1">Date de naissance:</span>
                                <span><?php echo e($customer->birth_date->format("d/m/Y")); ?> ( <?php echo e(\Illuminate\Support\Carbon::now()->diff($customer->birth_date)->years); ?> ans)</span>
                            </li>
                            <li class="mb-2">
                                <span class="h6 me-1">Email:</span>
                                <span><?php echo e($customer->email); ?></span>
                            </li>
                            <li class="mb-2">
                                <span class="h6 me-1">Numéro principal:</span>
                                <span><?php echo is_array($customer->phone_number) ? '<strong>(' . ($customer->phone_number["code"] ?? "+225") . ')</strong> ' . $customer->phone_number["number"] : $customer->phone_number; ?></span>
                            </li>
                            <li class="mb-2">
                                <span class="h6 me-1">Numéro whatsapp:</span>
                                <span><?php echo is_array($customer->phone_number) ? '<strong>(' . ($customer->phone_number["code"] ?? "+225") . ')</strong> ' . $customer->phone_number["number"] : $customer->phone_number; ?></span>
                            </li>

                            <li class="mb-2">
                                <span class="h6 me-1">Nationalité:</span>
                                <span>
                                    <img width="16"  src="https://flagcdn.com/w320/<?php echo e($customer->nationality_id); ?>.png" alt="<?php echo e($customer->nationality_id); ?>">
                                    <span><?php echo e($customer->country->name); ?></span>

                                </span>
                            </li>
                            <li class="mb-2">
                                <span class="h6 me-1">Pays de résidence:</span>
                                <span>
                                     <img width="16"  src="https://flagcdn.com/w320/<?php echo e($customer->country_of_residence_id); ?>.png" alt="<?php echo e($customer->country_of_residence_id); ?>">
                                   <span><?php echo e($customer->residence->name); ?></span>
                                </span>
                            </li>
                           
                          
                        </ul>
                       
                    </div>
                </div>
            </div>
            <!-- /Customer-detail Card -->
        </div>
        <!--/ Customer Sidebar -->


        <!-- Customer Content -->
        <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">

            <!-- / Customer cards -->
           


            <!-- / customer cards -->


            <!-- Invoice table -->
            <div class="card mb-6">
                <div class="card-header border-bottom">
                    <h5 class="card-title mb-0">
                       Historique des souscriptions
                    </h5>
                </div>
                <div class="card-datatable table-responsive mb-4">
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
            <!-- /Invoice table -->
        </div>
        <!--/ Customer Content -->
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/layoutMaster', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u438288564/domains/ibemscreative.in/public_html/mobility/resources/views/pages/customers/show.blade.php ENDPATH**/ ?>