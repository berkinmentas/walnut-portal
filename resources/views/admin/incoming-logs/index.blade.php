@extends('admin.layouts.layout')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Incoming Logs</h5>
            </div>
            <div class="card-body">
                <div class="row d-flex justify-content-end mb-3">
                    <div class="col-md-3">
                        <input type="date" id="startDate" class="form-control datepicker" placeholder="Start Date">
                    </div>
                    <div class="col-md-3">
                        <input type="date" id="endDate" class="form-control datepicker" placeholder="End Date">
                    </div>
                    <div class="col-md-2">
                        <button id="filterBtn" class="btn btn-primary w-100">Filter</button>
                    </div>
                </div>

                <table class="table table-datatable w-100">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Word Count</th>
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
                // DataTable başlat
                let tableList = window.tableList = $('.table-datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    lengthChange: false,
                    ajax: {
                        url: '{{ route('admin.incoming-logs.datatable') }}',
                        type: 'POST',
                        data: function (d) {
                            d.title = $('#searchTitle').val();
                            d.startDate = $('#startDate').val();
                            d.endDate = $('#endDate').val();
                        },
                    },
                    order: [[3, "desc"]],
                    pageLength: 15,
                    columns: [
                        {"data": "id"},
                        {"data": "title"},
                        {"data": "word_count"},
                        {"data": "created_at"},
                        {"data": "actions", orderable: false, searchable: false}
                    ],
                });

                // Filtreleme butonuna tıklanınca DataTable'ı yenile
                $('#filterBtn').click(function () {
                    tableList.ajax.reload();
                });

                // Tarih seçicileri başlat
                $('.datepicker').datepicker({
                    format: 'yyyy-mm-dd',
                    autoclose: true,
                    todayHighlight: true
                });

                // Arama kutusu için debounce ekle
                $('#searchTitle').keyup(_.debounce(function () {
                    tableList.ajax.reload();
                }, 500));
            });
        </script>
    @endpush
@endsection
