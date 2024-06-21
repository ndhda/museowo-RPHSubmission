<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>
        @forelse (request()->segments() as $current_uri)
            {{ strtoupper(str_replace('-', ' ', $current_uri)) }} -
        @empty
        @endforelse | {{ config('app.name', 'Laravel') }}
    </title>
    <link rel="icon" type="image/x-icon" href="{{ asset('template/html') }}/src/assets/img/favicon.ico" />
    <link href="{{ asset('template/html') }}/layouts/semi-dark-menu/css/light/loader.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('template/html') }}/layouts/semi-dark-menu/css/dark/loader.css" rel="stylesheet" type="text/css" />
    <script src="{{ asset('template/html') }}/layouts/semi-dark-menu/loader.js"></script>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{ asset('template/html') }}/src/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('template/html') }}/layouts/semi-dark-menu/css/light/plugins.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('template/html') }}/layouts/semi-dark-menu/css/dark/plugins.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link rel="stylesheet" type="text/css" href="{{ asset('template/html') }}/src/assets/css/light/elements/alert.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/html') }}/src/assets/css/dark/elements/alert.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/html') }}/src/plugins/src/table/datatable/datatables.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/html') }}/src/plugins/css/light/table/datatable/dt-global_style.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/html') }}/src/plugins/css/dark/table/datatable/dt-global_style.css">
    <script src="https://unpkg.com/feather-icons"></script>
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

    <style>
        body.dark .layout-px-spacing,
        .layout-px-spacing {
            min-height: calc(100vh - 155px) !important;
        }
    </style>

    @livewireStyles

    @stack('styles')

</head>

<body class="layout-boxed">

    <!-- BEGIN LOADER -->
    <div id="load_screen">
        <div class="loader">
            <div class="loader-content">
                <div class="spinner-grow align-self-center"></div>
            </div>
        </div>
    </div>
    <!--  END LOADER -->

    <!--  BEGIN NAVBAR  -->
    <x-navbar />
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN SIDEBAR  -->
        <x-sidebar />
        <!--  END SIDEBAR  -->

        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="middle-content container-xxl p-0">

                    <!-- BREADCRUMB -->
                    <div class="page-meta">
                        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                @forelse (request()->segments() as $current_uri)
                                    @if ($loop->first)
                                        <li class="breadcrumb-item">{{ strtoupper(str_replace('-', ' ', $current_uri)) }}</li>
                                    @elseif ($loop->last)
                                        <li class="breadcrumb-item active" aria-current="page">{{ strtoupper(str_replace('-', ' ', $current_uri)) }}</li>
                                    @else
                                        <li class="breadcrumb-item">{{ strtoupper(str_replace('-', ' ', $current_uri)) }}</li>
                                    @endif
                                @empty
                                @endforelse
                            </ol>
                        </nav>
                    </div>
                    <!-- /BREADCRUMB -->

                    <!-- CONTENT AREA -->
                    <div class="row layout-top-spacing">

                        <div class="col-md-12">
                        </div>

                        @yield('content')
                        {{ $slot ?? '' }}

                    </div>
                    <!-- CONTENT AREA -->

                </div>

            </div>

            <x-footer />

        </div>
        <!--  END CONTENT AREA  -->
    </div>
    <!-- END MAIN CONTAINER -->

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script type="text/javascript" src="https://unpkg.com/default-passive-events"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('template/html') }}/src/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('template/html') }}/src/plugins/src/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="{{ asset('template/html') }}/src/plugins/src/mousetrap/mousetrap.min.js"></script>
    <script src="{{ asset('template/html') }}/src/plugins/src/waves/waves.min.js"></script>
    <script src="{{ asset('template/html') }}/layouts/semi-dark-menu/app.js"></script>
    <script src="{{ asset('template/html') }}/src/assets/js/custom.js"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script type="text/javascript">
        feather.replace();
    </script>
    <script src="{{ asset('template/html') }}/src/plugins/src/table/datatable/datatables.js"></script>

    @livewireScripts

    @stack('scripts')
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
</body>

</html>
