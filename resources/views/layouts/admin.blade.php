<!DOCTYPE html>

<html class="light-style layout-menu-fixed" data-theme="theme-default" data-assets-path="{{ asset('/assets') . '/' }}" data-base-url="{{url('/')}}">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

        <title>@yield('title') | Legal Link </title>
        
        <!-- laravel CRUD token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />

        <!-- Include Styles -->
        @include('layouts/sections/styles')

        <!-- Include Scripts for customizer, helper, analytics, config -->
        @include('layouts/sections/scriptsIncludes')
    </head>

    <body>

        @php
        /* Display elements */
        $contentNavbar = true;
        $containerNav = ($containerNav ?? 'container-xxl');
        $isNavbar = ($isNavbar ?? true);
        $isMenu = ($isMenu ?? true);
        $isFlex = ($isFlex ?? false);
        $isFooter = ($isFooter ?? true);
        $customizerHidden = ($customizerHidden ?? '');
        $pricingModal = ($pricingModal ?? false);

        /* HTML Classes */
        $navbarDetached = 'navbar-detached';

        /* Content classes */
        $container = ($container ?? 'container-xxl');

        @endphp

        <div class="layout-wrapper layout-content-navbar {{ $isMenu ? '' : 'layout-without-menu' }}">
            <div class="layout-container">

                @if ($isMenu)
                @include('layouts/sections/menu/verticalMenu')
                @endif


                <!-- Layout page -->
                <div class="layout-page">



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

        </div>
        <div class="modal-form-sidebar"></div>
        <div class="modal-form"></div>
        <div class="modal-form-category"></div>
        <!-- Include Scripts -->
        @include('layouts/sections/scripts')

    </body>

</html>
