@extends('admin.layouts.app')
@section('title')
    {{ 'Setting' }}
@endsection
@section('content')
    <div class="py-3 py-lg-4">
        <div class="row">
            <div class="col-lg-6">
                <h4 class="page-title mb-0">{{ __('Setting') }}</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3">Contact Support</h4>
                    <form role="form" id="supportForm" method="POST" action="{{ route('update.support') }}">
                        @csrf
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Email<span
                                    class="text-danger fs-4 fw-bold">*</span></label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fa fa-envelope"></i></div>
                                    <input type="text" class="form-control" name="email"
                                        value="{{ \App\Models\Setting::where('key', 'email')->value('value') ?? 'NA' }}"
                                        placeholder="Email">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputPassword3" class="col-sm-3 col-form-label">Contact No.<span
                                    class="text-danger fs-4 fw-bold">*</span></label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fa fa-phone"></i></div>
                                    <input type="text" class="form-control" name="phone"
                                        value="{{ \App\Models\Setting::where('key', 'phone')->value('value') ?? 'NA' }}"
                                        placeholder="Contact No.">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputPassword3" class="col-sm-3 col-form-label">Address.<span
                                    class="text-danger fs-4 fw-bold">*</span></label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fa fa-phone"></i></div>
                                    <input type="text" class="form-control" name="address"
                                        value="{{ \App\Models\Setting::where('key', 'address')->value('value') ?? 'NA' }}"
                                        placeholder="Address.">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputPassword3" class="col-sm-3 col-form-label">Facebook Url<span
                                    class="text-danger fs-4 fw-bold">*</span></label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-text"><i class="mdi mdi-facebook"></i></div>
                                    <input type="text" class="form-control" name="facebook_url"
                                        value="{{ \App\Models\Setting::where('key', 'facebook_url')->value('value') ?? 'NA' }}"
                                        placeholder="Facebook Url">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputPassword3" class="col-sm-3 col-form-label">Instagram Url<span
                                    class="text-danger fs-4 fw-bold">*</span></label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-text"><i class="mdi mdi-instagram"></i></div>
                                    <input type="text" class="form-control" name="instagram_url"
                                        value="{{ \App\Models\Setting::where('key', 'instagram_url')->value('value') ?? 'NA' }}"
                                        placeholder="Instagram Url">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputPassword3" class="col-sm-3 col-form-label">Linkedin Url<span
                                    class="text-danger fs-4 fw-bold">*</span></label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-text"><i class="mdi mdi-twitter"></i></div>
                                    <input type="text" class="form-control" name="linkedin_url"
                                        value="{{ \App\Models\Setting::where('key', 'linkedin_url')->value('value') ?? 'NA' }}"
                                        placeholder="Linkedin Url">
                                </div>
                            </div>
                        </div>
                        <div class="justify-content-end row">
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3">Logo Update</h4>
                    <form role="form" method="POST" action="{{ route('update.logo') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Logo Update<span
                                    class="text-danger fs-4 fw-bold">*</span></label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" name="logo_update" id="logo_update"
                                    accept="image/*" onchange="fileValidation()">
                            </div>
                            <div class="col-sm-4">
                                <div class="mt-3">
                                        <img id="logo_image_preview" src="{{ \App\Helpers\Helper::getImageUrl(\App\Models\Setting::where('key', 'logo')->value('value') ?? 'NA') }}" alt="image"
                                        class="img-fluid avatar-xl rounded mt-2" style="cursor: pointer;">
                                </div>
                            </div>
                        </div>
                        <div class="justify-content-end row">
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <link href="{{ asset('assets/backend/libs/mohithg-switchery/switchery.min.css') }}" rel="stylesheet"
        type="text/css" />
    <script src="{{ asset('assets/backend/libs/mohithg-switchery/switchery.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            //support validation
            $('#supportForm').validate({
                rules: {
                    email: {
                        required: true,
                        email: true,
                        pattern: /(.+)@(.+)\.(.+)/,
                    },
                    phone: {
                        required: true,
                        minlength: 9,
                        maxlength: 14,
                    },
                    address: {
                        required: true,
                    },
                    facebook_url: {
                        required: true,
                        pattern: /https?:\/\/(www\.)?[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b([-a-zA-Z0-9()@:%_\+.~#?&//=]*)/
                    },
                    instagram_url: {
                        required: true,
                        pattern: /https?:\/\/(www\.)?[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b([-a-zA-Z0-9()@:%_\+.~#?&//=]*)/
                    },
                    linkedin_url: {
                        required: true,
                        pattern: /https?:\/\/(www\.)?[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b([-a-zA-Z0-9()@:%_\+.~#?&//=]*)/
                    }
                },
                messages: {
                    email: {
                        required: "{{ __('The email field is required.') }}",
                        email: "{{ __('Please enter a valid email address.') }}",
                        pattern: "{{ __('Please enter a valid email address.') }}",
                    },
                    phone: {
                        required: "{{ __('The phone field is required.') }}",
                    },
                    facebook_url: {
                        required: "{{ __('The facebook url field is required.') }}",
                        pattern: "{{ __('Please enter a valid url.') }}"
                    },
                    instagram_url: {
                        required: "{{ __('The instagram url field is required.') }}",
                        pattern: "{{ __('Please enter a valid url.') }}"
                    },
                    linkedin_url: {
                        required: "{{ __('The linkedin url field is required.') }}",
                        pattern: "{{ __('Please enter a valid url.') }}"
                    }
                },
                errorPlacement: function(error, element) {
                    if (element.closest('.input-group').length) {
                        error.insertAfter(element.closest('.input-group'));
                    } else {
                        error.insertAfter(element);
                    }
                }
            });
        });

        function fileValidation(inputElement, previewId) {
            var fileInput = document.getElementById('logo_update');
            var filePath = fileInput.value;
            var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
            if (!allowedExtensions.exec(filePath)) {
                toastr.error("{{ __('The image must be a file of type: jpeg, jpg, png, gif.') }}");
                fileInput.value = '';
                return false;
            }
            if (fileInput.files[0].size > 5048 * 1024) {
                toastr.error("{{ __('File size must be less than 2MB.') }}");
                fileInput.value = '';
                return false;
            }
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#logo_image_preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(fileInput.files[0]);
        }
    </script>
@endpush
