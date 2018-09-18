<?php

namespace App\Http\Controllers\Admin;

use App\Model\Challenges;
use App\Http\Controllers\Controller;
use App\Model\MerchantCoupons;
use App\Model\MerchantMeta;
use Cartalyst\Sentinel\Sentinel;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ValidationRequest;
use Illuminate\Support\Facades\Validator;
use View;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\EloquentDataTable;

class ChallengesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $challenges =  Challenges::with('Coupon')->get();
        return view('admin/challenges');

    }

    public function viewChallenges(Request $request)
    {
        $data = $request->all();
        $challenges = Challenges::with('Coupon');
        if ($data['user_id'] == '0') {
            $challenges = $challenges->orderBy('id', 'desc')->get();
        } elseif ($data['user_id'] == '1') {
            $challenges = $challenges->orderBy('end_date_time', 'asc')->get();
        } else {
            $challenges = $challenges->orderBy('end_date_time', 'desc')->get();
        }
        return Datatables::of($challenges)
            ->addColumn('action', function ($user) {
                return '<a class="block" href="challenges/' . encrypt($user->id) . '">Edit</a>';
            })
            ->editColumn('type', '{{($type == "d") ? "Daily" : (($type == "W")  ? "Weekly" : "Monthly")}}')
            ->editColumn('start_date_time', '{{date("Y-m-d H:i:s", substr($start_date_time, 0, 10))}}')
            ->editColumn('end_date_time', '{{date("Y-m-d H:i:s", substr($end_date_time, 0, 10))}}')
            ->addIndexColumn()
            ->make();
    }


    public function getCoupons(Request $request)
    {
        $data = $request->all();
        $mercanCode = MerchantCoupons::where('user_id', $data['get_option'])->whereRaw("expire_date >= unix_timestamp(current_Date())")->select('id', 'coupon_code')->get();
        $mercanCode = json_decode(json_encode($mercanCode));
        if (empty($mercanCode)) {
            echo "<option value=''>No coupan found</option>";
        }
        foreach ($mercanCode as $mercantCode) {
            {
                echo "<option value='" . $mercantCode->id . "'>" . $mercantCode->coupon_code . "</option>";
            }
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $merchants = MerchantMeta::with('User')->get();
        $challenges = '';
        return view('admin/new-challenge',compact('challenges','merchants'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->input();
        $validation = Validator::make($data, ValidationRequest::$chlange);
        if ($validation->fails()) {
            $errors = $validation->messages();
            return Redirect::back()->with('errors', $errors);
        }
         if($data['mer_coupon_id'] == '') {
            $challenges = New Challenges;
        }else{
            $challenges = Challenges::find($data['mer_coupon_id']);
        }

        $challenges->coupon_id = $data['coupon_id'];
        $challenges->type = $data['type'];
        $challenges->step = $data['step'];
        $challenges->start_date_time = strtotime($data['start_date_time']);
        $challenges->end_date_time = strtotime($data['end_date_time']);
        $challenges->save();
        Session::flash('success', Config::get('message.options.SUCESS'));
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $merchants = MerchantMeta::with('User')->get();
        $challenges =  Challenges::with('Coupon')->find(decrypt($id));
//        print_r(json_decode(json_encode($challenges))); die;
        return view('admin/new-challenge',compact('challenges','merchants'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    { echo 'sfsdfds'; die;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
