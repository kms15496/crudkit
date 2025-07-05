<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg">
                <!-- [ Main Content ] start -->
                <div class="pc-container">
                    <div class="pc-content">
                        <!-- [ breadcrumb ] start -->
                        <div class="page-header">
                            <div class="page-block">
                                <div class="row align-items-center">

                                    <div class="col-md-6">
                                        <div class="page-header-title">
                                            <h2 class="mb-0"> @yield('title') </h2>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        @if (View::hasSection('create_route'))
                                            <a
                                                href="{{ route(View::hasSection('create_route') ? trim($__env->yieldContent('create_route')) : 'default.route') }}">
                                                <div class="page-header-title float-end">
                                                    <div class="mb-0 btn btn-success">
                                                        <span class="ph-duotone ph-plus"></span> {{ __('create')}}
                                                    </div>
                                                </div>
                                            </a>
                                        @endif
                                        @if (View::hasSection('custom_route'))
                                            @yield('custom_route')
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- [ breadcrumb ] end -->

                        <!-- [ Main Content ] start -->

                        <div class="row">
                            <div class="col-xl-12">
                                @if(Session::has('success'))
                                    <div class="alert alert-success "><strong>{{ Session::get('success') }}</strong></div>
                                @endif
                                @if(Session::has('fail'))
                                    <div class="alert alert-danger"><strong>{{ Session::get('fail') }}</strong></div>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <!-- [ sample-page ] start -->
                            <div class="col-xl-12">
                                <!-- <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive"> -->
                                            @yield('content')
                                        <!-- </div>
                                    </div>
                                </div> -->
                            </div>
                            <!-- [ sample-page ] end -->
                        </div>
                        <!-- [ Main Content ] end -->
                    </div>
                </div>
                <!-- [ Main Content ] end -->
            </div>
        </div>
    </div>

    {{-- @yield('scripts') --}}

</x-app-layout>