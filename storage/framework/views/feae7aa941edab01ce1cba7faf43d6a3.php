<?php $__env->startSection('title', 'Souscription'); ?>

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
            <a href="<?php echo e(route("subscription.index")); ?>" class="btn btn-icon btn-label-primary">
                <i class="ti ti-chevron-left fs-xlarge"></i>
            </a>
        </div>
        <div class="col">
            <div
                class="d-flex flex-column flex-sm-row align-items-center justify-content-sm-between mb-6 text-center text-sm-start gap-2">
                <div class="mb-2 mb-sm-0">
                    <h4 class="mb-1 text-capitalize">
                        <?php echo e($subscription->customer->name); ?>

                    </h4>
                    <p class="mb-0">
                        <?php echo e($subscription->customer->email); ?>

                    </p>
                </div>
                <?php if($subscription->status=="pending"): ?>
                    <div class="d-flex gap-4">
                        <a href="<?php echo e(route("subscription.edit",["action"=>"validate","subscription"=>$subscription->id])); ?>"
                           class="btn btn-label-success">Valider</a>
                        <a href="<?php echo e(route("subscription.edit",["action"=>"reject","subscription"=>$subscription->id])); ?>"
                           class="btn btn-label-danger">Annuler</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- Customer-detail Sidebar -->
        <div class="col-xl-7 col-lg-6 col-md-5 order-1 order-md-0">
            <!-- Customer-detail Card -->
            <div class="card mb-6">
                <div class="card-header">
                    <h4 style="margin-bottom: 0;">Produit d'assistance <?php echo e($subscription->insurancePolicy->name); ?></h4>
                    <span
                        class="text-primary">Tarif <?php echo e($subscription->destination_option == "mono" ? "mono-destination":"multi-destination"); ?></span>
                    <div class="mt-2">
                        <?php echo status(match ($subscription->status) {
                       "validate" => \Illuminate\Support\Carbon::now()->lte($subscription->date_end) ? "En cours" : "Expirer",
                       "pending" => "En attente",
                       "cancel" => "Annuler",
                       "reject" => "Annuler"
                   }, type: match ($subscription->status) {
                       "validate" => \Illuminate\Support\Carbon::now()->lte($subscription->date_end) ? "success" : "danger",
                       "pending" => "secondary",
                       "cancel" => "warning",
                       "reject" => "danger"
                   }); ?>

                    </div>
                </div>
                <?php echo e(\Illuminate\Support\Carbon::now()->diff($subscription->customer->birth_date)->years); ?>

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
                        <strong
                            class="d-block ms-2">
                            <?php echo e($subscription->period["value"].' '.match ($subscription->period["type"]){ "year"=> "an(s)","day"=>"jour(s)" ,default =>"mois"}); ?>

                        </strong>
                    </div>
                    <div class="mb-2">
                        <span class="d-block">Période de couverture</span>
                        <strong class="d-block ms-2 text-primary">
                            <?php if($subscription->status == "validate"): ?>
                                <?php echo e($subscription->date_start->format("d/m/Y") . ' - ' . $subscription->date_end->format("d/m/Y")); ?>

                            <?php else: ?>
                                Indefinie
                            <?php endif; ?>
                        </strong>
                    </div>
                    <div class="mb-2">
                        <span class="d-block">Date d'émission</span>
                        <strong class="d-block ms-2"><?php echo e($subscription->emit_date->format("d/m/Y")); ?></strong>
                    </div>

                    <div class="mb-2">
                        <span class="d-block">Zone géographique</span>
                        <strong class="d-block ms-2"><?php echo e($subscription->geographicArea->name); ?></strong>
                    </div>
                    <div class="mb-2">
                        <span class="d-block">Pays de residence</span>
                        <strong class="d-block ms-2">
                            <img alt="<?php echo e($subscription->residence_id); ?>" style="width: 20px;margin-right: 8px;"
                                 width="20" src="https://flagcdn.com/w320/<?php echo e($subscription->residence_id); ?>.png"/>
                            <?php echo e($subscription->residence->name); ?>

                        </strong>
                    </div>
                    <div class="mb-2">
                        <span class="d-block">Pays de départ</span>
                        <strong class="d-block ms-2">
                            <img alt="<?php echo e($subscription->departure_code); ?>" style="width: 20px;margin-right: 8px;"
                                 width="20" src="https://flagcdn.com/w320/<?php echo e($subscription->departure_code); ?>.png"/>
                            <?php echo e($subscription->departure->name); ?>

                        </strong>
                    </div>
                    <div class="mb-2">
                        <span class="d-block">Pays de destination</span>
                        <strong class="d-block ms-2">
                            <img alt="<?php echo e($subscription->destination_code); ?>" style="width: 20px;margin-right: 8px;"
                                 width="20" src="https://flagcdn.com/w320/<?php echo e($subscription->destination_code); ?>.png"/>
                            <?php echo e($subscription->destination->name); ?>

                        </strong>
                    </div>
                </div>
                <div class="card-footer"></div>
            </div>
            <!-- /Customer-detail Card -->
        </div>

        <div class="col-xl-5 col-lg-6 col-md-5">
            <div class="card mb-6">
                <div class="card-header">
                    <h5 style="margin-bottom: 0;">
                        Photo d'identité
                    </h5>
                    <div class="p-2  mb-4">
                        <div class="bg-body-tertiary">
                            <img style="width: 124px;height: 132px"
                                 src="<?php echo e(urlGen(src: route("image.indexUrl", ["path" => $subscription->customer->avatar?->path]), width: 200, height: 200, fit: "contain")); ?>"
                                 alt="">
                        </div>
                    </div>
                    <h5 style="margin-bottom: 0;">
                        Piéce d'identité
                    </h5>
                    <div class="ms-2">
                        <div class="mb-2">
                            <span class="d-block">Type de piéce</span>
                            <strong
                                class="d-block ms-2">
                                <?php echo e(match ($subscription->customer->document_type){
                                    "travel_document"=>"Titre de voyage",
                                    "visa"=>"Visa",
                                    "cni"=>"Certificat d'identité",
                                    "passport"=>"Passeport"
                                  }); ?>

                            </strong>
                        </div>
                        <div class="mb-2">
                            <span class="d-block">Numéro de la piéce d'identité</span>
                            <strong
                                class="d-block ms-2 text-uppercase"><?php echo e($subscription->customer->document_num); ?></strong>
                        </div>
                    </div>
                    <div class="p-2">
                        <div class="bg-body-tertiary">
                            <img
                                src="<?php echo e(urlGen(src: route("image.indexUrl", ["path" => $subscription->customer->documentRecto?->path]), width: 300, height: 300, fit: "contain")); ?>"
                                alt="">
                        </div>
                    </div>
                </div>
                <div class="card-body  px-lg-12">
                </div>
                <div class="card-footer"></div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-12">
            <div class="card mb-6">
                <div class="card-header">
                    <h4 style="margin-bottom: 0;">
                        Dossier de santé
                    </h4>
                </div>

                <fieldset readonly="" class="card-body  px-lg-12">
                    <?php $__currentLoopData = array_merge($subscription->customer->medicalIssues->response,$subscription->customer->healthRecord->response); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="mb-4">
                            <h4 class="mb-2"><?php echo e($item["title"]); ?></h4>
                            <div class="ms-4">
                                <?php $__currentLoopData = $item["questions"]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($_item["type"]=="option"): ?>
                                        <div class="mb-2">
                                                <?php $option = $_item["option"]; ?>
                                            <h6 class="mb-1"><?php echo e($option["label"]); ?></h6>
                                            <div class="ms-2">
                                                <div class="d-flex gap-2">
                                                    <?php $__currentLoopData = $option["response"]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $__item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div>
                                                            <input readonly class="form-check-input"
                                                                   type="radio" <?php if($__item["value"] == "1"): echo 'checked'; endif; ?>>
                                                            <?php echo e($__item["label"]); ?>

                                                        </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                                <div class="mt-2 ms-2">
                                                    <?php $__currentLoopData = $option["response"]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $__item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div>
                                                            <?php if($__item["value"] == "1"): ?>
                                                                <?php $__currentLoopData = $__item["result"] ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $___item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php if($__item["type"] == "option"): ?>
                                                                        <div>
                                                                            <input readonly class="form-check-input"
                                                                                   type="checkbox" <?php if($___item["value"] == "1"): echo 'checked'; endif; ?>>
                                                                            <span class="<?php echo \Illuminate\Support\Arr::toCssClasses(["text-primary"=>$___item["value"] == "1"]); ?>"><?php echo e($___item["label"]); ?></span>
                                                                        </div>
                                                                    <?php else: ?>
                                                                        <span><?php echo e($___item["label"]); ?>: </span>
                                                                        <strong
                                                                            class="text-primary"><?php echo e($___item["value"]); ?></strong>
                                                                    <?php endif; ?>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php endif; ?>
                                                        </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>

                                            </div>
                                        </div>
                                    <?php elseif($_item["type"]=="multiple"): ?>
                                        <div class="mb-2">
                                                <?php $multiple = $_item["multiple"]; ?>
                                            <h6 class="mb-1"><?php echo e($multiple["label"]); ?></h6>
                                            <?php $__currentLoopData = $multiple["response"]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $__item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="py-1">
                                                    <input class="form-check-input" readonly
                                                           type="checkbox" <?php if($__item["value"] == "1"): echo 'checked'; endif; ?>>
                                                    <?php echo e($__item["label"]); ?>

                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        </div>
                                    <?php else: ?>
                                        <div class="mb-2">
                                                <?php $text = $_item["text"]; ?>
                                            <h6 class="mb-1"><?php echo e($text["label"]); ?></h6>
                                            <span><?php echo e($text["value"] ?? ""); ?></span>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </fieldset>
                <div class="card-footer"></div>
            </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/layoutMaster', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u438288564/domains/ibemscreative.in/public_html/mobility/resources/views/pages/subscriptions/subscribe.blade.php ENDPATH**/ ?>