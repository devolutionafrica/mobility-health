@php
    use Illuminate\Support\Facades\Request;use Illuminate\Support\Facades\Route;
@endphp

<ul class="menu-sub">
    @if (isset($menu))
        @foreach ($menu as $submenu)

            {{-- active menu method --}}
            @php
                $activeClass = null;
                $active = $configData["layout"] === 'vertical' ? 'active open':'active';
                $currentRouteName =  Route::currentRouteName();
                $path=str_replace("/","-",Request::path()) ;

                if (str_contains($path,"-01j")){
                    $path=substr($path,0,strpos(str_replace("/","-",Request::path()),"-01j"));
                }


                if ($submenu->slug == $path || gettype($submenu->slug) === 'array' && in_array($path,$submenu->slug) || $currentRouteName === $submenu->slug) {
                    $activeClass = 'active';
                }
                elseif (isset($submenu->submenu)) {
                  if (gettype($submenu->slug) === 'array') {
                    foreach($submenu->slug as $slug){
                      if ($slug == $path || str_contains($currentRouteName,$slug) and strpos($currentRouteName,$slug) === 0) {
                          $activeClass = $active;
                      }
                    }
                  }
                  else{
                    if (str_contains($currentRouteName,$submenu->slug) and strpos($currentRouteName,$submenu->slug) === 0) {
                      $activeClass = $active;
                    }
                  }
                }
            @endphp

            <li class="menu-item {{$activeClass}}">
                <a href="{{ isset($submenu->url) ? url($submenu->url) : 'javascript:void(0)' }}"
                   class="{{ isset($submenu->submenu) ? 'menu-link menu-toggle' : 'menu-link' }}"
                   @if (isset($submenu->target) and !empty($submenu->target)) target="_blank" @endif>
                    @if (isset($submenu->icon))
                        <i class="{{ $submenu->icon }}"></i>
                    @endif
                    <div>{{ isset($submenu->name) ? __($submenu->name) : '' }}</div>
                    @isset($submenu->badge)
                        <div
                                class="badge bg-{{ $submenu->badge[0] }} rounded-pill ms-auto">{{ $submenu->badge[1] }}</div>
                    @endisset
                </a>

                {{-- submenu --}}
                @if (isset($submenu->submenu))
                    @include('layouts.sections.menu.submenu',['menu' => $submenu->submenu])
                @endif
            </li>
        @endforeach
    @endif
</ul>
