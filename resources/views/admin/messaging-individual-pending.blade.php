@extends('layouts.admin.dashboard')
@section('section')
@section ('page_heading','Manage Chat')
					<div class="diash-wrap-chat">
						<div class="dash-page register">
							<div class="row dash-top mb-2">
								<div class="col-md-12 dash-title">
									<h3 class="small-head">Users <small>> View</small></h3>
									
								</div>
							</div>
							@include('message.message')

							<div class="in-shadow chat-wrap p-4">
								<div class="row top-chat no-gutters mb-3">
									<div class="col">
										<a href="{{url('admin/ticket')}}" class="done link">Go Back</a>
									</div>
									@if($chat->status == '0')
									<a   class="delete link announce"  data-id="{{$chat->id}}" data-toggle="modal"
											 data-target="#deleteMerchant">Close Chat
									</a>
										@else
									{{'Chat Closed'}}
									@endif
								</div>
								<div class="ticket-text mb-4">
									<h3>{{$chat->title}}</h3>
									<p>{{$chat->question}}</p>
								</div>
								
								<div class="msgs-wrap">

									@foreach($chat['userchat'] as $chat)
										<h1>name</h1>
										{{$chat->first_name}} {{$chat->last_name}} <br>
									<h2>Message</h2>
										{{$chat->pivot->chat}}
										@endforeach
									
								</div>
							</div>
						</div>
						@if($chat->status == '0')
						<form  action="{{url('admin/ticket')}}" method="post">
							<input type="hidden" id="job_id" name="job_id" value="{{$chat->id}}">
							<textarea name="chatAdd"  required maxlength="2000" minlength="2" id="chatAdd"></textarea>
							<input type="submit" value="Submit">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">

						</form>
							@endif
					</div>

<div class="modal fade maiilModal" id="deleteMerchant" tabindex="-1" role="dialog"
	 aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Close Chat</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body">
				<div class="text-wrap">
					<p>By Closing  you will lorem ipsum dolor</p>
					<div class="mfooter delete">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close </button>
						<a data-method="delete" style="cursor:pointer;" onclick="$(this).find('form').submit();">Close Ticket
							<form action="{{url('admin/ticket/delete')}}" method="POST"  style="display:none">
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

	</script>
@endpush
			@stop