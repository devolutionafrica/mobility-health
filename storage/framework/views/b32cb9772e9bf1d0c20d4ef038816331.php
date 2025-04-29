<?php
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Route;
    $containerNav = ($configData['contentLayout'] === 'compact') ? 'container-xxl' : 'container-fluid';
    $navbarDetached = ($navbarDetached ?? '');
?>

    <!-- Navbar -->
<?php if(isset($navbarDetached) && $navbarDetached == 'navbar-detached'): ?>
    <nav
        class="layout-navbar <?php echo e($containerNav); ?> navbar navbar-expand-xl <?php echo e($navbarDetached); ?> align-items-center bg-navbar-theme"
        id="layout-navbar">
        <?php endif; ?>
        <?php if(isset($navbarDetached) && $navbarDetached == ''): ?>
            <nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
                <div class="<?php echo e($containerNav); ?>">
                    <?php endif; ?>

                    <!--  Brand demo (display only for navbar-full and hide on below xl) -->
                    <?php if(isset($navbarFull)): ?>
                        <div class="navbar-brand app-brand demo d-none d-xl-flex py-0 me-4">
                            <a href="<?php echo e(url('/')); ?>" class="app-brand-link">
                                <span class="app-brand-logo demo"><?php echo $__env->make('_partials.macros',["height"=>20], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></span>
                                <span
                                    class="app-brand-text demo menu-text fw-bold"><?php echo e(config('variables.templateName')); ?></span>
                            </a>
                            <?php if(isset($menuHorizontal)): ?>
                                <a href="javascript:void(0);"
                                   class="layout-menu-toggle menu-link text-large ms-auto d-xl-none">
                                    <i class="ti ti-x ti-md align-middle"></i>
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <!-- ! Not required for layout-without-menu -->
                    <?php if(!isset($navbarHideToggle)): ?>
                        <div
                            class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0<?php echo e(isset($menuHorizontal) ? ' d-xl-none ' : ''); ?> <?php echo e(isset($contentNavbar) ?' d-xl-none ' : ''); ?>">
                            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                                <i class="ti ti-menu-2 ti-md"></i>
                            </a>
                        </div>
                    <?php endif; ?>

                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

                        <?php if(!isset($menuHorizontal)): ?>
                            <!-- Search -->
                            <div class="navbar-nav align-items-center">
                                <div class="nav-item navbar-search-wrapper mb-0">
                                    <a class="nav-item nav-link search-toggler d-flex align-items-center px-0"
                                       href="javascript:void(0);">
                                        <i class="ti ti-search ti-md me-2 me-lg-4 ti-lg"></i>
                                        <span
                                            class="d-none d-md-inline-block text-muted fw-normal">Recherche (Ctrl+/)</span>
                                    </a>
                                </div>
                            </div>
                            <!-- /Search -->
                        <?php endif; ?>

                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                            <?php if(isset($menuHorizontal)): ?>
                                <!-- Search -->
                                <li class="nav-item navbar-search-wrapper">
                                    <a class="nav-link btn btn-text-secondary btn-icon rounded-pill search-toggler"
                                       href="javascript:void(0);">
                                        <i class="ti ti-search ti-md"></i>
                                    </a>
                                </li>
                                <!-- /Search -->
                            <?php endif; ?>

                            <!-- Language -->
                           
                            <!--/ Language -->

                            <?php if($configData['hasCustomizer'] == true): ?>
                                <!-- Style Switcher -->
                                <li class="nav-item dropdown-style-switcher dropdown ms-2">
                                    <a class="nav-link btn btn-text-secondary btn-icon rounded-pill dropdown-toggle hide-arrow"
                                       href="javascript:void(0);" data-bs-toggle="dropdown">
                                        <i class='ti ti-md'></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-styles">
                                        <li>
                                            <a class="dropdown-item" href="javascript:void(0);" data-theme="light">
                                                <span class="align-middle"><i
                                                        class='ti ti-sun ti-md me-3'></i>Light</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="javascript:void(0);" data-theme="dark">
                                                <span class="align-middle"><i class="ti ti-moon-stars ti-md me-3"></i>Dark</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="javascript:void(0);" data-theme="system">
                                                <span class="align-middle"><i
                                                        class="ti ti-device-desktop-analytics ti-md me-3"></i>System</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <!-- / Style Switcher -->
                            <?php endif; ?>


                            <!-- Notification -->
                            
                            <!--/ Notification -->

                            <!-- User -->
                            <li class="nav-item navbar-dropdown dropdown-user dropdown ms-2">
                                <a class="nav-link dropdown-toggle hide-arrow p-0" href="javascript:void(0);"
                                   data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        <img
                                            src="<?php echo e(asset( Auth::user()->avatar!=null ? '/storage/'.Auth::user()->avatar->path : 'assets/img/avatars/1.png')); ?>"
                                            alt class="rounded-circle">
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item mt-0"
                                           href="<?php echo e(Route::has('profile.show') ? route('profile.show') : url('pages/profile-user')); ?>">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 me-2">
                                                    <div class="avatar avatar-online">
                                                        <img
                                                            src="<?php echo e(asset(Auth::user()->avatar?->path ?? 'assets/img/avatars/1.png')); ?>"
                                                            alt class="rounded-circle">
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="mb-0">
                                                        <?php if(Auth::check()): ?>
                                                            <?php echo e(Auth::user()->name); ?>

                                                        <?php else: ?>
                                                            John Doe
                                                        <?php endif; ?>
                                                    </h6>
                                                    <small class="text-muted">Admin</small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider my-1 mx-n2"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item"
                                           href="<?php echo e(Route::has('profile.show') ? route('profile.show') : url('pages/profile-user')); ?>">
                                            <i class="ti ti-user me-3 ti-md"></i><span
                                                class="align-middle">Mon profil</span>
                                        </a>
                                    </li>
                                    
                                    <li>
                                        <div class="dropdown-divider my-1 mx-n2"></div>
                                    </li>
                                    <?php if(Auth::check()): ?>
                                        <li>
                                            <div class="d-grid px-2 pt-2 pb-1">
                                                <form method="post" class="w-100" id="logout-form"
                                                      action="<?php echo e(route('logout')); ?>">
                                                    <?php echo csrf_field(); ?>
                                                    <button type="submit" class="btn btn-sm btn-danger d-flex w-100">
                                                        <small class="align-middle">Déconnexion</small>
                                                        <i class="ti ti-logout ms-2 ti-14px"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </li>
                                    <?php else: ?>
                                        <li>
                                            <div class="d-grid px-2 pt-2 pb-1">
                                                <a class="btn btn-sm btn-danger d-flex"
                                                   href="<?php echo e(Route::has('login') ? route('login') : url('auth/login-basic')); ?>">
                                                    <small class="align-middle">Login</small>
                                                    <i class="ti ti-login ms-2 ti-14px"></i>
                                                </a>
                                            </div>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </li>
                            <!--/ User -->
                        </ul>
                    </div>

                    <!-- Search Small Screens -->
                    <div
                        class="navbar-search-wrapper search-input-wrapper <?php echo e(isset($menuHorizontal) ? $containerNav : ''); ?> d-none">
                        <input type="text"
                               class="form-control search-input <?php echo e(isset($menuHorizontal) ? '' : $containerNav); ?> border-0"
                               placeholder="Search..." aria-label="Search...">
                        <i class="ti ti-x search-toggler cursor-pointer"></i>
                    </div>
                    <!--/ Search Small Screens -->
                    <?php if(isset($navbarDetached) && $navbarDetached == ''): ?>
                </div>
                <?php endif; ?>
  </nav>
  <!-- / Navbar -->
<?php /**PATH /home/u438288564/domains/ibemscreative.in/public_html/mobility/resources/views/layouts/sections/navbar/navbar.blade.php ENDPATH**/ ?>