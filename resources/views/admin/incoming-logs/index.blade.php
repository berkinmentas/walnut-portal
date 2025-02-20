@extends('admin.layouts.layout')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Incoming Logs</h5>
            </div>
            <div class="card-body">
                <table class="table table-datatable w-100">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Email</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

    @push('js-stack')
        <script>
            window.addEventListener('DOMContentLoaded', function () {
                let tableList = window.tableList = $('.table-datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    lengthChange: false,
                    ajax: {
                        url: '{{ route('admin.incomingLogs.datatable') }}',
                        type: 'POST',
                        data: function () {
                        },
                    },
                    order: [[0, "asc"]],
                    pageLength: 15,
                    columns: [
                        {"data": "id"},
                        {"data": "incoming_log_id"},
                        {"data": "status"},
                        {"data": "actions"}
                    ],
                    columnDefs: [
                        {targets: 'no-sort', orderable: false},
                        {searchable: false, targets: [0, 1]}
                    ]
                });

                tableList.on('preXhr', function (evt, settings) {
                    if (settings.jqXHR) {
                        settings.jqXHR.abort();
                    }
                });
                document.querySelector('.datatable-search').addEventListener('keyup', _.debounce(function (e) {
                    tableList.search(this.value).draw();
                }, 300));
            });
        </script>
    @endpush
@endsection
