@extends('admin.layouts.login')
@section('title')
    {{ 'Reset Password' }}
@endsection
@section('content')
<div class="row justify-content-end">
    <div class="col-xl-4 col-md-5">
        <div class="card">
            <div class="card-body p-4">
                <div class="text-center w-75 mx-auto auth-logo mb-4">
                    <a href="{{ route('admin') }}" class="logo-dark">
                        <span><img src="{{ URL::asset('assets/backend/images/logo-d.png')}}" alt="" height="32"></span>
                    </a>
                    <a href="{{ route('admin') }}" class="logo-light">
                        <span><img src="{{ URL::asset('assets/backend/images/logo-l.png')}}" alt="" height="32"></span>
                    </a>
                </div>
                <form id="resetPasswordForm" action="{{ route('submit-reset-password')}}" method="POST">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="form-group mb-3">
                        <label class="form-label" for="password">Password</label>
                        <input class="form-control" type="password" id="password" name="password" required="" placeholder="Password" maxlength="15">
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="confirm_password">Confirm Password</label>
                        <input class="form-control" type="password" name="confirm_password" required="" placeholder="Confirm Password" maxlength="15">
                    </div>
                    <div class="form-group mb-0 text-center">
                        <button class="btn btn-primary w-100" type="submit">Reset Password</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12 text-center">
                <p class="text-white-50">Already have an account ? <a href="{{ route('admin')}}" class="text-white font-weight-medium ms-1">Log In</a></p>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $('#resetPasswordForm').validate({
                rules: {
                    password: {
                        required: true,
                        minlength: 8,
                        maxlength: 15,
                        pattern: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]{8,15}$/
                    },
                    confirm_password: {
                        required: true,
                        minlength: 8,
                        maxlength: 15,
                        equalTo: "#password"
                    }
                },
                messages: {
                    password: {
                        required: "The new password field is required.",
                        minlength: "The new password field must be at least 8 characters.",
                        pattern: "The new password must contain at least one uppercase letter, one lowercase letter, one digit, and one special character."
                    },
                    confirm_password: {
                        required: "The confirm password field is required.",
                        minlength: "The confirm password field must be at least 8 characters.",
                        equalTo: "New password and confirm password are not same."
                    },
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
