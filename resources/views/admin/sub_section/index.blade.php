@extends('admin.layouts.app')
@section('title')
    {{ 'Sub Section List' }}
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mt-2">
                <div class="card-body">
                    <div class="d-flex gap-2 mb-2">
                        <a class="btn btn-primary waves-effect waves-light" data-bs-toggle="collapse" href="#collapseExample"
                            aria-expanded="true" aria-controls="collapseExample">
                            <i class="mdi mdi-filter"></i>{{ __('Filter') }}
                        </a>
                    </div>
                    <div class="collapse" id="collapseExample" style="">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="select-status">{{ __('Status') }}</label>
                                        <select class="form-control" id="status" name="status">
                                            <option value=""disabled selected>{{ __('Please Select') }}
                                            </option>
                                            <option value="active">{{ __('Active') }}</option>
                                            <option value="inactive">{{ __('Inactive') }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="py-3 py-lg-4">
                        <div class="row">
                            <div class="col-lg-6">
                                <h4 class="page-title mb-0">{{ __('Sub Section List') }}</h4>
                            </div>
                            <div class="col-lg-6">
                                <div class="d-none d-lg-block">
                                    <ol class="breadcrumb m-0 float-end">
                                        <li class="breadcrumb-item">
                                                <a href="{{ route('sub-section.create') }}"
                                                    class="btn btn-primary btn-sm waves-effect waves-light" style="color:white;"><i
                                                        class="fa fa-plus"></i>&nbsp; {{ __('Add') }}</a>
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <table id="sub-section-table" class="table table-striped dt-responsive table-word-warp w-100">
                                        <thead class="text-center">
                                            <tr>
                                                <th>{{ __('Date') }}</th>
                                                <th>{{ __('Action') }}</th>
                                                <th>{{ __('Status') }}</th>
                                                <th>{{ __('Title') }}</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.9/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.9/vfs_fonts.min.js"></script>
    <script type="text/javascript">
        //ajax Table
        let table = '';
        $(function() {
            table = $('#sub-section-table').DataTable({
                "language": {
                    "zeroRecords": "{{ __('No record(S) found.') }}",
                    searchPlaceholder: "{{ __('Search records') }}"
                },
                ordering: true,
                order: [0, 'desc'],
                paging: true,
                processing: false,
                serverSide: true,
                lengthChange: true,
                searchable: true,
                dom: 'lBfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ].map(function(format) {
                    return {
                        extend: format,
                        exportOptions: {
                            columns: [2,3,4,5],
                            format: {
                                body: function(data, row, column, node) {
                                    if (column === 0) {
                                        return $(data).find('input[type="checkbox"]').is(':checked') ?'Active' :'Inactive';
                                    }
                                    return data;
                                }
                            }
                        }
                    };
                }),
                lengthMenu: [
                    [10, 25, 100, 500, -1],
                    [10, 25, 100, 500, "All"]
                ],
                ajax: {
                    url: "{{ route('sub-section.ajaxTable') }}",
                    data: function(d) {
                        d.status = $('#status').val();
                    },
                },
                dataType: 'html',
                columns: [{
                        data: 'created_at',
                        name: 'created_at',
                        searchable: false,
                        orderable: true,
                        defaultContent: 'NA',
                        visible: false,
                    },
                    {
                        data: 'action',
                        name: 'action',
                        searchable: false,
                        orderable: false,
                        defaultContent: 'NA'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        searchable: false,
                        orderable: false,
                        defaultContent: 'NA'
                    },
                    {
                        data: 'title',
                        name: 'title',
                        searchable: true,
                        orderable: true,
                        defaultContent: 'NA'
                    }
                ],
                fnDrawCallback: function(oSettings, json) {
                    $("[name='my-checkbox']").bootstrapSwitch({
                        onText: "{{ __('Active') }}",
                        offText: "{{ __('Inactive') }}",
                        onSwitchChange: function(event, state) {
                            let switchId = event.target.id;
                            Swal.fire({
                                title: "{{ __('Are you sure?') }}",
                                text: "{{ __('Do you want to update the Status?') }}",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: "{{ __('Yes, update it!') }}",
                                cancelButtonText: "{{ __('Cancel') }}"
                            }).then(function(result) {
                                if (result.isConfirmed) {

                                    $.ajax({
                                        headers: {
                                            'X-CSRF-TOKEN': $(
                                                'meta[name="csrf-token"]'
                                            ).attr('content')
                                        },
                                        url: "{{ route('sub-section.changeStatus') }}",
                                        type: "POST",
                                        datatType: 'json',
                                        data: {
                                            'id': switchId.replace(
                                                'bs-switch', ''),
                                        },
                                        success: function(response) {
                                            if (response.success) {
                                                toastr.success(response
                                                    .success);
                                                table.ajax.reload();
                                            } else {
                                                toastr.success(response
                                                    .error);
                                                table.ajax.reload();
                                            }
                                        }
                                    });
                                } else {
                                    event.preventDefault();
                                    $('#' + switchId).bootstrapSwitch('toggleState',
                                        true);
                                }
                            });
                        }
                    });
                }
            });
            $('#status').on('change', function() {
                table.draw();
                window.scroll({
                    top: document.body.scrollHeight,
                    behavior: 'smooth'
                });
            });
            $.fn.dataTable.ext.errMode = 'none';
            $('#sub-section-table').on('error.dt', function(e, settings, techNote, message) {
                console.log('An error has been reported by DataTables: ', message);
            })
        });
        $(document).ready(function() {
            $('#status').select2({
                placeholder: "{{ __('Please Select') }}",
                allowClear: true,
            }).on('select2:unselecting', function() {
                $(this).data('unselecting', true);
            }).on('select2:opening', function(e) {
                if ($(this).data('unselecting')) {
                    $(this).removeData('unselecting');
                    e.preventDefault();
                    table.ajax.reload(null, false);
                }
            });
        });
    </script>
@endpush
