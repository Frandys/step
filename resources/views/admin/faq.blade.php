@extends('layouts.admin.dashboard')
@section('section')
@section ('page_heading','Manage FAQ')
<div class="diash-wrap-white">
    <div class="dash-page register">
        <div class="row dash-top page-title mb-2">
            <div class="col">
                <h3 class="small-head">FAQ</h3>
            </div>
            <div class="col text-right">
                <button type="button" class="edit link create" data-toggle="modal" data-target="#editPage"><img
                            src="{{asset('assets/admin/images/edit.png')}}" class="img-fluid">Add New FAQ
                </button>
            </div>
        </div>
        @foreach($faqs as $faq)
            <div class="content-wrap in-shadow mb-3">
                <div class="row no-gutters mb-3">
                    <div class="col-10">
                        <h3>Question</h3>
                        <p>{{$faq->title}}</p>
                    </div>
                    <div class="col-2 text-right">
                        <button type="button" data-info1="{{$faq->id}}" data-info2="{{$faq->title}}" data-info3="{{$faq->description}}" class="link edits edit" data-toggle="modal" data-target="#editPage"><img
                                    src="{{asset('assets/admin/images/edit.png')}}" class="img-fluid">Edit
                        </button>
                    </div>
                </div>
                <h3>Answer</h3>
                <p>{{$faq->description}}</p>
            </div>
            @endforeach
    </div>
</div>

<div class="modal-wrap">
    <div class="modal fade maiilModal" id="editPage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New FAQ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-wrap">
                        <!-- Form -->
                        <form id="priviledge" class="" style="" method="post" action="">
                            <input type="hidden" name="user_id" id="user_id" class="form-control">

                            <div class="md-form mt-0">
                                <input type="text" name="title" placeholder="title" id="title" class="form-control">
                                <label for="title">Question</label>
                            </div>
                            <div class="md-form mt-0">
                                <textarea class="form-control" id="description" placeholder="description" name="description" rows="3"></textarea>
                                <label for="description">Answer</label>
                            </div>
                            <!-- Sign up button -->
                            <button class="btn" id="submitMar" type="button">Save</button>
                        </form>
                        <!-- Form -->
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>


        $(".edits").click(function(){ // Click to only happen on announce links

             $('#user_id').val($(this).data('info1'));
            $('#title').val($(this).data('info2'));
            $('#description').val($(this).data('info3'));
            $('#editPage').modal('show');
        });



        $(".create").click(function(){ // Click to only happen on announce links
            $('#user_id').val('');
            $('#title').val('');
            $('#description').val('');
        });


        $("input[type='image']").click(function(e) {
            e.preventDefault();
            $("input[id='image']").click();
        });
        $(document).on('click', '#submitMar', function () {

            if ($('#user_id').val() == '') {
                var type = 'POST';
                var url = "{{url('/admin/additional-faq')}}"
            } else {
                var type = 'PUT';
                var url = "{{url('/admin/additional-faq/')}}" + '/' + $('#user_id').val();
            }
            $.ajax({
                type: type,
                url: url,
                data: {
                    '_token': "{{ csrf_token() }}",
                    'user_id': $('#user_id').val(),
                    'title': $('#title').val(),
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
                        $('#editPage').modal("toggle");
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