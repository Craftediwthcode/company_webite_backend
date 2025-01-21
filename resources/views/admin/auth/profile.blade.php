@extends('admin.layouts.app')
@section('title')
    {{ 'Profile' }}
@endsection
@section('content')
    <div class="py-3 py-lg-4">
        <div class="row">
            <div class="col-lg-6">
                <h4 class="page-title mb-0">{{ __('Edit Profile')}}</h4>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-8 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="p-2">
                        <form class="form-horizontal" id="profileForm">
                            <div class="mb-2 row">
                                <label class="col-md-5 col-form-label" for="name">{{ __('Name')}}<span class="text-danger fs-4 fw-bold">*</span></label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" name="name"
                                        value="{{ Auth::user()->name ?? 'NA' }}" placeholder="{{ __('Name')}}" maxlength="50">
                                </div>
                            </div>
                            <div class="mb-2 row">
                                <label class="col-md-5 col-form-label" for="email">{{ __('Email')}}<span class="text-danger fs-4 fw-bold">*</span></label>
                                <div class="col-md-7">
                                    <input type="email" name="email" value="{{ AUth::user()->email ?? 'NA' }}"
                                        class="form-control" placeholder="{{ __('Email')}}" maxlength="100">
                                </div>
                            </div>
                            <div class="mb-2 row">
                                <label class="col-md-5 col-form-label" for="mobile_number">{{ __('Mobile Number')}}<span class="text-danger fs-4 fw-bold">*</span></label>
                                <div class="col-md-7">
                                    <input type="number" name="mobile" value="{{ AUth::user()->mobile ?? 'NA' }}"
                                        class="form-control" placeholder="{{ __('Mobile Number')}}" maxlength="14">
                                </div>
                            </div>
                            <div class="mb-2 row">
                                <label class="col-md-5 col-form-label" for="image">{{ __('Profile Image')}}<span class="text-danger fs-4 fw-bold">*</span></label>
                                <div class="col-md-7">
                                    <input type="file" class="form-control" id="image" name="image"
                                        onchange="fileValidation();">
                                </div>
                                <div class="col-sm-7 text-end">
                                    <div class="mt-3">
                                        <img id="image_preview" src="{{ \App\Helpers\Helper::getImageUrl('uploads/user', Auth::user()->image) }}" alt="image"
                                         class="img-fluid avatar-xl rounded mt-2">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2 row">
                                <div class="col-md-12 text-end">
                                    <a href="{{ route('dashboard')}}"
                                        class="btn btn-outline-warning waves-effect waves-light">{{ __('Cancel')}}</a>
                                    <button id="submit" class="btn btn-primary" dir="ltr" data-style="expand-left">
                                        <span class="ladda-label">{{ __('Submit')}}</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        let isImageRequired = @json(Auth::user()->image ? false : true);
        $(document).ready(function() {
            $.validator.addMethod('indianPhone', function(value, element) {
                return this.optional(element) || /^([6-9]{1})\d{9}$/.test(value);
            }, "The mobile number format is invalid.");
            $.validator.addMethod("noTwoSpaces", function(value, element) {
                return !/\s{2,}/.test(value);
            }, "No double spaces permitted.");
            $.validator.addMethod("noSpaceAtStart", function(value, element) {
                return this.optional(element) || /^\S/.test(value);
            }, "No leading space allowed.");
            //form validation
            $('#profileForm').validate({
                rules: {
                    name: {
                        required: true,
                        lettersonly: true,
                        noSpaceAtStart: true,
                        noTwoSpaces: true,
                        minlength: 2,
                        maxlength: 50,

                    },
                    email: {
                        required: true,
                        email: true,
                        pattern: /(.+)@(.+)\.(.+)/,
                        remote: {
                            url: "{{ route('check.uniqueEmail')}}",
                            type: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                email: function() {
                                    return $('#email').val();
                                },
                            },
                            dataFilter: function(data) {
                                var jsonData = JSON.parse(data);
                                return !jsonData.exists;
                            }
                        }
                    },
                    mobile: {
                        required: true,
                        indianPhone: true,
                        minlength: 9,
                        maxlength: 14,
                    },
                    image:{
                        required: isImageRequired,
                        extension: "jpeg,png,jpg",
                        maxlength: 2048
                    }
                },
                messages: {
                    name: {
                        required: "{{ __('The name field is required.')}}",
                        lettersonly: "{{ __('Please enter a  name containing only letters.')}}"
                    },
                    email: {
                        required: "{{ __('The email field is required.')}}",
                        email: "{{ __('Please enter a valid email address.')}}",
                        pattern: "{{ __('Please enter a valid email address.')}}",
                        remote: "{{ __('The email has already been taken.')}}"
                    },
                    mobile: {
                        required: "{{ __('The mobile number field is required.')}}",
                        minlength: "{{ __('The mobile number must be at least 10 digits long.')}}",
                        maxlength: "{{ __('The mobile number must be no more than 14 digits long.')}}"
                    },
                    image:{
                        required: "{{ __('The image field is required.')}}",
                        extension: "{{ __('Only JPEG, PNG, and JPG formats are allowed.')}}",
                        maxlength: "{{ __('File size must be less than 2MB.')}}"
                    }
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
                            url: "{{ route('submit.profileUpdate') }}",
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
                                        "{{ route('dashboard') }}";
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

        function fileValidation() {
            var fileInput = document.getElementById('image');
            var filePath = fileInput.value;
            var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
            if (!allowedExtensions.exec(filePath)) {
                toastr.error("The image must be a file of type: jpeg, jpg, png.");
                fileInput.value = '';
                return false;
            }
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#image_preview').attr('src', e.target.result);
                $('#image-error').hide().removeClass('is-invalid');
            }
            reader.readAsDataURL(fileInput.files[0]);
        }
    </script>
@endpush
