@extends('layouts.admin.dashboard')
@section('section')
@section ('page_heading','Manage User')
@include('message.message')
<div class="diash-wrap-white">
	<div class="dash-page register">
		<div class="row dash-top mb-2">
			<div class="col-md-8 dash-title">
				<h3 class="small-head">Users</h3>
				<div class="form-group search">
					<input type="email" id="defaultLoginFormEmail" class="form-control " placeholder="Search by Name, Email Id">
				</div>
			</div>

			<div class="col-md-4 text-right">
				<p>Last 7 days active users - <span>189</span></p>
			</div>
		</div>
		<div class="dash-table in-shadow">
			<div class="user-table tat table-responsive">
				<table class="table user" id="users-table">
					<thead>
					<tr class="row-name">
						<th>SrNo.</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Email</th>
						<th>Registration Date</th>
						<th>Action</th>
					</tr>
					</thead>
					<tbody>


					</tbody>
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
                "ajax": "{{ url('/admin/view_users') }}",
                "columns": [
                    { data: 'DT_Row_Index', name: 'DT_Row_Index' },
                    {data: 'first_name', name: 'first_name'},
                    {data: 'last_name', name: 'last_name'},
                    {data: 'email', name: 'email'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'actions', name: 'actions', orderable: false, searchable: false}

                ]
            });

            $(document).on('click', '#activateUser', function () {
                var answer = confirm('Are you sure you want to Block/Unblock ?');
                if (!answer)
                {
                    return 0;
                }
                $.ajax({
                    type: 'post',
                    url: "{{url('/admin/activate_users')}}",
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'id': $(this).val()
                    },
                    success: function (data) {
                        oTable.ajax.reload();
                    }
                });
            });
        });
	</script>
@endpush
@stop