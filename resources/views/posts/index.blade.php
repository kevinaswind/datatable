@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Posts</div>

                    <div class="card-body table-responsive">
                        <div class="row px-3 py-4 mb-5 bg-light">
                            <div class="col-md-4">
                                Filter:
                                <select class="form-control custom-select" name="filter-date" id="filter-date">
                                    <option value="">-- all entries --</option>
                                    <option value="7">Last 7 days</option>
                                    <option value="14">Last 14 days</option>
                                    <option value="30">Last 30 days</option>
                                </select>
                            </div>

                        </div>
                        <table id="datatable" class="table table-hover">
                            <thead class="">
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Post Title</th>
                                <th>Post Time</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                            <tr>
                                <td><input type="text" class="form-control filter-input" data-column="0"
                                           placeholder="Search for first name"/></td>
                                <td><input type="text" class="form-control filter-input" data-column="1"
                                           placeholder="Search for last name"/></td>
                                <td><input type="text" class="form-control filter-input" data-column="2"
                                           placeholder="Search for post title"/></td>
                            </tr>
                            </tfoot>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-js')

    <script>
        $(document).ready(function () {

            let table = $('#datatable').DataTable({
                "ajax": {
                    "url": "{{ route('get-posts-data') }}",
                    "data": function (d) {
                        d.date_filter = $("#filter-date").val();
                    }
                },
                "columns": [
                    {"data": "first_name"},
                    {"data": "last_name"},
                    {"data": "title"},
                    {"data": "created_at"},
                    {"data": "", "searchable": false},
                    // {"data": ""},
                ],
                columnDefs: [
                    {
                        targets: -1,
                        render: function (data, type, row) {
                            return `<a href="/{{ request()->segment(1) }}/${row['uuid']}/edit"><i class="fa fa-pencil"></i></a>` +
                                `<form action="/{{ request()->segment(1) }}/${row['uuid']}" method="POST">` +
                                `<input type="hidden" name="_method" value="DELETE" />` +
                                `<input type="hidden" name="_token" value="{{ csrf_token() }}" />` +
                                `<input type="submit" value="Delete" />` +
                                '</form>'
                        }
                    }
                ],
                "order": [[1, 'asc'], [0, 'asc']]
            });

            $(".filter-input").keyup(function () {
                table.column($(this).data('column'))
                    .search($(this).val())
                    .draw();
            });

            $(".filter-select").change(function () {
                table.column($(this).data('column'))
                    .search($(this).val())
                    .draw();
            });

            $("#filter-date").change(function () {
                table.draw();
            })
        });
    </script>

@endsection
