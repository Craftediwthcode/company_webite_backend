@extends('admin.layouts.login')
@section('title')
    {{ 'Forgot Password' }}
@endsection
@section('content')
    <div class="row justify-content-end">
        <div class="col-xl-4 col-md-5">
            <div class="card">
                <div class="card-body p-4">
                    <div class="text-center w-75 mx-auto auth-logo mb-4">
                        <a href="{{ route('admin') }}" class="logo-dark">
                            <span><img src="{{ URL::asset('assets/backend/images/logo-d.png') }}" alt=""
                                    height="32"></span>
                        </a>
                        <a href="{{ route('admin') }}" class="logo-light">
                            <span><img src="{{ URL::asset('assets/backend/images/logo-l.png') }}" alt=""
                                    height="32"></span>
                        </a>
                    </div>
                    <form id="forgotForm" action="{{ route('submit-forgot-password') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label class="form-label" for="emailaddress">Email address</label>
                            <input class="form-control" type="email" id="emailaddress" name="email"
                                placeholder="Enter your email">
                        </div>
                        <div class="form-group mb-0 text-center">
                            <button class="btn btn-primary w-100" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12 text-center">
                    <p class="text-white-50">Already have an account ? <a href="{{ route('admin') }}"
                            class="text-white font-weight-medium ms-1">Log In</a></p>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $('#forgotForm').validate({
                rules: {
                    email: {
                        required: true
                    }
                },
                messages: {
                    email: {
                        required: "The email field is required."
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
