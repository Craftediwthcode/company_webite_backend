<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Crafted With Code | @yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta content="thread" name="description" />
    <meta content="Thread" name="author" />

    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <link rel="shortcut icon" href="{{ URL::asset('assets/backend/images/fav-icon.png') }}">
    <link href="{{ URL::asset('assets/backend/libs/morris.js/morris.css') }}" rel="stylesheet" type="text/css') }}" />
    <link href="{{ URL::asset('assets/backend/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link rel="stylesheet" href="{{ URL::asset('assets/backend/css/bootstrap-switch.min.css') }}">
    <link href="{{ URL::asset('assets/backend/libs/ladda/ladda.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/backend/libs/ladda/ladda-themeless.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ URL::asset('assets/backend/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/backend/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/backend/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/backend/libs/select2/css/select2.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link rel="stylesheet" href="{{ URL::asset('assets/backend/css/daterangepicker.css') }}">
    <link href="{{ URL::asset('assets/backend/css/style.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('assets/backend/css/icons.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('assets/css/custom.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('assets/backend/css/toastr.min.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ URL::asset('assets/backend/js/config.js') }}"></script>
    <style>
        .select2-selection__clear {
            color: #d6cdce;
            font-size: 24px;
            font-weight: 500;
            margin-right: 20px;
            transition: all .2s ease-in-out;
        }

        .select2-selection__clear:hover {
            color: #dc3545;
            font-size: 24px;
            font-weight: 500;
            margin-right: 20px;
        }

        .cancelBtn {
            color: red !important;
            font-size: 24px;
            font-weight: 500;
            transition: all .2s ease-in-out;
            position: absolute;
            top: 36px;
            margin-left: 28%;
        }

        .cancelBtn:hover {
            color: #dc3545 !important;
            cursor: pointer;
            font-size: 24px;
            font-weight: 500;
        }

        .table-word-warp {
            width: 100%;
            white-space: normal !important;
        }

        .sub-menu .menu-item.active>.menu-link {
            background-color: #9ac8f5;
            color: #007bff !important;
            border-radius: 4px;
        }

        .app-menu>.menu-item.active .menu-link {
            background-color: #9ac8f5;
            /* color: #007bff !important; */
            border-radius: 4px;
        }

        .app-menu .menu-item.active .menu-item>.menu-link {
            background-color: transparent;
        }

        .app-menu .menu-item .menu-item>.menu-link {
            background-color: transparent;
        }

        .app-menu .menu-item .menu-link {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            list-style: none;
            position: relative;
            color: var(--bs-menu-item-color);
            gap: var(--bs-menu-link-item-gap);
            -webkit-transition: all .25s ease-in-out;
            transition: all .25s ease-in-out;
            border-radius: var(--bs-border-radius);
            font-size: var(--bs-menu-item-font-size);
            padding: var(--bs-menu-link-padding-y) var(--bs-menu-link-padding-x);
        }

        a,
        button {
            outline: 0 !important;
        }

        a {
            /* color: rgba(var(--bs-link-color-rgb), var(--bs-link-opacity, 1)); */
            text-decoration: none;
        }

        *,
        ::after,
        ::before {
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
        }

        a:-webkit-any-link {
            /* color: -webkit-link; */
            cursor: pointer;
            text-decoration: none;
        }

        html.sidebar-enable:not([data-sidebar-size=full]) .main-menu .app-menu>.menu-item:hover>.menu-link>.menu-text {

            background: #9ac8f5;
            color: white !important;
        }

        .navbar-custom {
            background: white;
        }

        table.dataTable td,
        table.dataTable th {
            text-transform: capitalize !important;
        }

        .disable-color {
            box-shadow: inset 0 0 0 9999px rgba(0, 0, 0, 0.05);
        }

        div.dataTables_wrapper div.dataTables_length label {
            margin-bottom: 10px !important;
        }
        table.dataTable thead>tr>th.sorting:before,table.dataTable thead>tr>th.sorting:after{
            opacity:0.5;
        }
        table.dataTable thead>tr>th.sorting_asc:before,table.dataTable thead>tr>th.sorting_desc:after{
            opacity:6;
        }

    </style>
</head>

<body>
    <div class="layout-wrapper">
        <!-- ========== Left Sidebar ========== -->
        @include('admin.layouts.sidebar')
        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->
        <div class="page-content">
            <!-- ========== Topbar Start ========== -->
            @include('admin.layouts.navbar')
            <!-- ========== Topbar End ========== -->
            <div class="px-3">
                <!-- Start Content-->
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- container -->
            </div> <!-- content -->
            <!-- Footer Start -->
            @include('admin.layouts.footer')
            <!-- end Footer -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->
    </div>
    @stack('plugin-scripts')
    <script src="{{ URL::asset('assets/backend/js/pages/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('assets/backend/js/vendor.min.js') }}"></script>
    <script src="{{ URL::asset('assets/backend/js/app.js') }}"></script>
    <script src="{{ URL::asset('assets/backend/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/backend/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/backend/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/backend/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/backend/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/backend/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/backend/libs/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script src="{{ URL::asset('assets/backend/js/toastr.min.js') }}"></script>
    <script src="{{ URL::asset('assets/backend/libs/jquery-knob/jquery.knob.min.js') }}"></script>
    <script src="{{ URL::asset('assets/backend/libs/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ URL::asset('assets/backend/libs/morris.js/morris.min.js') }}"></script>
    <script src="{{ URL::asset('assets/backend/libs/raphael/raphael.min.js') }}"></script>
    <script src="{{ URL::asset('assets/backend/js/pages/dashboard.js') }}"></script>
    <script src="{{ URL::asset('assets/backend/libs/ladda/spin.min.js') }}"></script>
    <script src="{{ URL::asset('assets/backend/libs/ladda/ladda.min.js') }}"></script>
    <script src="{{ URL::asset('assets/backend/js/pages/loading-btn.js') }}"></script>
    <script src="{{ URL::asset('assets/js/jquery.validate.js') }}"></script>
    <script src="{{ URL::asset('assets/js/additional-methods.min.js') }}"></script>
    <script src="{{ URL::asset('assets/backend/js/bootstrap-switch.js') }}"></script>
    <script src="{{ URL::asset('assets/backend/libs/select2/js/select2.min.js') }}"></script>
    <script src="{{ URL::asset('assets/backend/js/moment.min.js') }}"></script>
    <script src="{{ URL::asset('assets/backend/js/daterangepicker.js') }}"></script>
    <script src="{{ URL::asset('assets/backend/js/pages/datatables.js') }}"></script>
    <script src="{{ URL::asset('assets/js/inputmask/inputmask.min.js') }}"></script>
    @stack('js')
    <script>
        document.documentElement.setAttribute('data-bs-theme', 'light');
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
        $(".amount").inputmask({
            'alias': 'numeric',
            min: 0,
            max: 9999999999,
            rightAlign: false,
            allowMinus: false,
            digits: 2
        });
    </script>
    @if (session()->has('success'))
        <script type="text/javascript">
            $(function() {
                toastr.success("{{ session()->get('success') }}");
            });
        </script>
    @endif
    @if (session()->has('error'))
        <script type="text/javascript">
            $(function() {
                toastr.error("{{ session()->get('error') }}");
            });
        </script>
    @endif
</body>

</html>
