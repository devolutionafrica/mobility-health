@isset($pageConfigs)
    {!! Helper::updatePageConfig($pageConfigs) !!}
@endisset
@php
    $configData = Helper::appClasses();
@endphp
@extends('layouts/commonMaster' )

@php
    /* Display elements */
    $contentNavbar = ($contentNavbar ?? true);
    $containerNav = ($containerNav ?? 'container-xxl');
    $isNavbar = ($isNavbar ?? true);
    $isMenu = ($isMenu ?? true);
    $isFlex = ($isFlex ?? false);
    $isFooter = ($isFooter ?? true);
    $customizerHidden = ($customizerHidden ?? '');

    /* HTML Classes */
    $navbarDetached = 'navbar-detached';
    $menuFixed = (isset($configData['menuFixed']) ? $configData['menuFixed'] : '');
    if(isset($navbarType)) {
      $configData['navbarType'] = $navbarType;
    }
    $navbarType = (isset($configData['navbarType']) ? $configData['navbarType'] : '');
    $footerFixed = (isset($configData['footerFixed']) ? $configData['footerFixed'] : '');
    $menuCollapsed = (isset($configData['menuCollapsed']) ? $configData['menuCollapsed'] : '');

    /* Content classes */
    $container = (isset($configData['contentLayout']) && $configData['contentLayout'] === 'compact') ? 'container-xxl' : 'container-fluid';

@endphp

@section('layoutContent')
    <div class="layout-wrapper layout-content-navbar {{ $isMenu ? '' : 'layout-without-menu' }}">
        <div class="layout-container">

            @if ($isMenu)
                @include('layouts/sections/menu/verticalMenu')
            @endif


            <!-- Layout page -->
            <div class="layout-page">

                {{-- Below commented code read by artisan command while installing jetstream. !! Do not remove if you want to use jetstream. --}}
                {{-- <x-banner /> --}}

                <!-- BEGIN: Navbar-->
                @if ($isNavbar)
                    @include('layouts/sections/navbar/navbar')
                @endif
                <!-- END: Navbar-->


                <!-- Content wrapper -->
                <div class="content-wrapper">

                    <!-- Content -->
                    @if ($isFlex)
                        <div class="{{$container}} d-flex align-items-stretch flex-grow-1 p-0">
                            @else
                                <div class="{{$container}} flex-grow-1 container-p-y">
                                    @endif

                                    @yield('content')
                                </div>
                                <!-- / Content -->

                                <!-- Footer -->
                                @if ($isFooter)
                                    @include('layouts/sections/footer/footer')
                                @endif
                                <!-- / Footer -->
                                <div class="content-backdrop fade"></div>
                        </div>
                        <!--/ Content wrapper -->

                        @if (session()->has('toast'))
                            @php
                              $_key=session('toast');
                              $_keys=explode("_",$_key);

                             @endphp

                            <div id="bs-toast-container" class="bs-toast  toast fade show position-fixed text-bg-{{end($_keys)}} z-5"
                                 style="right: 24px;top: 78px;z-index: 100" role="alert"
                                 aria-live="assertive" aria-atomic="true">
                                <div class="toast-header">
                                    <i class="ti ti-bell ti-xs me-2 text-{{end($_keys)}}"></i>
                                    <div class="me-auto fw-medium"> {{ __($_keys[0]) }}</div>
                                    <button type="button" class="btn-close"
                                            data-bs-dismiss="toast"
                                            aria-label="Close"></button>
                                </div>
                                <div class="toast-body">
                                    {{ __($_key) }}
                                </div>
                            </div>
                            <script>
                                setTimeout(function (){
                                    const container=document.querySelector('#bs-toast-container');
                                    if(container){
                                        container.remove();
                                    }
                                },8000)
                            </script>
                        @endif


                </div>
                <!-- / Layout page -->
            </div>

            @if ($isMenu)
                <!-- Overlay -->
                <div class="layout-overlay layout-menu-toggle"></div>
            @endif
            <!-- Drag Target Area To SlideIn Menu On Small Screens -->
            <div class="drag-target"></div>
        </div>
        <!-- / Layout wrapper -->
@endsection
