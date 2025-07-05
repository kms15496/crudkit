<header class="pc-header">
    <div class="header-wrapper">
        <div class="me-auto pc-mob-drp">
            <ul class="list-unstyled">
                <li class="pc-h-item pc-sidebar-collapse"><a class="pc-head-link ms-0" id="sidebar-hide"
                        href="#"><i class="ti ti-menu-2"></i></a></li>

            </ul>
        </div>

        <div class="ms-auto">
            <ul class="list-unstyled">



                <!-- End of Academic Year Select -->

                <!-- 🌟 Existing Profile Dropdown -->
                <li class="dropdown pc-h-item header-user-profile">
                    <a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#"
                        role="button" aria-haspopup="false" data-bs-auto-close="outside" aria-expanded="false">
                        <img src="{{ asset('assets/images/user/avatar-2.jpg') }}" alt="user-image" class="user-avtar" />
                    </a>
                    <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
                        <div class="dropdown-header d-flex align-items-center justify-content-between">
                            <h5 class="m-0">{{ __('profile') }}</h5>
                        </div>
                        <div class="dropdown-body">
                            <div class="profile-notification-scroll position-relative"
                                style="max-height: calc(100vh - 225px)">
                                <ul class="list-group list-group-flush w-100">

                                    <li class="list-group-item">
                                        <div class="dropdown-item">
                                            <span class="d-flex align-items-center">
                                                <i class="ph-duotone ph-globe-hemisphere-west"></i>
                                                <span>{{ __('languages') }}</span>
                                            </span>
                                            <span class="flex-shrink-0">
                                                <select id="languageSwitcher"
                                                    class="form-select bg-transparent form-select-sm border-0 shadow-none">
                                                    @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                                    <option
                                                        value="{{ LaravelLocalization::getLocalizedURL($localeCode) }}"
                                                        {{ App::getLocale() === $localeCode ? 'selected' : '' }}>
                                                        {{ $properties['native'] }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </span>
                                        </div>
                                    </li>

                                    <li class="list-group-item">
                                        <form method="POST" action="{{ route('logout') }}" x-data>
                                            @csrf
                                            <a href="{{ route('logout') }}" @click.prevent="$root.submit();"
                                                class="dropdown-item">
                                                <span class="d-flex align-items-center">
                                                    <i class="ph-duotone ph-power"></i>
                                                    <span>{{ __('log_out') }}</span>
                                                </span>
                                            </a>
                                        </form>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
                <!-- End of Profile Dropdown -->

            </ul>
        </div>
    </div>
</header>
