@extends('admin.layouts.app')
@section('title')
    {{ 'Add Page' }}
@endsection
@section('content')
    <style>
        input[type="file"]::-ms-reveal,
        input[type="file"]::-ms-clear {
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
                <h4 class="page-title mb-0">{{ __('Add Page') }}</h4>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <form class="form-horizontal" id="PageForm">
                    <div class="card-body">
                        <div class="mb-2 row">
                            <div class="col-md-6">
                                <label class="col-form-label" for="title">{{ __('Title') }}</label><span
                                    class="text-danger fs-4 fw-bold">*</span>
                                <input type="text" class="form-control" id="title" name="title"
                                    value="{{ old('title') }}" placeholder="{{ __('Title') }}" maxlength="50">
                            </div>
                        </div>
                        <div class="mb-2 row">
                            <div class="col-md-6">
                                <label class="col-form-label" for="image">{{ __('Main Image') }}</label>
                                <span class="text-danger fs-4 fw-bold">*</span>
                                <input type="file" class="form-control" id="image" name="image"
                                    onchange="fileValidation(this, 'image_preview')">
                            </div>
                            <div class="col-sm-6">
                                <div class="mt-3">
                                    <img id="image_preview" src="{{ URL::asset('assets/placeholder.jpg') }}" alt="image"
                                        class="img-fluid avatar-xl rounded mt-2" style="cursor: pointer;">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="col-form-label" for="banner_image">{{ __('Banner Image') }}</label>
                                <span class="text-danger fs-4 fw-bold">*</span>
                                <input type="file" class="form-control" id="banner_image" name="banner_image"
                                    onchange="fileValidation(this, 'banner_image_preview')">
                            </div>
                            <div class="col-sm-6">
                                <div class="mt-3">
                                    <img id="banner_image_preview" src="{{ URL::asset('assets/placeholder.jpg') }}"
                                        alt="image" class="img-fluid avatar-xl rounded mt-2" style="cursor: pointer;">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label class="col-form-label" for="summernote">{{ __('Description') }}</label><span
                                    class="text-danger fs-4 fw-bold">*</span>
                                <textarea name="description" id="summernote" class="form-control"></textarea>
                            </div>
                            <div class="mt-2 row">
                                <div class="col-md-12 text-end">
                                    <a href="{{ route('page.index') }}" type="button"
                                        class="btn btn-outline-warning btn-sm waves-effect waves-light">{{ __('Cancel') }}</a>
                                    <button id="submit" class="btn btn-primary btn-sm" dir="ltr"
                                        data-style="expand-left">
                                        <span class="ladda-label">{{ __('Submit') }}</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                tabsize: 2,
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'picture', 'video']],
                    ['table', ['table']],
                    ['view', ['codeview', 'help']]
                ],
                callbacks: {
                    onKeydown: function(e) {
                        var t = e.currentTarget.innerText;
                        if (t.length >= 500) {
                            if (e.keyCode != 8) e
                                .preventDefault();
                        }
                    }
                }
            });
            $.validator.addMethod("noTwoSpaces", function(value, element) {
                return !/\s{2,}/.test(value);
            }, "{{ __('No double spaces permitted.') }}");
            $.validator.addMethod("noSpaceAtStart", function(value, element) {
                return this.optional(element) || /^\S/.test(value);
            }, "{{ __('No leading space allowed.') }}");
            // jQuery Validate settings
            $('#PageForm').validate({
                rules: {
                    title: {
                        required: true,
                        lettersonly: true,
                        noSpaceAtStart: true,
                        noTwoSpaces: true,
                        minlength: 2,
                        maxlength: 50,
                        remote: {
                            url: "{{ route('page.checkUniqueTitle') }}",
                            type: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                name: function() {
                                    return $('#title').val();
                                },
                                title_id: function() {
                                    return $('#title_id').val();
                                }
                            },
                            dataFilter: function(data) {
                                var jsonData = JSON.parse(data);
                                return !jsonData.exists;
                            }
                        }
                    },
                    image: {
                        required: false,
                        extension: "jpeg,png,jpg",
                        maxlength: 2048
                    },
                    banner_image: {
                        required: false
                    },
                    description: {
                        required: false
                    }
                },
                messages: {
                    title: {
                        required: "{{ __('The title field is required.') }}",
                        lettersonly: "{{ __('Please enter a title containing only letters.') }}",
                        remote: "{{ __('The title has already been taken.') }}",
                        minlength: "{{ __('Please enter at least 2 characters.') }}",
                    },
                    image: {
                        required: "{{ __('The image field is required.') }}",
                        extension: "{{ __('Only JPEG, PNG, and JPG formats are allowed.') }}",
                        maxlength: "{{ __('File size must be less than 2MB.') }}"
                    },
                    banner_image: {
                        required: "{{ __('The banner image field is required.') }}",
                    },
                    description: {
                        required: "{{ __('The description field is required.') }}",
                    }
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
                errorPlacement: function(error, element) {
                    if (element.hasClass('select2-hidden-accessible')) {
                        // Place the error message after the Select2 container
                        error.insertAfter(element.next('.select2-container'));
                    } else {
                        // Default placement for other elements
                        error.insertAfter(element);
                    }
                },
                submitHandler: function(form, event) {
                    event.preventDefault();
                    document.getElementById('submit').disabled = true;
                    var laddaButton = Ladda.create(document.getElementById('submit'));
                    laddaButton.start();
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ route('page.store') }}",
                        type: "POST",
                        dataType: 'json',
                        data: new FormData(form),
                        processData: false,
                        cache: false,
                        contentType: false,
                        success: function(response) {
                            if (response.success) {
                                document.getElementById('submit').disabled = false;
                                laddaButton.stop();
                                $(form).trigger("reset");
                                toastr.success(response.success);
                                setTimeout(function() {
                                    window.location.href =
                                        "{{ route('page.index') }}";
                                }, 2000);
                            } else if (response.error) {
                                laddaButton.stop();
                                document.getElementById('submit').disabled = false;
                                toastr.error(response.error);
                            }
                        }
                    });
                }
            });
        });

        function fileValidation(inputElement, previewId) {
            const file = inputElement.files[0];
            const allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
            const defaultPlaceholder = "{{ URL::asset('assets/placeholder.jpg') }}";
            if (!file) {
                resetImagePreview(previewId, defaultPlaceholder);
                return;
            }
            if (!allowedExtensions.test(file.name)) {
                toastr.error("{{ __('The image must be a file of type: jpeg, jpg, png.') }}");
                inputElement.value = '';
                resetImagePreview(previewId, defaultPlaceholder);
                return;
            }
            if (file.size > 2048 * 1024) {
                toastr.error("{{ __('File size must be less than 2MB.') }}");
                inputElement.value = '';
                resetImagePreview(previewId, defaultPlaceholder);
                return;
            }
            const reader = new FileReader();
            reader.onload = (e) => {
                document.getElementById(previewId).setAttribute('src', e.target.result);
            };
            reader.readAsDataURL(file);
        }

        function resetImagePreview(previewId, placeholder) {
            document.getElementById(previewId).setAttribute('src', placeholder);
        }
    </script>
@endpush
