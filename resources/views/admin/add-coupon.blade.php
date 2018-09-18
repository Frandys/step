@extends('layouts.admin.dashboard')
@section('section')
@section ('page_heading','Add Coupon')
<div class="col-lg-10">
    <div class="admin-wrap">

        <div class="diash-wrap-white">
            <div class="dash-page register">
                <div class="row dash-top page-title mb-2">
                    <div class="col">
                        <h3 class="small-head">Add Coupon</h3>
                    </div>

                </div>
                @include('message.message')

                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-6">
                                <form role="form" method="POST" action="{{ url('admin/merchant_coupon') }}">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <input name="user_id" id="user_id" value="{{\Request::segment('3')}}"
                                               class="form-control" required type="hidden">

                                        <label for="title">Title</label>
                                        <input name="title" id="title" minlength="2" maxlength="255"
                                               class="form-control" required type="text">
                                        @if ($errors->has('title'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="required_steps">Required Steps</label>
                                        <input name="required_steps" maxlength="255" class="form-control" required
                                               type="number">
                                        @if ($errors->has('required_steps'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('required_steps') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="expire_date">Expire Date</label>
                                        <input name="expire_date" class="form-control" required type="date">
                                        @if ($errors->has('expire_date'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('expire_date') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="coupon_code">Coupon Code</label>
                                        <input name="coupon_code" id="coupon_code" maxlength="255" class="form-control"
                                               required type="text">
                                        @if ($errors->has('coupon_code'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('coupon_code') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="coupon_point">Coupon Point</label>
                                        <input name="coupon_point" maxlength="255" class="form-control" required
                                               type="text">
                                        @if ($errors->has('coupon_point'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('coupon_point') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea name="description" maxlength="3000" class="form-control" required
                                                  type="text"></textarea>
                                        @if ($errors->has('description'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <button type="submit" class="btn btn-primary">Submit</button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@push('scripts')
    <script>
        $('#coupon_code').on('blur', function() {


            $.ajax({
                type: "POST",
                url: "{{url('/admin/check_coupon')}}",
                data: {
                    '_token': "{{ csrf_token() }}",
                    'user_id': $('#user_id').val(),
                    'edit': '0',
                    'coupon_code': $(this).val(),

                },
                success: function (data) {
                    if (data.success == '0'){
                        bootoast.toast({
                            message: data.errors,
                            type: 'danger'
                        });
                    }
                }
            });
        });
    </script>
@endpush
@stop