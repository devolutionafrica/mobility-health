

<?php $__env->startSection('title', 'Edition'); ?>

<?php $__env->startSection('vendor-style'); ?>
    <?php echo app('Illuminate\Foundation\Vite')([
      'resources/assets/vendor/libs/select2/select2.scss',
      'resources/assets/vendor/libs/leaflet/leaflet.scss',
       'resources/assets/vendor/libs/sweetalert2/sweetalert2.scss',
    ]); ?>
<?php $__env->stopSection(); ?>

<!-- Vendor Scripts -->
<?php $__env->startSection('vendor-script'); ?>
    <?php echo app('Illuminate\Foundation\Vite')([
      'resources/assets/vendor/libs/select2/select2.js',
      'resources/assets/vendor/libs/leaflet/leaflet.js',
      'resources/assets/vendor/libs/sweetalert2/sweetalert2.js',
    ]); ?>
<?php $__env->stopSection(); ?>

<!-- Page Scripts -->
<?php $__env->startSection('page-script'); ?>
    <?php echo app('Illuminate\Foundation\Vite')([
      'resources/js/table/forms-selects.js',
      'resources/js/table/user-position-pick.js',
      'resources/js/table/forms-file-upload.js',
    ]); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <form class="px-lg-4" enctype="multipart/form-data"
          action="<?php echo e(route("subscription.update",["action"=>$action,"subscription"=>$subscription->id])); ?>"
          method="post">
        <?php echo csrf_field(); ?>
        <?php echo method_field("PUT"); ?>

        <div
            class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">

            <div class="row align-items-center">
                <div class="col-auto">
                    <a href="<?php echo e(route("subscription.show",["subscription"=>$subscription->id])); ?>" class="btn btn-icon btn-label-primary">
                        <i class="ti ti-chevron-left fs-xlarge"></i>
                    </a>
                </div>
                <div class="col">
                    <div class="d-flex flex-column justify-content-center">
                        <h4 class="mb-1">
                         <?php echo e($action == "validate" ? "Validation":"Rejet"); ?> de souscription
                        </h4>
                    </div>
                </div>
            </div>

            <div class="d-flex align-content-center flex-wrap gap-4">
                <button type="submit" class="btn btn-primary" name="btn" value="once">Enrégistrer</button>
            </div>

        </div>

        <div class="row">

            <!-- Second column -->
            <div class="col-12 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 style="margin-bottom: 0;">Produit d'assistance <?php echo e($subscription->insurancePolicy->name); ?></h5>
                        <span
                            class="text-primary">Tarification <?php echo e($subscription->destination_option == "mono" ? "mono-destination":"multi-destination"); ?></span>
                        <div class="mb-2">
                            <span class="d-block">Référence</span>
                            <strong class="d-block ms-2 text-uppercase text-black"># <?php echo e($subscription->id); ?></strong>
                        </div>
                        <div class="mb-2 mt-4">
                            <span class="d-block">Durée de la couverture</span>
                            <strong
                                class="d-block ms-2">
                                <?php echo e($subscription->period["value"].' '.match ($subscription->period["type"]){ "year"=> "an(s)","day"=>"jour(s)" ,default =>"mois"}); ?>

                            </strong>

                        </div>
                        <div class="mb-2">
                            <span class="d-block">Estimation de la période de couverture</span>
                            <strong class="d-block ms-2"><?php echo e($subscription->emit_date->format("d/m/Y")); ?> -  <?php echo e(match ($subscription->period["type"]){ "year"=> $subscription->emit_date->addYears(intval($subscription->period["value"]))->format("d/m/Y"),"day"=>$subscription->emit_date->addDays(intval($subscription->period["value"]))->format("d/m/Y") ,default =>$subscription->emit_date->addMonths(intval($subscription->period["value"]))->format("d/m/Y")}); ?></strong>
                        </div>
                        <div class="mb-2">
                            <span class="d-block">Debut de la couverture</span>
                            <strong class="d-block ms-2"><?php echo e($subscription->emit_date->format("d/m/Y")); ?></strong>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <?php if($action=="validate"): ?>
                            <div class="mb-4">
                                <label class="form-label" for="date_start">Changer la date de début de la couverture</label>
                                <input
                                    required type="date"
                                    class="<?php echo \Illuminate\Support\Arr::toCssClasses(["form-control","is-invalid"=>$errors->has('date_start')]); ?>"
                                    id="date_start"
                                    placeholder=""
                                    value="<?php echo e(old('date_start',$subscription->emit_date->format("Y-m-d"))); ?>"
                                    name="date_start"
                                    aria-label="date_start">
                                <?php $__errorArgs = ['date_start'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback">
                                    <?php echo e($message); ?>

                                </div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        <?php else: ?>
                            <div class="mb-4">
                                <label class="form-label" for="status_message">Justification</label>
                                <textarea
                                    rows="4"
                                    required type="date"
                                    class="<?php echo \Illuminate\Support\Arr::toCssClasses(["form-control","is-invalid"=>$errors->has('date_start')]); ?>"
                                    id="status_message"
                                    placeholder=""
                                    name="status_message"
                                    aria-label="status_message"><?php echo e(old('status_message')); ?></textarea>
                                <?php $__errorArgs = ['status_message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback">
                                    <?php echo e($message); ?>

                                </div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/layoutMaster', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u438288564/domains/ibemscreative.in/public_html/mobility/resources/views/pages/subscriptions/edit.blade.php ENDPATH**/ ?>