@extends('layouts.admin.dashboard')
@section('section')
@section ('page_heading','Manage Tickets')

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
									<div class="form-check-inline">
										<label class="form-check-label">
											<input type="radio" id="pen" checked value="0" class="form-check-input" name="pen" >All
										</label>
									</div>
									<div class="form-check-inline">
										<label class="form-check-label">
											<input type="radio" id="pen" value="1" class="form-check-input" name="pen">Pending
										</label>
									</div>
								</div>
							</div>
							<div class="dash-table in-shadow">
								<div class="user-table tat table-responsive">
									<table class="table user" id="users-table">
										 <thead>
											<tr class="row-name">
											   <th>SrNo.</th>
												<th>Title</th>
												<th>Question</th>
											   <th>Status</th>
											   <th>Date Created</th>
											   <th>Last Reply</th>
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

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });
        var value = $("form input[type='radio']:checked").val();
        oTableen =   $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ url("/admin/view_ticket")}}',
                method: 'POST',

                data: function (d) {
                    d.user_id = $('input[name="pen"]:checked').val();

                },

            },
            columns: [
                { data: 'DT_Row_Index', name: 'DT_Row_Index' },
                {data: 'title', name: 'title'},
                {data: 'question', name: 'question'},
                {data: 'status', name: 'status'},
                {data: 'updated_at', name: 'updated_at'},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false}

            ],

        });


        $("input[name='pen']").click(function() {
            oTableen.draw();
            e.preventDefault();
        });


	</script>
@endpush
@stop