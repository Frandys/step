@extends('layouts.admin.dashboard')
@section('section')
@section ('page_heading','Manage Challenges')
<div class="diash-wrap-white">
    <div class="dash-page register">
        <div class="row dash-top mb-3">
            <div class="col-md-8 dash-title">
                <h3 class="small-head">Challenges</h3>
                <div class="form-group search">
                    <input type="email" id="defaultLoginFormEmail" class="form-control " placeholder="Search by Code">
                </div>
            </div>
            <div class="col-md-2 compose composemessage">
                <a href="{{url('admin/challenges/create')}}">
                    <button type="button" class="link edit" onclick="new-challenge.html"><strong>+ New
                            Challenge</strong></button>
                </a>

            </div>
             <div class="col-md-2 text-right">
                <!-- Basic dropdown -->
                <div class="dropdown">
                    <button type="button" class="link edit dropdown-toggle" type="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false"><img
                                src="{{asset('assets/admin/images/filter.png')}}" class="img-fluid">Fliter
                    </button>

                    <select class="form-control" name="date" id="date">
                   <option value="0">Select</option>
                    <option value="1">Expired date ascending</option>
                    <option value="2">Expired date descending</option>
                    </select>
                    {{--<div class="dropdown-menu">--}}
                        {{--<a class="dropdown-item" href="#">Action</a>--}}
                        {{--<a class="dropdown-item" href="#">Another action</a>--}}
                        {{--<a class="dropdown-item" href="#">Something else here</a>--}}
                        {{--<div class="dropdown-divider"></div>--}}
                        {{--<a class="dropdown-item" href="#">Separated link</a>--}}
                    {{--</div>--}}
                </div>
            </div>
        </div>
        <div class="dash-table in-shadow">
            <div class="user-table tat table-responsive">
                <table id="users-table" class="table user">
                    <thead>
                    <tr class="row-name">
                        <th><strong>SrNo.</strong></th>
                        <th><strong>Type</strong></th>
                        <th><strong>Coupon Code</strong></th>
                        <th><strong>Step</strong></th>
                        <th><strong>Start Date</strong></th>
                        <th><strong>Expired Date</strong></th>
                        <th><strong>Action</strong></th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>

            </div>
        </div>
        {{--<div class="row col-md-4 viewcustom">--}}
        {{--<p> View Records</p>--}}
        {{--<select class="pagedropdown">--}}
        {{--<option value="volvo">10</option>--}}
        {{--<option value="saab">20</option>--}}
        {{--<option value="opel">30</option>--}}
        {{--<option value="audi">40</option>--}}
        {{--</select>--}}

        {{--</div>--}}
    </div>
</div>

@push('scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });
        //   var value = $("form input[type='radio']:checked").val();
        oTableen = $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ url("/admin/view_challenges")}}',
                method: 'POST',

                data: function (d) {
                    d.user_id = $("#date").val();

                },

            },
            columns: [
                {data: 'DT_Row_Index', name: 'DT_Row_Index'},
                {data: 'type', name: 'type'},
                {data: 'coupon.coupon_code', name: 'coupon.coupon_code'},
                {data: 'step', name: 'step'},
                {data: 'start_date_time', name: 'start_date_time'},
                {data: 'end_date_time', name: 'end_date_time'},
                {data: 'action', name: 'action', orderable: false, searchable: false}

            ],

        });


        $('#date').change(function(){
            oTableen.draw();
            e.preventDefault();
        });
    </script>
@endpush
@stop