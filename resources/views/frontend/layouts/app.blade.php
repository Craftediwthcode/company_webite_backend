<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crafted With Code | @yield('title')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link href="{{ asset('assets/frontend/css/bootstrap-icons.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/frontend/scss/style.css')}}">
    <link href="{{ asset('assets/backend/css/toastr.min.css') }}" rel="stylesheet" type="text/css">
</head>

<body>
<!--header-->
@include('frontend.layouts.header')
@yield('content')
 <!---footer--->
 @include('frontend.layouts.footer')
</body>
@stack('plugin-scripts')
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
<script src="{{ asset('assets/backend/js/toastr.min.js') }}"></script>
@stack('js')
<script>
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
</html>