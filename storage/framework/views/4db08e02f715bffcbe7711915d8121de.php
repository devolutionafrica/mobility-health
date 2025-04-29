<?php if (isset($component)) { $__componentOriginalaa758e6a82983efcbf593f765e026bd9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalaa758e6a82983efcbf593f765e026bd9 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => $__env->getContainer()->make(Illuminate\View\Factory::class)->make('mail::message'),'data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('mail::message'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
# Bonjour <?php echo e($customer->name); ?>,

Pour des raisons de sécurité, nous avons généré un code OTP (One-Time Password) pour votre authentification. Veuillez utiliser le code ci-dessous pour compléter votre processus de connexion:

<center>Votre code OTP : <strong style="color: #00a7bc;font-size: 16px"><?php echo e($customer->otp); ?></strong></center> <br><br>


Ce code est valable pour une durée de 10 minutes. Si vous n'avez pas initié cette demande, veuillez ignorer cet email et contacter notre support client immédiatement.

Merci de votre confiance,<br>

Cordialement,<br>
<?php echo e(config('app.name')); ?><br>

 <?php $__env->slot('header', null, []); ?> 
<?php if (isset($component)) { $__componentOriginal4b27c9cf0646a011e45f5c0081cff2ae = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4b27c9cf0646a011e45f5c0081cff2ae = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => $__env->getContainer()->make(Illuminate\View\Factory::class)->make('mail::header'),'data' => ['url' => config('app.url')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('mail::header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(config('app.url'))]); ?>
<img src="<?php echo e(url("/logo/lgoo2.png")); ?>" class="logo" alt="<?php echo e(config('app.name')); ?> logo">
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4b27c9cf0646a011e45f5c0081cff2ae)): ?>
<?php $attributes = $__attributesOriginal4b27c9cf0646a011e45f5c0081cff2ae; ?>
<?php unset($__attributesOriginal4b27c9cf0646a011e45f5c0081cff2ae); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4b27c9cf0646a011e45f5c0081cff2ae)): ?>
<?php $component = $__componentOriginal4b27c9cf0646a011e45f5c0081cff2ae; ?>
<?php unset($__componentOriginal4b27c9cf0646a011e45f5c0081cff2ae); ?>
<?php endif; ?>
 <?php $__env->endSlot(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalaa758e6a82983efcbf593f765e026bd9)): ?>
<?php $attributes = $__attributesOriginalaa758e6a82983efcbf593f765e026bd9; ?>
<?php unset($__attributesOriginalaa758e6a82983efcbf593f765e026bd9); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalaa758e6a82983efcbf593f765e026bd9)): ?>
<?php $component = $__componentOriginalaa758e6a82983efcbf593f765e026bd9; ?>
<?php unset($__componentOriginalaa758e6a82983efcbf593f765e026bd9); ?>
<?php endif; ?>
<?php /**PATH /home/u438288564/domains/ibemscreative.in/public_html/mobility/resources/views/mail/otp.blade.php ENDPATH**/ ?>