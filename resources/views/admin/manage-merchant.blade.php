@extends('layouts.admin.dashboard')
@section('section')
@section ('page_heading','Manage Merchant')
@include('message.message')
<div class="diash-wrap-white">
    <div class="dash-page register">
        <div class="row dash-top mb-2">
            <div class="col-md-8 dash-title">
                <h3 class="small-head">All Merchants</h3>

            </div>
            <div class="col-md-4 text-right">
                <button type="button" class="link create" data-toggle="modal" data-target="#addMerchant">Create New
                    Merchant
                </button>
            </div>
        </div>
        {{--@if($merchant['user']->first_name =='')--}}
            {{--<div class="alert alert-primary">--}}
                {{--<h3>No merchant found</h3>--}}
            {{--</div>--}}
        {{--@endif--}}
        @foreach($merchants as $merchant)
            <div class="individual-merchant mb-3">
                <div class="row">
                    <div class="col-md-4 col-lg-3 ">
                        <div class="img-wrap in-shadow">
                            <img src="{{$merchant->photo ? asset('/images/merchant/').'/'.$merchant->photo : ''}}" class="img-fluid">
                        </div>
                    </div>
                    <div class="col-md-8 col-lg-9">
                        <div class="text-wrap">
                            <div class="row no-gutters top mb-2">
                                <div class="col-sm-6 text-left">
                                 <strong>{{$merchant['user']->first_name}} {{$merchant['user']->last_name}}</strong>
                                    <p class="data">{{$merchant->address}}</p>
                                </div>
                                <div class="col-sm-6 text-sm-right">
                                    <button type="button" class="link edits" data-infos="{{$merchant['user']->id}},{{$merchant['user']->first_name}},{{$merchant['user']->last_name}},{{$merchant['user']->email}},{{$merchant->phone}},{{$merchant->rating}},{{$merchant->address}},{{$merchant->discription}}" data-toggle="modal"
                                            data-target="#editMerchant"><img
                                                src="{{asset('assets/admin/images/edit.png')}}"  class="img-fluid">Edit
                                    </button>
                                    <button  type="button" class="link announce"  data-id="{{$merchant['user']->id}}" data-toggle="modal"
                                            data-target="#deleteMerchant"><img
                                                src="{{asset('assets/admin/images/delete.png')}}" class="img-fluid">Delete
                                    </button>

                                    <a href="{{'merchant_coupon/'.encrypt($merchant['user']->id)}}"   class="link" >Manage Coupon
                                    </a>
                                </div>
                            </div>
                            <p class="data">
                                <img src="{{asset('assets/admin/images/phn.png')}}"
                                     class="img-fluid"><span>{{$merchant->phone}}</span>
                            </p>
                            <p class="data">
                                <img src="{{asset('assets/admin/images/star.png')}}" class="img-fluid"><a href=""
                                                                                                          class="stars">{{$merchant->rating}}</a></span>
                            </p>
                            <p class="desc">
                                <strong>{{$merchant->discription}}</strong>
                                <small></small>
                            </p>
                        </div>
                    </div>

                </div>
            </div>

        @endforeach
    </div>
</div>
</div>
</div>


<div class="modal-wrap">
    <div class="modal fade" id="blockModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-wrap">
                        <p>Are you sure to block?</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade maiilModal" id="maiilModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Compose Promotional Mail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-wrap">
                        <!-- Form -->
                        <form class="" style="">
                            <div class="md-form mt-0">
                                <input type="email" id="FormEmail" class="form-control">
                                <label for="FormEmail">E-mail</label>
                            </div>
                            <div class="md-form mt-0">
                                <input type="text" id="subEmail" class="form-control">
                                <label for="subEmail">Subject</label>
                            </div>
                            <div class="md-form mt-0">
                                <textarea class="form-control" id="textarea2" rows="3"></textarea>
                                <label for="textarea2">Message</label>
                            </div>

                            <!-- Sign up button -->
                            <button class="btn" type="submit">Sign in</button>
                        </form>
                        <!-- Form -->
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
                    <h5 class="modal-title" id="exampleModalLabel">Manage Merchant</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="text-wrap add-merchant">
                        <!-- Form -->
                        <form id="priviledge" class="" style="" method="post" action="">


                            <div class="container">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Image Upluad</div>
                                    <div class="panel-body">


                                        <div class="row">
                                            <div class="col-md-4 text-center">
                                                <div id="upload-demo" style="width:350px"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4" style="padding-top:30px;">
                                                <strong>Select Image:</strong>
                                                <br/>
                                                <input type="file" id="upload">
                                             </div>

                                        </div>


                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-sm-5">
                                    {{--<div class="img-wrap in-shadow">--}}
                                        {{--<div class="camera-wrap">--}}
                                            {{--<label>Upload Image</lable>--}}
                                                {{--<input type="image" src="{{asset('assets/admin/images/camera.png')}}" width="30px"/>--}}
                                                {{--<input type="file" id="image" name="image" style="display: none;" />--}}
                                         {{--</div>--}}
                                    {{--</div>--}}


                                </div>
                                <input type="hidden" name="user_id" id="user_id" class="form-control">

                                <div class="col-sm-7">
                                    <div class="md-form mt-0">
                                        <input type="text" name="first_name" placeholder="first_name" id="first_name" class="form-control">
                                        <label for="first_name">First Name</label>
                                    </div>


                                    <div class="md-form mt-0">
                                        <input type="text" name="last_name" id="last_name" placeholder="last_name" class="form-control">
                                        <label for="last_name">Last Name</label>
                                    </div>
                                    <div class="md-form mt-0">
                                        <input type="email" name="email" placeholder="email" id="email" class="form-control">
                                        <label for="email">Email</label>
                                    </div>
                                    <div class="md-form mt-0">
                                        <input type="text" name="phone" id="phone" placeholder="phone"  class="form-control">
                                        <label for="phone">phone</label>
                                    </div>
                                    <div class="md-form mt-0">

                                        <select class="form-control"  placeholder="rating"  name="rating" id="rating">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                        <label for="rating">Rating</label>
                                     </div>
                                    <div class="md-form mt-0">
                                        <textarea class="form-control" placeholder="address"   name="address" id="address" rows="3"></textarea>
                                        <label for="address">Address</label>
                                    </div>
                                    <div class="md-form mt-0">
                                        <textarea class="form-control"  placeholder="discription"  name="discription" id="discription" rows="3"></textarea>
                                        <label for="disciption">Description</label>
                                    </div>
                                </div>
                            </div>
                            <!-- Sign up button -->
                            <button class="btn" type="button" id="submitMar">Create</button>
                        </form>
                        <!-- Form -->
                    </div>
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
                        <p>By Deteing merchant you will lorem ipsum dolor</p>
                        <div class="mfooter delete">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <a data-method="delete" style="cursor:pointer;" onclick="$(this).find('form').submit();">Delete
                                <form action="{{url('admin/merchant/delete')}}" method="POST"  style="display:none">
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

</div>


@push('scripts')
    <script>



        $(".edits").click(function(){ // Click to only happen on announce links
            var details = $(this).data('infos').split(',');

            $('#user_id').val(details[0]);
            $('#first_name').val(details[1]);
            $('#last_name').val(details[2]);
            $('#email').val(details[3]);
            $('#phone').val(details[4]);
            $('#rating').val(details[5]);
            $('#address').val(details[6]);
            $('#discription').val(details[7]);
            $('#addMerchant').modal('show');
        });

        $(document).ready(function(){
            $(".announce").click(function(){ // Click to only happen on announce links

             $("#delete").val($(this).data('id'));
                $('#deleteMerchant').modal('show');
            });
        });

        $(".create").click(function(){ // Click to only happen on announce links
            $('#user_id').val('');
            $('#first_name').val('');
            $('#last_name').val('');
            $('#email').val('');
            $('#phone').val('');
            $('#address').val('');
            $('#addMerchant').val('');
            $('#discription').val('');

        });


        $uploadCrop = $('#upload-demo').croppie({
            enableExif: true,
            viewport: {
                width: 200,
                height: 200,
                type: 'circle'
            },
            boundary: {
                width: 300,
                height: 300
            }
        });

        $('#upload').on('change', function () {
            var reader = new FileReader();
            reader.onload = function (e) {
                $uploadCrop.croppie('bind', {
                    url: e.target.result
                }).then(function(){
                    console.log('jQuery bind complete');
                });

            }
            reader.readAsDataURL(this.files[0]);
        });


        $("input[type='image']").click(function(e) {
            e.preventDefault();
            $("input[id='image']").click();
        });
        $(document).on('click', '#submitMar', function () {


                $uploadCrop.croppie('result', {
                    type: 'canvas',
                    size: 'viewport'
                }).then(function (resp) {
                    this.sharedVal = resp;
                });

                alert(sharedVal);

            if( document.getElementById("upload").files.length == 0 ){
                sharedVal = '';
            }


            if ($('#user_id').val() == '') {
                var type = 'POST';
                var url = "{{url('/admin/merchant')}}"
           } else {
                var type = 'PUT';
                var url = "{{url('/admin/merchant/')}}" + '/' + $('#user_id').val();
            }

            $.ajax({
                type: type,
                url: url,
                data: {
                    '_token': "{{ csrf_token() }}",
                    'user_id': $('#user_id').val(),
                    'first_name': $('#first_name').val(),
                    'last_name':  $('#last_name').val(),
                    'email':  $('#email').val(),
                    'phone':  $('#phone').val(),
                    'rating':  $('#rating').val(),
                    'address':  $('#address').val(),
                    'discription':  $('#discription').val(),
                    "images":sharedVal
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

    </script>
@endpush
@stop

