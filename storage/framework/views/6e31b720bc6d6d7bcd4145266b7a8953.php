<?php $__env->startSection('title', 'Mise à jour tarification'); ?>

<?php $__env->startSection('vendor-style'); ?>
    <?php echo app('Illuminate\Foundation\Vite')([
      'resources/assets/vendor/libs/select2/select2.scss',
      'resources/assets/vendor/libs/leaflet/leaflet.scss',
      'resources/assets/vendor/libs/dropzone/dropzone.scss',
      'resources/assets/vendor/libs/quill/typography.scss',
      'resources/assets/vendor/libs/quill/katex.scss',
      'resources/assets/vendor/libs/quill/editor.scss'
    ]); ?>
<?php $__env->stopSection(); ?>

<!-- Vendor Scripts -->
<?php $__env->startSection('vendor-script'); ?>
    <?php echo app('Illuminate\Foundation\Vite')([
      'resources/assets/vendor/libs/select2/select2.js',
      'resources/assets/vendor/libs/leaflet/leaflet.js',
      'resources/assets/vendor/libs/dropzone/dropzone.js',
        'resources/assets/vendor/libs/quill/katex.js',
        'resources/assets/vendor/libs/quill/quill.js'
    ]); ?>
<?php $__env->stopSection(); ?>

<!-- Page Scripts -->
<?php $__env->startSection('page-script'); ?>
    <?php echo app('Illuminate\Foundation\Vite')([
      'resources/assets/js/forms-selects.js',
      'resources/js/table/user-position-pick.js',
      'resources/js/table/forms-file-upload.js',
      'resources/js/table/forms-editors.js',
    ]); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <form class="px-lg-4"
          action="<?php echo e(route('package.update',['package'=>$package->id])); ?>"
          method="post">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <div class="row align-items-center">
            <div class="col-auto">
                <a href="<?php echo e(route('insurance_policies.show',['insurancePolicy'=>$package->insurancePolicy->id])); ?>"
                   class="btn btn-icon btn-label-primary">
                    <i class="ti ti-chevron-left fs-xlarge"></i>
                </a>
            </div>
            <div class="col">
                <div
                    class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">

                    <div class="d-flex flex-column justify-content-center">
                        <h4 class="mb-1">Edition</h4>
                        <p class="mb-0">
                            Mise à jour de la tarification
                        </p>
                    </div>
                    <div class="d-flex align-content-center flex-wrap gap-4">
                        <button type="submit" class="btn btn-primary" name="btn" value="once">Enrégistrer</button>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-12">
                <!-- /Second column -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="mb-4">
                            <div class="form-check form-check-inline mt-4">
                                <input class="form-check-input" <?php if($package->type == "multi"): echo 'checked'; endif; ?> type="radio"
                                       name="type" id="multi" value="multi"/>
                                <label class="form-check-label" for="multi">Multi-destination</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" <?php if($package->type == "mono"): echo 'checked'; endif; ?> type="radio"
                                       name="type" id="mono" value="mono"/>
                                <label class="form-check-label" for="mono">Mono-destination</label>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-xl-4">
                                <label class="form-label" for="geographic_area_id">Zone géographique</label>
                                <select id="geographic_area_id"
                                        name="geographic_area_id"
                                        class="select2 form-select">
                                    <?php $__currentLoopData = \App\Models\GeographicArea::query()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $geographicArea): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option
                                            <?php if(old("geographic_area_id",$package->geographic_area_id) == $geographicArea->id): echo 'selected'; endif; ?>
                                            value="<?php echo e($geographicArea->id); ?>"><?php echo e(__($geographicArea->name)); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="price">Montant</label>
                            <input
                                required type="number"
                                class="<?php echo \Illuminate\Support\Arr::toCssClasses(["form-control","is-invalid"=>$errors->has('price')]); ?>"
                                id="price"
                                placeholder="0,00" min="0"
                                value="<?php echo e(old('price',$package->price)); ?>"
                                name="price" aria-label="price">
                            <?php $__errorArgs = ['price'];
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
                        <div class="row mb-6">
                            <div class="col">
                                <label class="form-label" for="validity_period_type">Unité périodique</label>
                                <select
                                    id="validity_period_type"
                                    name="validity_period_type"
                                    class="select2 form-select">
                                    <?php $__currentLoopData = ["day","month","year"]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option
                                            <?php if(old("validity_period_type",$package->validity_period_type) == $type): echo 'selected'; endif; ?>
                                            value="<?php echo e($type); ?>"><?php echo e(__($type)); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="col-xl-4">
                                <label class="form-label" for="validity_period_value">Période</label>
                                <select id="validity_period_value"
                                        data-search="false"
                                        name="validity_period_value"
                                        class="select2 form-select">
                                    <?php for($i=1;$i<31;$i++): ?>
                                        <option
                                            <?php if(old("validity_period_value",$package->validity_period_value) == $i): echo 'selected'; endif; ?>
                                            value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>
                        <div class="">
                            <label class="switch switch-primary">
                                <input type="checkbox" name="status"
                                       class="switch-input" <?php if(old("status",$package->status) == "active"): echo 'checked'; endif; ?> />
                                <span class="switch-toggle-slider">
                                    <span class="switch-on">
                                      <i class="ti ti-check"></i>
                                    </span>
                                    <span class="switch-off">
                                      <i class="ti ti-x"></i>
                                    </span>
                                  </span>
                                <span class="switch-label">Statut</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/layoutMaster', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u438288564/domains/ibemscreative.in/public_html/mobility/resources/views/pages/insurance-policies/package/edit.blade.php ENDPATH**/ ?>