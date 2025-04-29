<?php use Illuminate\Support\Facades\URL; ?>


<?php $__env->startSection('title', 'Edition groupe'); ?>

<?php $__env->startSection('vendor-style'); ?>
    <?php echo app('Illuminate\Foundation\Vite')([
      'resources/assets/vendor/libs/select2/select2.scss',
      'resources/assets/vendor/libs/leaflet/leaflet.scss',
      'resources/assets/vendor/libs/tagify/tagify.scss',
    ]); ?>
<?php $__env->stopSection(); ?>

<!-- Vendor Scripts -->
<?php $__env->startSection('vendor-script'); ?>
    <?php echo app('Illuminate\Foundation\Vite')([
      'resources/assets/vendor/libs/select2/select2.js',
      'resources/assets/vendor/libs/leaflet/leaflet.js',
      'resources/assets/vendor/libs/tagify/tagify.js',
    ]); ?>
<?php $__env->stopSection(); ?>

<!-- Page Scripts -->
<?php $__env->startSection('page-script'); ?>
    <?php echo app('Illuminate\Foundation\Vite')([
      'resources/assets/js/forms-selects.js',
      'resources/js/table/user-position-pick.js',
      'resources/js/table/forms-tagify.js',
    ]); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <form class="px-lg-4"
          action="<?php echo e(route("questionGroup.update",["questionGroup"=>$questionGroup->id])); ?>"
          method="post">
        <?php echo csrf_field(); ?>
        <?php echo method_field("PUT"); ?>
        <?php $id=\Illuminate\Support\Facades\Request::query("id") ?>
        <div class="row align-items-center">
            <div class="col-auto">
                <a href="<?php echo e($id == null ? route("question.create") : route("question.edit",['question'=>$id])); ?>" class="btn btn-icon btn-label-primary">
                    <i class="ti ti-chevron-left fs-xlarge"></i>
                </a>
            </div>
            <div class="col">
                <div
                    class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">

                    <div class="d-flex flex-column justify-content-center">
                        <h4 class="mb-1">Edition</h4>
                        <p class="mb-0">
                            Mise à jour du groupe
                        </p>
                    </div>
                    <div class="d-flex align-content-center flex-wrap gap-4">
                        <button type="submit" class="btn btn-primary" name="btn" value="once">Enrégistrer</button>
                    </div>

                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <label class="form-label" for="page-index">Type de question</label>
                                <select id="page-index"
                                        name="question_type"
                                        class="select2 form-select">
                                    <?php $__currentLoopData = [\App\Models\Enums\QuestionType::Complementary,\App\Models\Enums\QuestionType::Register]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option
                                            <?php if($item->value == $questionGroup->question_type): echo 'selected'; endif; ?>
                                            value="<?php echo e($item->value); ?>"><?php echo e(ucfirst($item->value)); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- First column-->
            <div class="col-12">
                <!-- Product Information -->
                <div class="card mb-6">
                    
                    <div class="card-body">
                        <div class="row mb-4 gap-2">
                            <div class="col-12">
                                <label class="form-label" for="title">Titre</label>
                                <input
                                    type="text" required
                                    class="form-control"
                                    id="title"
                                    placeholder=""
                                    name="title"
                                    value="<?php echo e(old('title',$questionGroup->title)); ?>"
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
                            <div class="col-lg-4">
                                <label class="form-label" for="page-index">Page</label>
                                <select id="page-index"
                                        name="page"
                                        class="select2 form-select">
                                    <?php for($i=1;$i<=4;$i++): ?>
                                        <option
                                            <?php if("$i" == $questionGroup->page): echo 'selected'; endif; ?>
                                            value="<?php echo e($i); ?>">Page <?php echo e($i); ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/layoutMaster', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u438288564/domains/ibemscreative.in/public_html/mobility/resources/views/pages/questions/group/edit.blade.php ENDPATH**/ ?>