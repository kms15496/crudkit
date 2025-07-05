@php /** @var \Illuminate\View\View|string \$slot */ @endphp
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
                                    <div class="col-md-12">
                                        <div class="page-header-title">
                                            <h2 class="mb-0">
                                                @yield('title')
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @yield('form')
                        {{ \$slot }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
