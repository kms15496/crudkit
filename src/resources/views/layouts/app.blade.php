{{-- resources/views/layouts/app.blade.php --}}

<!doctype html>
<html lang="en">

<head>
    <title>{{ env('APP_NAME') }}</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Light Able admin & dashboard template">
    <meta name="author" content="phoenixcoded">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google / Bunny fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('vendor/crudkit/assets/images/favicon.png') }}" type="image/x-icon">

    <!-- Icon & font packs -->
    <link rel="stylesheet" href="{{ asset('vendor/crudkit/assets/fonts/phosphor/duotone/style.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/crudkit/assets/fonts/tabler-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/crudkit/assets/fonts/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/crudkit/assets/fonts/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/crudkit/assets/fonts/material.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/crudkit/assets/css/style.css') }}" id="main-style-link">
    <link rel="stylesheet" href="{{ asset('vendor/crudkit/assets/css/style-preset.css') }}">

    <!-- DataTables bundle (CSS first) -->
    <link rel="stylesheet" href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.1.2/b-3.1.0/b-colvis-3.1.0/b-html5-3.1.0/b-print-3.1.0/datatables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">

    @yield('styles')
</head>

<body data-pc-preset="preset-1"
    data-pc-sidebar-theme="light"
    data-pc-sidebar-caption="true"
    data-pc-direction="ltr"
    data-pc-theme="light"
    style="background-color:#fff!important">

    <!-- Pre-loader -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>

    <!-- Layout -->
    <div class="min-h-screen bg-gray-100">
        @livewire('navigation-menu')
        @include('crudkit::partials.header')

        <main>
            {{ $slot }}
        </main>
    </div>

    <!-- Core JS libs -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('vendor/crudkit/assets/js/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('vendor/crudkit/assets/js/plugins/simplebar.min.js') }}"></script>
    <script src="{{ asset('vendor/crudkit/assets/js/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/crudkit/assets/js/fonts/custom-font.js') }}"></script>
    <script src="{{ asset('vendor/crudkit/assets/js/pcoded.js') }}"></script>
    <script src="{{ asset('vendor/crudkit/assets/js/plugins/feather.min.js') }}"></script>
    <script src="{{ asset('vendor/crudkit/assets/js/plugins/axios.min.js') }}"></script>

    <!-- DataTables bundle (scripts) -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

    <!-- CKEditor (optional) -->
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor.create(document.querySelector('#editor'), {
            ui: {
                viewportOffset: {
                    top: 50
                }
            },
            height: 300
        }).catch(console.error);
    </script>

    <!-- Tagify / Choices -->
    <script src="{{ asset('vendor/crudkit/assets/js/plugins/choices.min.js') }}"></script>

    <!-- Layout helpers -->
    <script>
        layout_change('light');
        layout_sidebar_change('light');
        layout_caption_change('true');
        layout_rtl_change('false');
        change_box_container('false');
        preset_change('preset-1');

        function successalert() {
            $('#success-alert').removeClass('d-none');
            setTimeout(() => $('#success-alert').addClass('d-none'), 3000);
        }

        function errorAlert(message) {
            $('#error-alert').removeClass('d-none').html(message);
            setTimeout(() => $('#error-alert').addClass('d-none'), 3000);
        }
    </script>

    @if (app()->environment('local'))
    <script>
        $.ajaxSetup({
            beforeSend: xhr => {
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.setRequestHeader('Content-Type', 'application/json');
            }
        });
    </script>
    @endif

    @yield('scripts')
</body>

</html>