@extends('admin.layouts.app')
@section('title')
    {{ 'Edit Our Work' }}
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
                <h4 class="page-title mb-0">{{ __('Edit Our Work') }}</h4>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <form class="form-horizontal" id="editOurWork">
                    <input type="hidden" name="_method" value="PUT">
                    <div class="card-body">
                        <div class="mb-2 row">
                            <div class="col-md-4">
                                <label class="col-form-label" for="title">{{ __('Title') }}</label><span
                                class="text-danger fs-4 fw-bold">*</span>
                                <input type="text" class="form-control" id="title" name="title"
                                    value="{{ old('title') }}" placeholder="{{ __('Title') }}">
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label" for="count">{{ __('Count') }}</label><span
                                class="text-danger fs-4 fw-bold">*</span>
                                <input type="text" class="form-control"  name="count"
                                    value="{{ old('count') }}" placeholder="{{ __('Count') }}">
                            </div>
                            <div class="mt-2 row">
                                <div class="col-md-12 text-end">
                                    <a href="{{ route('our-work.index') }}" type="button"
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
    <script>
        $(document).ready(function() {
            $.validator.addMethod("noTwoSpaces", function(value, element) {
                return !/\s{2,}/.test(value);
            }, "{{ __('No double spaces permitted.') }}");
            $.validator.addMethod("noSpaceAtStart", function(value, element) {
                return this.optional(element) || /^\S/.test(value);
            }, "{{ __('No leading space allowed.') }}");
            // jQuery Validate settings
            $('#editOurWork').validate({
                rules: {
                    title: {
                        required: true,
                        lettersonly: false,
                        noSpaceAtStart: true,
                        noTwoSpaces: true,
                        // minlength: 2,
                        // maxlength: 50,
                    },
                    count:{
                        required: true,
                        lettersonly: false,
                    }
                },
                messages: {
                    title: {
                        required: "{{ __('The title field is required.') }}",
                        lettersonly: "{{ __('Please enter a title containing only letters.') }}",
                        minlength: "{{ __('Please enter at least 2 characters.') }}",
                    },
                    count: {
                        required: "{{ __('The count field is required.') }}",
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
                        error.insertAfter(element.next('.select2-container'));
                    } else {
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
                        url: "{{ route('our-work.update', $module_data->id) }}",
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
                                        "{{ route('our-work.index') }}";
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
    </script>
@endpush
