<!DOCTYPE html>
<html lang="en" data-layout="horizontal" data-topbar-color="dark">

<head>
    <meta charset="utf-8" />
    <title>{{ $title ?? config('app.name') }} - {{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="/storage/{{ setting('favicon') }}" />

    {{-- <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script> --}}
    <!-- App css -->
    <link href="{{ asset('backend/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Icons css -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/7.2.96/css/materialdesignicons.min.css"
        integrity="sha512-LX0YV/MWBEn2dwXCYgQHrpa9HJkwB+S+bnBpifSOTO1No27TqNMKYoAn6ff2FBh03THAzAiiCwQ+aPX+/Qt/Ow=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Theme Config Js -->
    <script src="{{ asset('backend/assets/js/config.js') }}"></script>
    <wireui:scripts />
    @vite('resources/css/app.css')
    <style>
        .ck.ck-editor {
            position: relative;
            color: #000 !important;
        }

        .container {
            max-width: 1200px;
        }

        .menu-item:hover .sub-menu,
        .menu-item.clicked .sub-menu {
            display: block;
            opacity: 1;
        }

        .dataTables_filter input {
            width: 50%;
        }
    </style>
    @livewireStyles
    @stack('page-style')
</head>

<body>
    <div class="flex wrapper">
        <div class="app-menu">
            <!--- Menu -->
            @include('layouts.backend.admin.sections.simplebar')
        </div>
        <!-- Sidenav Menu End  -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="page-content">
            <!-- Topbar Start -->
            @include('layouts.backend.admin.sections.header')
            <!-- Topbar End -->

            {{ $slot }}

            <!-- Footer Start -->
            @include('layouts.backend.admin.sections.footer')
            <!-- Footer End -->
        </div>


        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->
    </div>

    <!-- Theme Settings -->
    <div>
        <!-- Theme Settings Offcanvas -->
        @include('layouts.backend.admin.sections.customizer')
    </div>

    <!-- Plugin Js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/simplebar/6.2.5/simplebar.min.js"
        integrity="sha512-HV1U44HR4mYVDcsxzJpghYyGEy2PvbePe9UFXlV3vnzf4yFhbKA9QNpnhy4VWwnaC2jKzijITVWHPZBCOuc51g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="{{ asset('backend/assets/libs/%40frostui/tailwindcss/frostui.js') }}"></script>

    <!-- App Js -->
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>

    <!-- Dashboard App js -->
    {{-- <script src="{{ asset('backend/assets/js/pages/dashboard.init.js') }}"></script> --}}
    @livewire('livewire-ui-modal')
    @livewireScripts

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <x-livewire-alert::scripts />
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            if (window.innerWidth < 920) {
                // Get all menu items with sub-menus
                var menuItems = document.querySelectorAll('.menu-item');

                // Add click event listener to each menu item
                menuItems.forEach(function(menuItem) {
                    menuItem.addEventListener('click', function() {
                        // Toggle the 'hidden' class for the sub-menu
                        var subMenu = menuItem.querySelector('.sub-menu');
                        subMenu.classList.toggle('hidden');

                        // Toggle the opacity for the fade-in and fade-out effect
                        var isHidden = subMenu.classList.contains('hidden');
                        subMenu.style.opacity = isHidden ? 0 : 1;
                    });
                });
            }
        });
    </script>

    @stack('page-script')
</body>

</html>
