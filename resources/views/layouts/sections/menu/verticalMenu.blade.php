@php
    use Illuminate\Support\Facades\Request;use Illuminate\Support\Facades\Route;
    $configData = Helper::appClasses();
@endphp

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

    <!-- ! Hide app brand if navbar-full -->
    @if(!isset($navbarFull))
        <div class="app-brand demo">
            <a href="{{url('/')}}" class="app-brand-link">
                <span class="app-brand-logo demo">@include('_partials.macros',["height"=>20])</span>
                <span class="app-brand-text demo menu-text fw-bold">{{config('variables.templateName')}}</span>
            </a>

            <a href="{{url('/')}}" class="layout-menu-toggle menu-link text-large ms-auto">
                <i class="ti menu-toggle-icon d-none d-xl-block align-middle"></i>
                <i class="ti ti-x d-block d-xl-none ti-md align-middle"></i>
            </a>
        </div>
    @endif

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        @foreach ($menuData[0]->menu as $menu)

            {{-- adding active and open class if child is active --}}

            {{-- menu headers --}}
            @if (isset($menu->menuHeader))
                <li class="menu-header small">
                    <span class="menu-header-text">{{ __($menu->menuHeader) }}</span>
                </li>
            @else

                {{-- active menu method --}}
                @php
                    $activeClass = null;
                    $currentRouteName = Route::currentRouteName();
                     $path=str_replace("/","-",Request::path()) ;

                        if (str_contains($path,"-01j")){
                            $path=substr($path,0,strpos(str_replace("/","-",Request::path()),"-01j"));
                        }
                    if ($path === $menu->slug   || $currentRouteName === $menu->slug) {
                      $activeClass = 'active';
                    }
                    else if (gettype($menu->slug) === 'array' && in_array($path,$menu->slug)){
                         $activeClass = 'active open';
                    }
                    elseif (isset($menu->submenu)) {
                      if (gettype($menu->slug) === 'array') {
                        foreach($menu->slug as $slug){
                          if ($path === $slug || !is_array($menu->slug) && str_starts_with($slug,$path) || (str_contains($currentRouteName,$slug) and strpos($currentRouteName,$slug) === 0)) {
                            $activeClass = 'active open';
                          }
                        }
                      }
                      else{
                        if ($path === $menu->slug || str_contains($currentRouteName,$menu->slug) and strpos($currentRouteName,$menu->slug) === 0) {
                          $activeClass = 'active open';
                        }
                      }
                    }
                @endphp

                {{-- main menu --}}
                <li class="menu-item {{$activeClass}}">
                    <a href="{{ isset($menu->url) ? url($menu->url) : 'javascript:void(0);' }}"
                       class="{{ isset($menu->submenu) ? 'menu-link menu-toggle' : 'menu-link' }}"
                       @if (isset($menu->target) and !empty($menu->target)) target="_blank" @endif>
                        @isset($menu->icon)
                            <i class="{{ $menu->icon }}"></i>
                        @endisset
                        <div>{{ isset($menu->name) ? __($menu->name) : '' }}</div>
                        @isset($menu->badge)
                            <div class="badge bg-{{ $menu->badge[0] }} rounded-pill ms-auto">{{ $menu->badge[1] }}</div>
                        @endisset
                    </a>

                    {{-- submenu --}}
                    @isset($menu->submenu)
                        @include('layouts.sections.menu.submenu',['menu' => $menu->submenu])
                    @endisset
                </li>
            @endif
        @endforeach
    </ul>

</aside>
