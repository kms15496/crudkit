{{-- crudkit::partials.sidebar --}}
<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header d-flex align-items-center py-3">
            <a href="#" class="b-brand">
                <span class="fw-bold" style="font-size:20px;color:black">
                    {{ config('app.name') }}
                </span>
            </a>
        </div>
    </div>

    <div class="navbar-content">
        <ul class="pc-navbar">
            @foreach ($menus as $menu)
                <li class="pc-item {{ $menu['submenu'] ?? false ? 'pc-hasmenu' : '' }}">
                    <a href="{{ $menu['route'] ? route($menu['route']) : '#!' }}" class="pc-link">
                        <span class="pc-micon"><i class="{{ $menu['icon'] }}"></i></span>
                        <span class="pc-mtext">{{ __($menu['title']) }}</span>
                        @if (!empty($menu['submenu']))
                            <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                        @endif
                    </a>

                    @if (!empty($menu['submenu']))
                        <ul class="pc-submenu">
                            @foreach ($menu['submenu'] as $sub)
                                <li class="pc-item">
                                    <a class="pc-link" href="{{ route($sub['route']) }}">
                                        {{ __($sub['title']) }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
</nav>