<?php
  if($type == \App\Models\Enums\UserType::HealthPartner){
     $suffix="partenaire de santé";
  }elseif ($type == \App\Models\Enums\UserType::ReferentDoctor){
    $suffix="médecin référent";
  }else{
     $suffix="administrateur";
  }
?>

<?php $__env->startSection('title', 'Nouveau '.$suffix); ?>

<?php $__env->startSection('vendor-style'); ?>
    <?php echo app('Illuminate\Foundation\Vite')([
      'resources/assets/vendor/libs/select2/select2.scss',
      'resources/assets/vendor/libs/leaflet/leaflet.scss'
    ]); ?>
<?php $__env->stopSection(); ?>

<!-- Vendor Scripts -->
<?php $__env->startSection('vendor-script'); ?>
    <?php echo app('Illuminate\Foundation\Vite')([
      'resources/assets/vendor/libs/select2/select2.js',
      'resources/assets/vendor/libs/leaflet/leaflet.js'
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
    <form class="px-lg-4" enctype="multipart/form-data" action="<?php echo e(route("user.store",["type"=>$type])); ?>" method="post">
        <?php echo csrf_field(); ?>
        <!-- Add Product -->
        <?php
            $personality=\Illuminate\Support\Facades\Request::query("personality","physical")
        ?>
        <div
            class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">

            <div class="row align-items-center">
                <div class="col-auto">
                    <a href="<?php echo e(route("user.index",["type"=>$type])); ?>" class="btn btn-icon btn-label-primary">
                        <i class="ti ti-chevron-left fs-xlarge"></i>
                    </a>
                </div>
                <div class="col">
                    <div class="d-flex flex-column justify-content-center">
                        <h4 class="mb-1">Nouveau</h4>
                        <p class="mb-0">
                            Enrégistrer d'un profil <?php echo e($suffix); ?>

                        </p>
                    </div>
                </div>
            </div>
            <div class="d-flex align-content-center flex-wrap gap-4">
                
                <button type="submit" class="btn btn-primary" name="btn" value="once">Enrégistrer</button>
                <button type="submit" class="btn btn-label-primary" name="btn" value="continue">Enrégistrer et
                    continuer
                </button>
            </div>

        </div>
        <div class="row">
            <!-- First column-->
            <div class="col-12 col-lg-8">
                <!-- Product Information -->
                <div class="card mb-6">
                    <div class="card-header">
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-7 col-xl-4">
                                <div class="border border-2 rounded p-2">
                                    <div class="h-px-150 w-100 pb-2 d-flex justify-content-center">
                                        <img src="/logo/user-circle.png" class="object-fit-cover rounded overflow-hidden"
                                             style="max-width: 100%;max-height: 100%" id="image-preview" alt="image">
                                    </div>
                                    <div class="border-top py-1 px-2">
                                        <div class="row  align-items-center justify-content-center ">
                                            <small  class="<?php echo \Illuminate\Support\Arr::toCssClasses(["d-inline-block mt-1","text-danger"=>$errors->has('img')]); ?>">
                                                L'image  doit peser jusqu'à 2 Mo
                                            </small>
                                            <?php $__errorArgs = ['img'];
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
                                            <div class="col overflow-hidden d-none" style="position: relative;">
                                                <input accept="image/*" id="img-upload" name="img" type="file"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if($type===\App\Models\Enums\UserType::HealthPartner): ?>
                            <div class="row mb-4">
                                <div class="col-md mb-md-0 mb-5">
                                    <a href="<?php echo e(route("user.create",["type"=>$type->value,"personality"=>"physical"])); ?>"
                                       class="form-check custom-option custom-option-icon">
                                        <label class="form-check-label custom-option-content" for="dfdfsr4thzhw">
                                        <span class="custom-option-body">
                                          <i class="ti ti-user"></i>
                                          <span class="custom-option-title">Indépendant</span>
                                          <small>Être humain, individu avec droits et obligations.</small>
                                        </span>
                                            <input name="personality" class="form-check-input" type="radio"
                                                   value="physical" id="physical" <?php if($personality=="physical"): echo 'checked'; endif; ?>/>
                                        </label>
                                    </a>
                                </div>
                                <a href="<?php echo e(route("user.create",["type"=>$type->value,"personality"=>"legal"])); ?>"
                                   class="col-md">
                                    <div
                                        class="form-check custom-option custom-option-icon">
                                        <label class="form-check-label custom-option-content" for="dfdfsdfsvefs">
                                    <span class="custom-option-body">
                                          <i class="ti ti-briefcase"></i>
                                          <span class="custom-option-title"> Enterprise </span>
                                          <small>Entité légale avec droits et obligations propres</small>
                                        </span>
                                            <input name="personality" class="form-check-input" type="radio"
                                                   value="legal" id="legal" <?php if($personality!="physical"): echo 'checked'; endif; ?>/>
                                        </label>
                                    </div>
                                </a>
                            </div>
                        <?php endif; ?>
                        <?php if($type!==\App\Models\Enums\UserType::HealthPartner && $personality !="legal"): ?>
                            <label for="address" class="form-label">Genre</label>
                            <div class="row mb-4">
                                <div class="col-6 col-lg-4">
                                    <div class="form-check custom-option custom-option-basic">
                                        <label class="form-check-label custom-option-content pb-2" for="male">
                                            <input checked name="gender" class="form-check-input" type="radio"
                                                   value="male"
                                                   id="male"/>
                                            <span class="custom-option-header">Masculin</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-4">
                                    <div class="form-check custom-option custom-option-basic">
                                        <label class="form-check-label custom-option-content pb-2" for="female">
                                            <input name="gender" class="form-check-input" type="radio" value="female"
                                                   id="female"/>
                                            <span class="custom-option-header">Féminin</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if($type===\App\Models\Enums\UserType::HealthPartner && $personality =="legal"): ?>
                            <div class="row mb-4">
                                <div class="col">
                                    <label class="form-label" for="lastname">Nom de l'entreprise</label>
                                    <input type="text" required
                                           class="form-control"
                                           id="lastname"
                                           placeholder=""
                                           name="lastname"
                                           value="<?php echo e(old('lastname')); ?>"
                                           class="<?php echo \Illuminate\Support\Arr::toCssClasses(["form-control","is-invalid"=>$errors->has('lastname')]); ?>"
                                           aria-label="lastname">
                                    <?php $__errorArgs = ['lastname'];
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
                                    <input type="hidden"
                                           value=""
                                           id="firstname"
                                           name="firstname">
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="row mb-4">
                                <div class="col">
                                    <label class="form-label" for="lastname">Nom</label>
                                    <input type="text" required
                                           class="form-control"
                                           id="lastname"
                                           placeholder=""
                                           name="lastname"
                                           value="<?php echo e(old('lastname')); ?>"
                                           class="<?php echo \Illuminate\Support\Arr::toCssClasses(["form-control","is-invalid"=>$errors->has('lastname')]); ?>"
                                           aria-label="lastname">
                                    <?php $__errorArgs = ['lastname'];
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
                                <div class="col">
                                    <label class="form-label" for="firstname">Prénom</label>
                                    <input type="text"
                                           value="<?php echo e(old('firstname')); ?>"
                                           required
                                           class="<?php echo \Illuminate\Support\Arr::toCssClasses(["form-control","is-invalid"=>$errors->has('firstname')]); ?>"
                                           id="firstname"
                                           placeholder=""
                                           name="firstname"
                                           aria-label="firstname">
                                    <?php $__errorArgs = ['firstname'];
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
                        <?php endif; ?>
                        <div class="mb-4">
                            <div class="row">

                                <div class="col-12 col-md-5">
                                    <label class="form-label" for="phone_number">Numéro de téléphone</label>
                                    <input
                                        type="tel"
                                        required
                                        class="<?php echo \Illuminate\Support\Arr::toCssClasses(["form-control","is-invalid"=>$errors->has('phone_number')]); ?>"
                                        id="phone_number"
                                        placeholder=""
                                        value="<?php echo e(old('phone_number')); ?>"
                                        name="phone_number"
                                        aria-label="phone_number">
                                    <?php $__errorArgs = ['phone_number'];
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
                                <?php if($type==\App\Models\Enums\UserType::HealthPartner || $type==\App\Models\Enums\UserType::ReferentDoctor): ?>
                                    <div class="col-12 col-md-7">
                                        <label class="form-label" for="country">
                                            <?php echo e($type==\App\Models\Enums\UserType::HealthPartner && $personality =="legal" ? "Pays":"Nationalité"); ?>

                                        </label>
                                        <select id="country" name="country_id" class="select2-icons form-select">
                                            <?php $__currentLoopData = \App\Models\Country::query()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option
                                                    data-icon="/flag/flag_<?php echo e($item->id); ?>.png"
                                                    value="<?php echo e($item->id); ?>"><?php echo e($type==\App\Models\Enums\UserType::HealthPartner && $personality =="legal" ? $item->name : $item->nationality); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
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
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php if($type!==\App\Models\Enums\UserType::Admin && $type!==\App\Models\Enums\UserType::Manager): ?>
                            <div class="mb-4">
                                <label for="address" class="form-label">Adresse</label>
                                <textarea class="form-control" name="address" id="address" rows="3"><?php echo e(old("address","")); ?></textarea>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <!-- /Second column -->

            <!-- Second column -->
            <div class="col-12 col-lg-4">
                <!-- Pricing Card -->
                <?php if($type===\App\Models\Enums\UserType::Admin || $type===\App\Models\Enums\UserType::Manager): ?>
                    <div class="card mb-6">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Role</h5>
                        </div>
                        <div class="card-body">
                            <!-- Base Price -->
                            <div class="mb-4">
                                <select id="vendor" name="role" class="select2 form-select">
                                    <option value="admin" <?php if(old("role") == "admin"): echo 'selected'; endif; ?>>Administrateur</option>
                                    <option value="manager" <?php if(old("role") == "manager"): echo 'selected'; endif; ?>>Gestionnaire</option>
                                </select>
                            </div>
                        </div>
                        <!-- /Pricing Card -->
                    </div>
                <?php else: ?>
                    <input type="hidden" name="role" value="<?php echo e($type->value); ?>">
                <?php endif; ?>

                <?php if($type===\App\Models\Enums\UserType::ReferentDoctor || $type===\App\Models\Enums\UserType::HealthPartner): ?>
                    <div class="card mb-6">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Spécialité</h5>
                        </div>
                        <div class="card-body">
                            <!-- Base Price -->
                            <div class="mb-6">
                                <select id="referent_doctor_specialty" name="speciality_id" class="select2 form-select">
                                    <?php $__currentLoopData = \App\Models\Speciality::query()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option <?php if(old("specialty_id") == $item->id): echo 'selected'; endif; ?> value="<?php echo e($item->id); ?>">
                                            <?php echo e($item->name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php $__errorArgs = ['specialty_id'];
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
                        <!-- /Pricing Card -->
                    </div>
                <?php endif; ?>
                <!-- /Second column -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-tile mb-0">Authentification</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <label class="form-label" for="email">Email</label>
                            <input required type="email"
                                   class="<?php echo \Illuminate\Support\Arr::toCssClasses(["form-control","is-invalid"=>$errors->has('email')]); ?>"
                                   id="email"
                                   placeholder=""
                                   value="<?php echo e(old('email')); ?>"
                                   name="email"
                                   aria-label="email">
                            <?php $__errorArgs = ['email'];
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
                        <div class="row mb-6 gap-2">
                            <div class="col-12">
                                <label class="form-label" for="password">Mot de passe</label>
                                <input required type="password"
                                       class="<?php echo \Illuminate\Support\Arr::toCssClasses(["form-control","is-invalid"=>$errors->has('password')]); ?>" id="password"
                                       placeholder=""
                                       name="password" aria-label="password">
                                <?php $__errorArgs = ['password'];
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
                            <div class="col-12">
                                <label class="form-label" for="password_confirmation">Confirmez le mot de passe</label>
                                <input required type="password"
                                       class="<?php echo \Illuminate\Support\Arr::toCssClasses(["form-control","is-invalid"=>$errors->has('password_confirmation')]); ?>" id="password_confirmed"
                                       placeholder="" name="password_confirmation" aria-label="password_confirmation">
                                <?php $__errorArgs = ['password_confirmation'];
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
        <?php if($type!==\App\Models\Enums\UserType::Admin && $type!==\App\Models\Enums\UserType::Manager): ?>
            <div class="card mb-6">
                <div class="card-header">
                    <h5 class="card-title mb-0">Géolocalisation</h5>
                </div>
                <div class="card-body">
                    <!-- Base Price -->
                    <div class="mb-6">
                        <div class="row">
                            <div class="col">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="latitude"
                                    placeholder="Latitude"
                                    name="location[lat]"
                                    value="<?php echo e(old('location.lat')); ?>"
                                    class="<?php echo \Illuminate\Support\Arr::toCssClasses(["form-control","is-invalid"=>$errors->has('location.lat')]); ?>"
                                    aria-label="latitude">
                            </div>
                            <div class="col">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="longitude"
                                    placeholder="Longitude"
                                    name="location[lon]"
                                    value="<?php echo e(old('location.lon')); ?>"
                                    class="<?php echo \Illuminate\Support\Arr::toCssClasses(["form-control","is-invalid"=>$errors->has('location.lon')]); ?>"
                                    aria-label="longitude">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="leaflet-map" id="dragMap"></div>
                        </div>
                    </div>
                </div>
                <!-- /Pricing Card -->
            </div>
        <?php endif; ?>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/layoutMaster', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u438288564/domains/ibemscreative.in/public_html/mobility/resources/views/pages/users/create.blade.php ENDPATH**/ ?>