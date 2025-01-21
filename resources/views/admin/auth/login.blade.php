@extends('admin.layouts.login')
@section('title')
    {{ 'Log In' }}
@endsection
@section('content')
<style>
    .error {
        order: 3;
        width: 100%;
        /* margin-bottom: 10px; */
    }
</style>
    <div class="row justify-content-end">
        <div class="col-xl-4 col-md-5">
            <div class="card">
                <div class="card-body p-4">
                    <div class="text-center w-75 mx-auto auth-logo mb-4">
                        <a href="{{ route('admin') }}" class="logo-dark">
                            <span><img src="{{ URL::asset('assets/backend/images/logo.svg') }}" alt=""
                                    height="70"></span>
                        </a>
                        <a href="{{ route('admin') }}" class="logo-light">
                            <span><img src="{{ URL::asset('assets/backend/images/logo.svg') }}" alt=""
                                    height="70"></span>
                        </a>
                    </div>
                    <form id="login-form" action="{{ route('submit-login') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label class="form-label" for="emailaddress">{{ __('Email Address')}}</label>
                            <div class="input-group">
                            <input class="form-control" type="email" id="email" name="email" value="{{ old('email') }}" maxlength="100"
                                placeholder="Enter your email">
                                <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                </div>
                        </div>
                        <div class="form-group mb-3">
                            <label class="col-form-label" for="example-email">{{ __('Password')}}</label>
                                <div class="input-group">
                                    <input type="password" id="password" name="password"
                                        class="form-control" placeholder="{{ __('Password')}}" maxlength="15">
                                    <span class="input-group-text"><i class="fa fa-eye"
                                            id="togglepassword"></i></span>
                                </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="">
                                <input class="form-check-input" type="checkbox" id="checkbox-signin" checked>
                                <label class="form-check-label ms-2" for="checkbox-signin">Remember me</label>
                            </div>
                        </div>
                        <div class="form-group mb-0 text-center">
                            <button class="btn btn-primary w-100" type="submit"> Log In </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12 text-center">
                    <p class="text-white-50"> <a href="{{ route('forgot-password')}}" class="text-white-50 ms-1">Forgot your
                            password?</a></p>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $('#togglepassword').on('click', function() {
                $(this).toggleClass("fa-eye fa-eye-slash");
                var input = $("#password");
                input.attr('type', input.attr('type') === 'password' ? 'text' : 'password');
            });
            $('#login-form').validate({
                rules: {
                    email: {
                        required: true
                    },
                    password: {
                        required: true
                    },
                },
                messages: {
                    email: {
                        required: "The email field is required."
                    },
                    password: {
                        required: "The password field is required."
                    }
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
@endpush
