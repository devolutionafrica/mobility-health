<?php $__env->startSection('title', 'Edition zone géographique'); ?>

<?php $__env->startSection('vendor-style'); ?>
    <?php echo app('Illuminate\Foundation\Vite')([
      'resources/assets/vendor/libs/select2/select2.scss',
      'resources/assets/vendor/libs/leaflet/leaflet.scss',
      'resources/assets/vendor/libs/dropzone/dropzone.scss',
      'resources/assets/vendor/libs/quill/typography.scss',
      'resources/assets/vendor/libs/quill/katex.scss',
      'resources/assets/vendor/libs/quill/editor.scss',
      'resources/assets/vendor/libs/sweetalert2/sweetalert2.scss',
    ]); ?>
<?php $__env->stopSection(); ?>

<!-- Vendor Scripts -->
<?php $__env->startSection('vendor-script'); ?>
    <?php echo app('Illuminate\Foundation\Vite')([
      'resources/assets/vendor/libs/select2/select2.js',
      'resources/assets/vendor/libs/leaflet/leaflet.js',
      'resources/assets/vendor/libs/dropzone/dropzone.js',
        'resources/assets/vendor/libs/quill/katex.js',
        'resources/assets/vendor/libs/quill/quill.js',
        'resources/assets/vendor/libs/sweetalert2/sweetalert2.js',
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
    <form method="post" id="delete-form" action="<?php echo e(route("geographic_area.delete",["geographicArea"=>$geographicArea->id])); ?>">
        <?php echo csrf_field(); ?>
        <?php echo method_field("DELETE"); ?>
    </form>
    <form class="px-lg-4" action="<?php echo e(route('geographic_area.update',['geographicArea'=>$geographicArea->id])); ?>"
          method="post">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <div class="row align-items-center">
            <div class="col-auto">
                <a href="<?php echo e(route('geographic_area.index')); ?>" class="btn btn-icon btn-label-primary">
                    <i class="ti ti-chevron-left fs-xlarge"></i>
                </a>
            </div>
            <div class="col">
                <div
                    class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">

                    <div class="d-flex flex-column justify-content-center">
                        <h4 class="mb-1">Editer</h4>
                        <p class="mb-0">
                            Mise à jour de la zone géographique
                        </p>
                    </div>
                    <div class="d-flex align-content-center flex-wrap gap-4">
                        <button type="submit" class="btn btn-primary" name="btn" value="once">Enrégistrer</button>
                        <button type="button" data-target="delete-form" class="btn btn-danger delete-item" >Supprimer</button>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <!-- First column-->
            <div class="col-12 col-lg-7">
                <!-- Product Information -->
                <div class="card mb-6">
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-xl-7">
                                <label class="form-label" for="title">Nom de cette zone</label>
                                <input
                                    type="text" required
                                    class="form-control"
                                    id="title"
                                    placeholder="Afr.Ouest - Centre"
                                    name="name"
                                    value="<?php echo e(old('title',$geographicArea->name)); ?>"
                                    class="<?php echo \Illuminate\Support\Arr::toCssClasses(["form-control","is-invalid"=>$errors->has('title')]); ?>"
                                    aria-label="title">
                                <?php $__errorArgs = ['title'];
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
                        </div>
                        <div class="mb-4">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label" for="country_id">
                                        Liste des pays de la zone géographique
                                    </label>
                                    <div class="select2-primary">
                                        <select multiple id="country_id" name="countries[]" class="select2 form-select">
                                            <?php $__currentLoopData = \App\Models\Country::query()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option
                                                    <?php if(in_array($item->id,old("countries",$geographicArea->countries->pluck('id')->toArray()))): echo 'selected'; endif; ?>
                                                    value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <?php $__errorArgs = ['country_id'];
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Second column -->
        </div>
    </form>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/layoutMaster', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u438288564/domains/ibemscreative.in/public_html/mobility/resources/views/pages/geographic-area/edit.blade.php ENDPATH**/ ?>