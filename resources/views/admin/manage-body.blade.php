@extends('layouts.admin.dashboard')
@section('section')
@section ('page_heading','Manage Body')
<div class="diash-wrap-white">
	<div class="dash-page register">
		<div class="row dash-top mb-2">
			<div class="col-md-8 dash-title">
				<h3 class="small-head">Manage Body part</h3>
				<div class="form-group search">
					<input type="email" id="defaultLoginFormEmail" class="form-control " placeholder="Search by Name, Email Id">
				</div>
			</div>

            <button type="button" class="link create" data-toggle="modal" data-target="#addMerchant">Create New
                Body Part
            </button>
		</div>
        @include('message.message')

        <div class="dash-table in-shadow">
			<div class="user-table tat table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Slug</th>
                        <th>Description</th>
                        <th>Action</th>
                     </tr>
                    </thead>
                    <tbody>
                    @foreach($bodies as $body)
                    <tr>
                        <td>{{$body->title}}</td>
                        <td>{{$body->slug}}</td>
                         <td>{{$body->description}}</td>
                         <td>
                             <button type="button" class="link edits edit" data-infos="{{$body->id}},{{$body->title}},{{$body->slug}},{{$body->description}}" data-toggle="modal" data-target="#editMerchant"><img src="http://localhost/step/public/assets/admin/images/edit.png" class="img-fluid">Edit
                             </button>

                      <button type="button" class="link edit announce" data-id="{{$body->id}}" data-toggle="modal" data-target="#deleteMerchant"><img src="http://localhost/step/public/assets/admin/images/delete.png" class="img-fluid">Delete
                            </button>
                        </td>
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
                <h5 class="modal-title" id="exampleModalLabel">Delete Body part</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-wrap">
                     <div class="mfooter delete">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <a data-method="delete" style="cursor:pointer;" onclick="$(this).find('form').submit();">Delete
                            <form action="{{url('admin/body/delete')}}" method="POST"  style="display:none">
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


<div class="modal fade maiilModal" id="addMerchant" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Body Parts</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="text-wrap add-merchant">
                    <!-- Form -->
                    <form id="priviledge" class="" style="" method="post" action="">
                        <div class="row">

                            <input type="hidden" name="user_id" id="user_id" class="form-control">

                            <div class="col-sm-7">
                                <div class="md-form mt-0">
                                    <input type="text" name="title" placeholder="title" id="title" class="form-control">
                                    <label for="title">Title</label>
                                </div>


                                <div class="md-form mt-0">
                                    <input type="text" name="slug" id="slug" placeholder="slug" class="form-control">
                                    <label for="slug">Slug</label>
                                </div>


                                <div class="md-form mt-0">
                                    <textarea type="text" name="description" placeholder="description" id="description" class="form-control"></textarea>
                                    <label for="slug">Description</label>
                                </div>
                                <button class="btn" type="button" id="submitMar">Create</button>

                            </div>
                            <!-- Sign up button -->

                            <!-- Form -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@push('scripts')
	<script>
        $(document).ready(function() {
            $('#example').DataTable();
        } );

     $(".edits").click(function(){ // Click to only happen on announce links
    var details = $(this).data('infos').split(',');

    $('#user_id').val(details[0]);
    $('#title').val(details[1]);
    $('#slug').val(details[2]);
    $('#description').val(details[3]);
    $('#addMerchant').modal('show');
    });



    $(".create").click(function(){ // Click to only happen on announce links
    $('#user_id').val('');
    $('#title').val('');
    $('#slug').val('');
    $('#description').val('');
    });


    $("input[type='image']").click(function(e) {
    e.preventDefault();
    $("input[id='image']").click();
    });
    $(document).on('click', '#submitMar', function () {

    if ($('#user_id').val() == '') {
    var type = 'POST';
    var url = "{{url('/admin/body')}}"
    } else {
    var type = 'PUT';
    var url = "{{url('/admin/body/')}}" + '/' + $('#user_id').val();
    }
    $.ajax({
    type: type,
    url: url,
    data: {
    '_token': "{{ csrf_token() }}",
    'user_id': $('#user_id').val(),
    'title': $('#title').val(),
    'slug':  $('#slug').val(),
    'description':  $('#description').val(),
    },
    success: function (data) {
    if (data.success == '0'){
    bootoast.toast({
    message: data.errors,
    type: 'danger'
    });
    }
    if (data.success == '1') {
    bootoast.toast({
    message: data.data,
    type: 'danger'
    });
    $('#addMerchant').modal("toggle");
    location.reload();
    }
    }
    });
    });

     $(document).ready(function(){
         $(".announce").click(function(){ // Click to only happen on announce links
             $("#delete").val($(this).data('id'));
             $('#deleteMerchant').modal('show');
         });
     });
    </script>
@endpush
@stop