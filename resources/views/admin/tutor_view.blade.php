@extends('layouts.admin.dashboard')
@section('page_heading','Tutor List')
@section('section')
    @include('message.message')

    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-md-offset-3 col-md-6">

                    <table class="table table-bordered" id="users-table">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Email</th>
                           <th>Created At</th>
                            <th>Updated At</th>
                            <th>Updated At</th>
                        </tr>
                        </thead>
                    </table>

                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $(document).ready(function () {
                oTable = $('#users-table').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": "{{ url('/admin/view_tutors') }}",
                    "columns": [
                        {data: 'id', name: 'id'},
                        {data: 'email', name: 'email'},
                         {data: 'created_at', name: 'created_at'},
                        {data: 'updated_at', name: 'updated_at'},
                        {data: 'name', name: 'roles.name'},


                    ]
                });
            });
        </script>
    @endpush
@stop
