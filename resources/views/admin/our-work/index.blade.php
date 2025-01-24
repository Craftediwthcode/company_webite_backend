@extends('admin.layouts.app')
@section('title')
    {{ 'Our Work List' }}
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mt-2">
                <div class="card-body">
                    <div class="py-3 py-lg-4">
                        <div class="row">
                            <div class="col-lg-6">
                                <h4 class="page-title mb-0">{{ __('Our Work List') }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <table id="our-work-table" class="table table-striped dt-responsive table-word-warp w-100">
                                        <thead class="text-center">
                                            <tr>
                                                <th>{{ __('Date') }}</th>
                                                <th>{{ __('Action') }}</th>
                                                <th>{{ __('Title') }}</th>
                                                <th>{{ __('Count') }}</th>
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
            table = $('#our-work-table').DataTable({
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
                    url: "{{ route('our-work.ajaxTable') }}"
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
                        data: 'title',
                        name: 'title',
                        searchable: true,
                        orderable: true,
                        defaultContent: 'NA'
                    },
                    {
                        data: 'count',
                        name: 'count',
                        searchable: false,
                        orderable: false,
                        defaultContent: 'NA'
                    }
                ]
            });
            $.fn.dataTable.ext.errMode = 'none';
            $('#our-work-table').on('error.dt', function(e, settings, techNote, message) {
                console.log('An error has been reported by DataTables: ', message);
            })
        });
    </script>
@endpush
