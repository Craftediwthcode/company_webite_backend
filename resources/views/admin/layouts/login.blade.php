<!DOCTYPE html>
<html lang="en" data-bs-theme="light" data-menu-color="brand" data-topbar-color="light">

<head>
    <meta charset="utf-8" />
    <title>Crafted With Code | @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Myra Studio" name="author" />
    <link rel="shortcut icon" href="{{ URL::asset('assets/backend/images/favicon.png') }}">
    <link href="{{ URL::asset('assets/backend/css/style.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('assets/backend/css/icons.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('assets/backend/css/toastr.min.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ URL::asset('assets/backend/js/config.js') }}"></script>
    <style>
        body {
            background-image: url('assets/backend/images/background_pic.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
</head>

<body class="bg-white d-flex justify-content-center align-items-center min-vh-100 p-5">
    <div class="container">
        @yield('content')
    </div>
    @stack('plugin-scripts')
    <script src="{{ URL::asset('assets/backend/js/pages/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('assets/backend/js/vendor.min.js') }}"></script>
    <script src="{{ URL::asset('assets/backend/js/toastr.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/jquery.validate.js') }}"></script>
    <script src="{{ URL::asset('assets/js/additional-methods.min.js') }}"></script>
    @stack('js')
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
    <script>
        window.onload = function() {
            document.documentElement.setAttribute('data-bs-theme', 'light');
        };
    </script>
</body>

</html>
