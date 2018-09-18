@extends('layouts.admin.dashboard')
@section('section')
@section ('page_heading',' New Challenge')
<div class="diash-wrap-white">
    <div class="dash-page register">
        <div class="row dash-top mb-2">
            <div class="col-md-12 dash-title">
                <h3 class="small-head">Challenges
                    <small>> New Challenge</small>
                </h3>
            </div>

        </div>
        @include('message.message')

        <div class="challenge-wrap in-shadow mb-3">
            <h5><strong>Challenge</strong></h5>
            <div class="col-sm-12">

                <form   autocomplete="off" method="post" action="{{url('admin/challenges')}}">
                {{ csrf_field() }}
                    <input type="hidden" required  value="{{isset($challenges->id) ? $challenges->id : ''}}" class="form-control" id="mer_coupon_id" name="mer_coupon_id" >

                    <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="user_id">Select Merchant</label>
                            <select required onchange="fetch_select(this.value);" class="form-control" name="user_id"
                                    id="user_id">
                                <option value="">Select Merchant</option>
                                @foreach($merchants as $merchant)
                                    <option value="{{$merchant['user']->id}}" {{ isset($challenges['coupon']->user_id) && $challenges['coupon']->user_id == $merchant['user']->id ? 'selected="selected"' : '' }}>{{$merchant['user']->first_name}} {{$merchant['user']->last_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="text">Select Coupon</label>
                            <select required class="form-control" name="coupon_id" id="coupon_id">
                            </select>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="text">Challenge Type</label>

                            <select name="type" id="type" class="form-control">
                            <option value="d" {{ isset($challenges->type) && $challenges->type == 'd' ? 'selected="selected"' : '' }}>Daily</option>
                             <option value="w" {{ isset($challenges->type) && $challenges->type == 'w'    ? 'selected="selected"' : '' }}>Weekly</option>
                             <option value="m" {{ isset($challenges->type) && $challenges->type == 'm'    ? 'selected="selected"' : '' }}>Monthly</option>
                            </select>

                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            {{--<label for="email">Coupon Code</label>--}}
                            {{--<input  required type="text" id="coupon_code" name="coupon_code" class="form-control" placeholder="Coupon Code">--}}
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="email">Steps Required</label>
                            <input type="text" required  value="{{isset($challenges->step) ? $challenges->step : ''}}" class="form-control" id="step" name="step" placeholder="Steps">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="email">Start Date and Time</label>
                             <input type="text" name="start_date_time" class="date readonly" value="{{isset($challenges->start_date_time) ? date("H:i m/d/Y", substr($challenges->start_date_time, 0, 10))  : ''}}"  id="start_date_time" required />

                        </div>
                    </div>
                    <div class="col-sm-4">
                        &nbsp;
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="email">End Date and Time</label>
                            <input type="text" name="end_date_time" class="date readonly" value="{{isset($challenges->end_date_time) ? date("H:i m/d/Y ", substr($challenges->end_date_time, 0, 10)) : ''}}"   id="end_date_time"  required />

                         </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <button class="btn" type="submit">Submit</button>
                    </div>

                    <div class="col-sm-6">
                        <a href="{{url('admin/challenges')}}" class="btn" >Cancel</a>
                    </div>
                </div>
            </form>
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
                    <h5 class="modal-title" id="exampleModalLabel">Add New Merchant</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-wrap add-merchant">
                        <!-- Form -->
                        <form class="" style="">
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="img-wrap in-shadow">
                                        <div class="camera-wrap">
                                            <img src="images/camera.png" class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-7">
                                    <div class="md-form mt-0">
                                        <input type="text" id="FormEmail" class="form-control">
                                        <label for="FormEmail">Merchant Name</label>
                                    </div>
                                    <div class="md-form mt-0">
                                        <input type="text" id="subEmail" class="form-control">
                                        <label for="subEmail">Phone Number</label>
                                    </div>
                                    <div class="md-form mt-0">
                                        <textarea class="form-control" id="textarea2" rows="3"></textarea>
                                        <label for="textarea2">Description</label>
                                    </div>
                                </div>
                            </div>
                            <!-- Sign up button -->
                            <button class="btn" type="submit">Create</button>
                        </form>
                        <!-- Form -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade maiilModal" id="editMerchant" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Merchant</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-wrap add-merchant">
                        <!-- Form -->
                        <form class="" style="">
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="img-wrap in-shadow">
                                        <img src="images/brand.png" class="img-fluid">
                                        <div class="camera-wrap">
                                            <img src="images/camera.png" class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-7">
                                    <div class="md-form mt-0">
                                        <input type="text" id="FormEmail" class="form-control">
                                        <label for="FormEmail">Merchant Name</label>
                                    </div>
                                    <div class="md-form mt-0">
                                        <input type="text" id="subEmail" class="form-control">
                                        <label for="subEmail">Phone Number</label>
                                    </div>
                                    <div class="md-form mt-0">
                                        <textarea class="form-control" id="textarea2" rows="3"></textarea>
                                        <label for="textarea2">Description</label>
                                    </div>
                                </div>
                            </div>
                            <!-- Sign up button -->
                            <button class="btn" type="submit">Edit</button>
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
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>


@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/gijgo@1.9.10/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://cdn.jsdelivr.net/npm/gijgo@1.9.10/css/gijgo.min.css" rel="stylesheet" type="text/css" />

    <script>

        $(".readonly").keydown(function(e){
            e.preventDefault();
        });
        $('#start_date_time').datetimepicker({
            dateFormat : 'dd/mm/yy',
            showOn: "both",
            buttonImage: "b_calendar.png",
            buttonImageOnly: true,
            buttonText: "Select date",
            changeMonth: true,
            changeYear: true,
            yearRange: "-100:+0"
        });

        $('#end_date_time').datetimepicker({
            dateFormat : 'dd/mm/yy',
            showOn: "both",
            buttonImage: "b_calendar.png",
            buttonImageOnly: true,
            buttonText: "Select date",
            changeMonth: true,
            changeYear: true,
            yearRange: "-100:+0"
        });



        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });


        $(document).ready(function() {
            fetch_select($("#user_id").val());
        });

        function fetch_select(val) {
            $.ajax({
                type: 'post',
                url: '{{url('admin/get_coupons')}}',
                data: {
                    get_option: val
                },
                success: function (response) {
                    document.getElementById("coupon_id").innerHTML = response;
                }
            });
        }
    </script>
@endpush
@stop

