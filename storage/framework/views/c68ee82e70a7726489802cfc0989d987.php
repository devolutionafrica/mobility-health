<?php use Illuminate\Support\Facades\URL; ?>


<?php $__env->startSection('title', 'Nouvelle question médicale'); ?>

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
    <form class="px-lg-4" action="<?php echo e(route("question.store")); ?>" method="post">
        <?php echo csrf_field(); ?>
        <div class="row align-items-center">
            <div class="col-auto">
                <a href="<?php echo e(route("question.index")); ?>" class="btn btn-icon btn-label-primary">
                    <i class="ti ti-chevron-left fs-xlarge"></i>
                </a>
            </div>
            <div class="col">
                <div
                    class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">

                    <div class="d-flex flex-column justify-content-center">
                        <h4 class="mb-1">Nouveau</h4>
                        <p class="mb-0">
                            Enrégistrer une question médicale
                        </p>
                    </div>
                    <div class="d-flex align-content-center flex-wrap gap-4">
                        <button type="submit" class="btn btn-primary" name="btn" value="once">Enrégistrer</button>
                        <button type="submit" class="btn btn-label-primary" name="btn" value="continue">Enrégistrer et
                            continuer
                        </button>
                    </div>

                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-xl-7">
                <div class="card">
                    <?php
                        $_type=\Illuminate\Support\Facades\Request::query("type","text")
                    ?>
                    <div class="card-body">
                        <div class="row">
                            <?php $__currentLoopData = ["text","multiple","option"]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-4 mb-md-0 mb-5">
                                    <a href="<?php echo e(URL::current().'?type='.$item); ?>"
                                       class="form-check custom-option custom-option-icon">
                                        <label class="form-check-label custom-option-content" for="dfdfsr4thzhw">
                                        <span class="custom-option-body">
                                          <i class="ti ti-file-text"></i>
                                          <span class="custom-option-title text-uppercase"><?php echo e($item); ?></span>
                                          <small>Champ de saisie</small>
                                        </span>
                                            <input <?php if($_type==$item): echo 'checked'; endif; ?> class="form-check-input" type="radio"
                                                   name="type" value="<?php echo e($item); ?>" id="<?php echo e($item); ?>"/>
                                        </label>
                                    </a>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">

            <!-- First column-->
            <div class="col-8">
                <!-- Product Information -->
                <div class="card mb-6">
                    <div class="card-header">
                        <h5 class="card-tile mb-0">Question de type <?php echo e($_type); ?></h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-xl-8">
                                <label class="form-label" for="question_name">Question</label>
                                <input type="text" required
                                       class="form-control"
                                       id="question_name"
                                       placeholder=""
                                       name="question[label]"
                                       value="<?php echo e(old('question[label]')); ?>"
                                       class="<?php echo \Illuminate\Support\Arr::toCssClasses(["form-control","is-invalid"=>$errors->has('question[label]')]); ?>"
                                       aria-label="question[label]">
                                <?php $__errorArgs = ['question[label]'];
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
                        <?php if($_type=="multiple"): ?>
                            <div class="col-md-12 mb-6">
                                <label for="response_<?php echo e($_type); ?>" class="form-label">Option de reponse</label>
                                <input id="response_<?php echo e($_type); ?>" class="form-control tagifyBasic"
                                       name="question[response]" value=""/>
                            </div>
                        <?php endif; ?>
                        <?php if($_type=="option"): ?>
                            <?php for($i=0;$i<2;$i++): ?>
                                <div class="border p-4 rounded my-4">
                                    <div class="row mb-4">
                                        <div class="col-xl-4">
                                            <label class="form-label" for="question_name">Question</label>
                                            <input type="text" required
                                                   class="form-control"
                                                   id="question_name"
                                                   placeholder="Oui"
                                                   name="<?php echo e('question[response]['.$i.'][label]'); ?>"
                                                   value="<?php echo e(old('question[response]['.$i.'][label]',$i == 0 ?'Oui':'Non')); ?>"
                                                class="<?php echo \Illuminate\Support\Arr::toCssClasses(["form-control","is-invalid"=>$errors->has('question['.$i.'][label]')]); ?>">
                                        </div>
                                    </div>
                                    <div class="row gap-2 align-items-center">
                                        <div class="col-md-2">
                                            <label for="response_<?php echo e($_type); ?>" class="form-label">Option de
                                                reponse</label>
                                            <select name="<?php echo e('question[response]['.$i.'][type]'); ?>"
                                                    class=" select2d form-select">
                                                <option value="text">Text</option>
                                                <option value="option">Option</option>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label for="response_<?php echo e($_type); ?>" class="form-label">Option de
                                                reponse</label>
                                            <input name="<?php echo e('question[response]['.$i.'][response]'); ?>"
                                                   id="response_<?php echo e($_type); ?>" class="form-control tagifyBasic"
                                                   value="Nom,Prénoms"/>
                                        </div>
                                    </div>
                                </div>
                            <?php endfor; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <!-- /Second column -->
            <div class="col-12 col-lg-4">

                <!-- /Second column -->
                <div class="card mb-4">
                    <div class="card-header">
                        <div class="card-tile mb-0">
                            <div class="row">
                                <div class="col">
                                    <h5>Groupe de question</h5>
                                </div>
                                <div class="col-auto">
                                    <a href="<?php echo e(route('questionGroup.create')); ?>"  class="btn btn-label-primary">Nouveau</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <?php $__currentLoopData = \App\Models\QuestionGroup::query()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-12 pb-1 mb-1 border-bottom">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <div class="form-check">
                                                <label class="form-check-label d-flex align-items-center gap-2" for="<?php echo e($item->id); ?>">
                                                    <input class="form-check-input" type="radio"
                                                           name="question_group_id"
                                                           value="<?php echo e($item->id); ?>"
                                                           <?php if($loop->index==0): echo 'checked'; endif; ?>
                                                           id="<?php echo e($item->id); ?>"/>
                                                    <span class="">
                                                      <span class="fw-semibold d-block"><?php echo e($item->title); ?></span>
                                                       <span class="d-inline-flex align-items-center gap-2">
                                                           <small class="btn-label-secondary px-2"><?php echo e($item->question_type); ?></small>
                                                           <small class="text-primary">Page <?php echo e($item->page); ?></small>
                                                       </span>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <a href="<?php echo e(route("questionGroup.edit",["questionGroup"=>$item->id])); ?>">
                                                <i class="ti ti-edit"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/layoutMaster', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u438288564/domains/ibemscreative.in/public_html/mobility/resources/views/pages/questions/create.blade.php ENDPATH**/ ?>