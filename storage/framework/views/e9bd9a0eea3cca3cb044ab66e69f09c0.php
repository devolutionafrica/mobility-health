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
            <a href="<?php echo e(\Illuminate\Support\Facades\URL::previous()); ?>" class="btn btn-icon btn-label-primary">
                <i class="ti ti-chevron-left fs-xlarge"></i>
            </a>
        </div>
        <div class="col">
            <div class="d-flex flex-column flex-sm-row align-items-center justify-content-sm-between mb-6 text-center text-sm-start gap-2">
                <div class="mb-2 mb-sm-0">
                    <h4 class="mb-1 text-capitalize">
                        <?php echo e($subscription->customer->name); ?>

                    </h4>
                    <p class="mb-0">
                        <?php echo e($subscription->customer->email); ?>

                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- Customer-detail Sidebar -->
        <div class="col-xl-7 col-lg-8 col-md-5 order-1 order-md-0">
            <!-- Customer-detail Card -->
            <div class="card mb-6">
                <div class="card-header">
                   <h4 style="margin-bottom: 0;">Produit d'assistance <?php echo e($subscription->insurancePolicy->name); ?></h4>
                   <span class="text-primary">Tarification <?php echo e($subscription->destination_option == "mono" ? "mono-destination":"multi-destination"); ?></span>
                   <div class="mt-2">
                     <?php echo status(match ($subscription->status) {
                    "validate" => Carbon::now()->lte($subscription->date_end) ? "En cours" : "Expirée",
                    "pending" => "En attente",
                    "cancel" => "Annuler",
                    "reject" => "rejeter"
                }, type: match ($subscription->status) {
                    "validate" =>Carbon::now()->lte($subscription->date_end) ? "success" : "danger",
                    "pending" => "secondary",
                    "cancel" => "warning",
                    "reject" => "danger"
                }); ?>

                   </div>
                </div>
                <div class="card-body  px-lg-12">
                    <div class="mb-2">
                        <span class="d-block">Référence</span>
                        <strong class="d-block ms-2 text-uppercase text-black"># <?php echo e($subscription->id); ?></strong>
                    </div>
                    <div class="mb-2">
                        <span class="d-block">Montant payé</span>
                        <strong class="d-block ms-2"><?php echo e(number_format($subscription->price,0,""," ")); ?>F CFA</strong>
                    </div>
                    <div class="mb-2">
                        <span class="d-block">Durée de la couverture</span>
                        <strong class="d-block ms-2"><?php echo e($subscription->period["value"].' '.$subscription->period["type"]); ?></strong>
                    </div>
                    <div class="mb-2">
                        <span class="d-block">Période de couverture</span>
                        <strong class="d-block ms-2 text-success">
                            <?php if($subscription->status == "validate"): ?>
                                <?php echo e($subscription->date_start->format("d/m/Y") . ' - ' . $subscription->date_end->format("d/m/Y")); ?>

                            <?php else: ?>
                                Indefinie
                            <?php endif; ?>
                        </strong>
                    </div>
                    <div class="mb-2">
                        <span class="d-block">Date d'emission</span>
                        <strong class="d-block ms-2"><?php echo e($subscription->emit_date->format("d/m/Y")); ?></strong>
                    </div>

                    <div class="mb-2">
                        <span class="d-block">Zone géographique</span>
                        <strong class="d-block ms-2"><?php echo e($subscription->geographicArea->name); ?></strong>
                    </div>
                    <div class="mb-2">
                        <span class="d-block">Pays de residence</span>
                        <strong class="d-block ms-2">
                            <img alt="<?php echo e($subscription->residence_id); ?>" style="width: 20px;margin-right: 8px;" width="20" src="https://flagcdn.com/w320/<?php echo e($subscription->residence_id); ?>.png"/>
                            <?php echo e($subscription->residence->name); ?>

                        </strong>
                    </div>
                    <div class="mb-2">
                        <span class="d-block">Pays de départ</span>
                        <strong class="d-block ms-2">
                            <img alt="<?php echo e($subscription->departure_code); ?>" style="width: 20px;margin-right: 8px;" width="20" src="https://flagcdn.com/w320/<?php echo e($subscription->departure_code); ?>.png"/>
                            <?php echo e($subscription->departure->name); ?>

                        </strong>
                    </div>
                    <div class="mb-2">
                        <span class="d-block">Pays de destination</span>
                        <strong class="d-block ms-2">
                            <img alt="<?php echo e($subscription->destination_code); ?>" style="width: 20px;margin-right: 8px;" width="20" src="https://flagcdn.com/w320/<?php echo e($subscription->destination_code); ?>.png"/>
                            <?php echo e($subscription->destination->name); ?>

                        </strong>
                    </div>
                </div>
                <div class="card-footer"></div>
            </div>
            <!-- /Customer-detail Card -->
        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/layoutMaster', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u438288564/domains/ibemscreative.in/public_html/mobility/resources/views/pages/customers/subscribe.blade.php ENDPATH**/ ?>