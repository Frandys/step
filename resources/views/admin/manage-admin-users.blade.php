@extends('layouts.admin.dashboard')
@section('section')
@section ('page_heading','Manage Admin')

          @if (!\Sentinel::getUser()->hasAccess('admin.create'))
              <script>window.location = "{{url('/')}}";</script>
         @endif

<div class="diash-wrap-white">
    <div class="dash-page register">
        <div class="row dash-top mb-2">
            <div class="col-md-8 dash-title">
                <h3 class="small-head">Admin Users <span class="ble">({{count($users)-1}})</span></h3>
            </div>
            <div class="col-md-4 text-right">
                <button type="button" class="link create" data-toggle="modal" data-target="#addadmin">Create New Admin
                </button>
            </div>
        </div>


        @foreach($users as $user)
            @if (!\Sentinel::findById($user->id)->hasAccess('admin.create'))

            <div class="algo-wrap in-shadow mb-3">
                <div class="row no-gutters">
                    <div class="col-md-4"><h5 class="admin-head">{{$user->first_name}} {{$user->last_name}}</h5></div>
                    <div class="col-md-8 text-md-right">
                        <button type="button" class="link announce edit" data-id="{{$user->id}}" data-toggle="modal"
                                data-target="#deleteMerchant"><img
                                    src="{{asset('assets/admin/images/delete.png')}}" class="img-fluid">Delete
                        </button>
                        <button type="button" class="link  change" data-passid="{{$user->id}}" data-toggle="modal"
                                data-target="#changepass">Change
                            Password
                        </button>
                    </div>
                </div>
            </div>
            @endif
        @endforeach
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


    <div class="modal fade maiilModal" id="addadmin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create New Admin </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-wrap">
                        <form class="form-login">
                            <input type="hidden" id="user_id" name="user_id" class="form-control "
                            >
                            <div class="form-group email">
                                <!-- Email -->

                                <input type="email" name="email" id="email" class="form-control "
                                       placeholder="E-mail">
                            </div>

                            <div class="form-group first_name">
                                <!-- Email -->
                                <input type="text" id="first_name" name="first_name" class="form-control "
                                       placeholder="first name">
                            </div>

                            <div class="form-group last_name">
                                <!-- Email -->
                                <input type="text" id="last_name" name="last_name" class="form-control "
                                       placeholder="last name">
                            </div>
                            <!-- Password -->
                            <div class="form-group password">
                                <input type="password" id="password" name="password" class="form-control "
                                       placeholder="Password">
                            </div>
                            <div class="form-group confirm_password">
                                <input type="password" id="confirm_password" name="confirm_password"
                                       class="form-control "
                                       placeholder="confirm password">
                            </div>

                            <!-- Sign in button -->
                            <button class="btn" id="submitMar" type="button">Sign in</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade maiilModal" id="changepass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Change Password </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-wrap">
                        <form id="priviledge" class="" style="" method="post" action="">
                            <!-- Password -->
                            <input type="hidden" id="user_id_pass" class="form-control "
                                   placeholder="Password">
                            <div class="form-group password">
                                <input type="password" id="password_admin" name="password_admin" class="form-control "
                                       placeholder="Password">
                            </div>
                            <div class="form-group password">
                                <input type="password" id="confirm_password_admin" name="confirm_password_admin" class="form-control "
                                       placeholder="Confirm Password">
                            </div>

                            <!-- Sign in button -->
                            <button class="btn" id="changePassd" type="button">Create</button>
                        </form>
                    </div>
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
                <h5 class="modal-title" id="exampleModalLabel">Delete Admin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-wrap">
                     <div class="mfooter delete">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <a data-method="delete" style="cursor:pointer;" onclick="$(this).find('form').submit();">Delete
                            <form action="{{url('admin/manage_admin/delete')}}" method="POST" style="display:none">
                                <input type="hidden" id="delete" name="delete" value="">
                                <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}"/>
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
        // $(".edits").click(function(){ // Click to only happen on announce links
        //
        //     $('#user_id').val($(this).data('info1'));
        //     $('#title').val($(this).data('info2'));
        //     $('#description').val($(this).data('info3'));
        //     $('#editPage').modal('show');
        // });

        $(".create").click(function () { // Click to only happen on announce links
            $('#email').val('');
            $('#first_name').val('');
            $('#last_name').val('')
            $('#password').val('');
            $('#confirm_password').val('');
        });

        $(".change").click(function () { // Click to only happen on announce links
             $("#user_id_pass").val($(this).data('passid'));
        });


        $("input[type='image']").click(function (e) {
            e.preventDefault();
            $("input[id='image']").click();
        });


        $(document).on('click', '#changePassd', function () {

            var type = 'POST';
            var url = "{{url('/admin/change_password_admin')}}"

            $.ajax({
                type: type,
                url: url,
                data: {
                    '_token': "{{ csrf_token() }}",
                    'user_id_pass': $('#user_id_pass').val(),
                    'password_admin': $('#password_admin').val(),
                    'confirm_password_admin': $('#confirm_password_admin').val(),
                },
                success: function (data) {
                    if (data.success == '0') {
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


        $(document).on('click', '#submitMar', function () {

            if ($('#user_id').val() == '') {
                var type = 'POST';
                var url = "{{url('/admin/manage_admin')}}"
            } else {
                var type = 'PUT';
                var url = "{{url('/admin/manage_admin/')}}" + '/' + $('#user_id').val();
            }
            $.ajax({
                type: type,
                url: url,
                data: {
                    '_token': "{{ csrf_token() }}",
                    //  'user_id': $('#user_id').val(),
                    'email': $('#email').val(),
                    'first_name': $('#first_name').val(),
                    'last_name': $('#last_name').val(),
                    'password': $('#password').val(),
                    'confirm_password': $('#confirm_password').val(),
                },
                success: function (data) {
                    if (data.success == '0') {
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

        $(document).ready(function () {
            $(".announce").click(function () { // Click to only happen on announce links
                $("#delete").val($(this).data('id'));
                $('#deleteMerchant').modal('show');
            });
        });
    </script>
@endpush
@stop