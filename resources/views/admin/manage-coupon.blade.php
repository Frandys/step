@extends('layouts.admin.dashboard')
@section('section')
@section ('page_heading','Manage Coupon')
@include('message.message')
<div class="diash-wrap-white">
	<div class="dash-page register">
		<div class="row dash-top mb-2">
			<div class="col-md-8 dash-title">
				<h3 class="small-head">Manage Coupon</h3>
				<div class="form-group search">
					<input type="email" id="defaultLoginFormEmail" class="form-control " placeholder="Search by Name, Email Id">
				</div>
			</div>

            <a   href="{{url('admin/create_coupon').'/'.\Request::segment('3')}}" class="link create" >Create New
                Coupon
            </a>
		</div>
		<div class="dash-table in-shadow">
			<div class="user-table tat table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Required Step</th>
                        <th>Expire Date</th>
                        <th>Coupon Code</th>
                        <th>Coupon Point</th>
                         <th>Action</th>
                     </tr>
                    </thead>
                    <tbody>
                    @foreach($coupons as $coupon)
                    <tr>
                        <td>{{$coupon->title}}</td>
                        <td>{{$coupon->required_steps}}</td>
                        <td>{{date("Y-m-d", substr($coupon->expire_date, 0, 10))}}</td>
                        <td>{{$coupon->coupon_code}}</td>
                        <td>{{$coupon->coupon_point}}</td>
                        <td><a  class="link edit" href="{{url('admin/merchant_coupon/').'/'.encrypt($coupon->id).'/edit '}}"><img src="http://localhost/step/public/assets/admin/images/edit.png" class="img-fluid">Edit
                            </a>
                        <button type="button" class="link announce  edit" data-id="{{$coupon->id}}" data-toggle="modal" data-target="#deleteMerchant"><img src="http://localhost/step/public/assets/admin/images/delete.png" class="img-fluid">Delete
                            </button></td>
                    </tr>
                    @endforeach
                    </tbody>

                </table>
			</div>
		</div>
	</div>
</div>
<div class="modal fade maiilModal" id="deleteMerchant" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Merchant</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-wrap">

                    <div class="mfooter delete">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <a data-method="delete" style="cursor:pointer;" onclick="$(this).find('form').submit();">Delete
                            <form action="{{url('admin/merchant_coupon/delete')}}" method="POST"  style="display:none">
                                <input type="hidden" id="delete" name="delete" value="">
                                <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                            </form>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@push('scripts')
	<script>
        $(document).ready(function(){
            $(".announce").click(function(){ // Click to only happen on announce links

                $("#delete").val($(this).data('id'));
                $('#deleteMerchant').modal('show');
            });
        });
        $(document).ready(function() {
            $('#example').DataTable();
        } );
        $(document).ready(function () {

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