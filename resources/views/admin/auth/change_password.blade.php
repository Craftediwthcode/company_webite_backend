@extends('admin.layouts.app')
@section('title')
    {{ 'Change Password' }}
@endsection
@section('content')
    <style>
        input[type="password"]::-ms-reveal,
        input[type="password"]::-ms-clear {
            display: none;
        }

        .error {
            order: 3;
            width: 100%;
            margin-bottom: 10px;
        }
    </style>
    <div class="py-3 py-lg-4">
        <div class="row">
            <div class="col-lg-6">
                <h4 class="page-title mb-0">{{ __('Change Password')}}</h4>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <div class="col-12">
                        <div class="p-2">
                            <form class="form-horizontal" id="chanage-passwordForm">
                                <div class="mb-2 row form-group">
                                    <label class="col-md-5 col-form-label" for="simpleinput">{{ __('Current Password')}}<span class="text-danger fs-4 fw-bold">*</span></label>
                                    <div class="col-md-7">
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="current_password"
                                                name="current_password" placeholder="{{ __('Current Password')}}" maxlength="50">
                                            <span class="input-group-text"><i class="fa fa-eye"
                                                    id="togglecurrent_password"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-2 row form-group">
                                    <label class="col-md-5 col-form-label" for="example-email">{{ __('New Password')}}<span class="text-danger fs-4 fw-bold">*</span></label>
                                    <div class="col-md-7">
                                        <div class="input-group">
                                            <input type="password" id="new_password" name="new_password"
                                                class="form-control" placeholder="{{ __('New Password')}}" maxlength="50">
                                            <span class="input-group-text"><i class="fa fa-eye"
                                                    id="togglenew_password"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-2 row form-group">
                                    <label class="col-md-5 col-form-label" for="example-email">{{ __('Confirm New Password')}}<span class="text-danger fs-4 fw-bold">*</span></label>
                                    <div class="col-md-7">
                                        <div class="input-group">
                                            <input type="password" name="confirm_password" class="form-control"
                                                placeholder="{{ __('Confirm New Password')}}" maxlength="50" id="confirm_password">
                                            <span class="input-group-text"><i class="fa fa-eye"
                                                    id="toggleconfirm_password"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-2 row">
                                    <div class="col-md-12 text-end">
                                        <a href="{{ route('dashboard') }}"
                                            class="btn btn-outline-warning waves-effect waves-light">{{ __('Cancel')}}</a>
                                        <button id="submit" class="btn btn-primary" dir="ltr"
                                            data-style="expand-left">
                                            <span class="ladda-label">
                                                {{ __('Submit')}}
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $('#togglecurrent_password').on('click', function() {
                $(this).toggleClass("fa-eye fa-eye-slash");
                var input = $("#current_password");
                input.attr('type', input.attr('type') === 'password' ? 'text' : 'password');
            });
            $('#togglenew_password').on('click', function() {
                $(this).toggleClass("fa-eye fa-eye-slash");
                var input = $("#new_password");
                input.attr('type', input.attr('type') === 'password' ? 'text' : 'password');
            });
            $('#toggleconfirm_password').on('click', function() {
                $(this).toggleClass("fa-eye fa-eye-slash");
                var input = $("#confirm_password");
                input.attr('type', input.attr('type') === 'password' ? 'text' : 'password');
            });
            //form validation
            $('#chanage-passwordForm').validate({
                rules: {
                    current_password: {
                        required: true,
                        minlength: 8,
                        maxlength: 50,
                    },
                    new_password: {
                        required: true,
                        minlength: 8,
                        maxlength: 50,
                        pattern: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]{8,50}$/
                    },
                    confirm_password: {
                        required: true,
                        minlength: 8,
                        maxlength: 50,
                        equalTo: "#new_password"
                    }
                },
                messages: {
                    current_password: {
                        required: "{{ __('The current password field is required.')}}",
                        minlength: "{{ __('The current password field must be at least 8 characters.')}}"
                    },
                    new_password: {
                        required: "{{ __('The new password field is required.')}}",
                        minlength: "{{ __('The new password field must be at least 8 characters.')}}",
                        pattern: "{{ __('The new password must contain at least one uppercase letter, one lowercase letter, one digit, and one special character.')}}"
                    },
                    confirm_password: {
                        required: "{{ __('The confirm password field is required.')}}",
                        minlength: "{{ __('The confirm password field must be at least 8 characters.')}}",
                        equalTo: "{{ __('New password and confirm password are not same.')}}"
                    },
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
                submitHandler: function(form, event) {
                    event.preventDefault();
                    document.getElementById('submit').disabled = true;
                    var laddaButton = Ladda.create(document.getElementById('submit'));
                    laddaButton.start();
                    setTimeout(function() {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                    'content')
                            },
                            url: "{{ route('submit-change-password') }}",
                            type: "POST",
                            dataType: 'json',
                            data: new FormData(form),
                            processData: false,
                            cache: false,
                            contentType: false,
                            success: function(response) {
                                if (response.success) {
                                    document.getElementById('submit').disabled =
                                        false;
                                    laddaButton.stop();
                                    $(form).trigger("reset");
                                    toastr.success(response.success);
                                    setTimeout(function() {
                                        window.location.href =
                                            "{{ url('admin') }}";
                                    }, 2000);
                                } else if (response.error) {
                                    laddaButton.stop();
                                    document.getElementById('submit').disabled =
                                        false;
                                    toastr.error(response.error);
                                }
                            }
                        });
                    }, 1000);
                }
            });
        });
    </script>
@endpush
