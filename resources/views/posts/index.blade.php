@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Posts</div>

                    <div class="card-body table-responsive">
                        <table id="datatable" class="table table-hover">
                            <thead class="">
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Post Title</th>
{{--                                <th>Post Body</th>--}}
{{--                                <th>Action</th>--}}
                            </tr>
                            </thead>
                            <tbody></tbody>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-js')

    <script>
        $(document).ready( function () {

            $('#datatable').DataTable({
                "dom": "<'row mb-3'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'B><'col-sm-12 col-md-4'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('get-posts-data') }}",
                "columns": [
                    {"data": "first_name"},
                    {"data": "last_name"},
                    {"data": "title"},
                    // {"data": "body"},
                    // {"data": ""},
                ],
                buttons: [
                    'copy', 'excel', 'pdf'
                ]
            });
        } );
    </script>

@endsection
