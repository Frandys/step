<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ValidationRequest;
use App\Model\MerchantCoupons;
 use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use View;
use Illuminate\Support\Facades\Session;

class MerchantCouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createCoupon($id)
    {
        return view('admin/add-coupon', compact('id'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $data = $request->input();
            $validation = Validator::make($data, ValidationRequest::$Coupon);
            if ($validation->fails()) {
                $errors = $validation->messages();
                return Redirect::back()->with('errors', $errors);
            }
             $merchtCoupn = New MerchantCoupons;
            $merchtCoupn->user_id = decrypt($data['user_id']);
            $merchtCoupn->title = $data['title'];
            $merchtCoupn->required_steps = $data['required_steps'];
            $merchtCoupn->expire_date = strtotime($data['expire_date']);
            $merchtCoupn->coupon_code = $data['coupon_code'];
            $merchtCoupn->coupon_point = $data['coupon_point'];
            $merchtCoupn->description = $data['description'];
            $merchtCoupn->save();

            Session::flash('success', Config::get('message.options.SUCESS'));
            return Redirect::back();
        } catch (Exception $ex) {
            return View::make('errors.exception')->with('Message', $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $coupons = MerchantCoupons::where('user_id', decrypt($id))->get();
        return view('admin/manage-coupon', compact('coupons'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $coupon = MerchantCoupons::find(decrypt($id));
        return view('admin/edit-coupon', compact('coupon'));
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
        try {
            $data = $request->input();
            $validation = Validator::make($data, ValidationRequest::$Coupon);
            if ($validation->fails()) {
                $errors = $validation->messages();
                return Redirect::back()->with('errors', $errors);
            }
            $merchtCoupn =  MerchantCoupons::find(decrypt($id));
            $merchtCoupn->user_id = $data['user_id'];
            $merchtCoupn->title = $data['title'];
            $merchtCoupn->required_steps = $data['required_steps'];
            $merchtCoupn->expire_date = strtotime($data['expire_date']);
            $merchtCoupn->coupon_code = $data['coupon_code'];
            $merchtCoupn->coupon_point = $data['coupon_point'];
            $merchtCoupn->description = $data['description'];
            $merchtCoupn->save();

            Session::flash('success', Config::get('message.options.SUCESS'));
            return Redirect::back();
        } catch (Exception $ex) {
            return View::make('errors.exception')->with('Message', $ex->getMessage());
        }
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

    public function merchantDelete(Request $request)
    {
        $data = $request->input();
        $user = MerchantCoupons::find($data['delete'])->delete();
        \Session::flash('success', 'Deleted successfully');
        return Redirect::back();
    }

    public function checkCoupon(Request $request)
    {
        $data = $request->input();
        if($data['edit'] == '0') {
            $user = MerchantCoupons::where('user_id', decrypt($data['user_id']))->where('coupon_code', $data['coupon_code'])->first();
        }else{
            $user = MerchantCoupons::where('user_id' , $data['user_id'])->where('coupon_code', $data['coupon_code'])->where('id', '!=',decrypt($data['id']))->first();

        }
        $user = json_decode(json_encode($user));
       if(!empty($user)){
           return Response(array('success' => '0', 'data' => '', 'errors' => 'Coupon already exits.'));
       }
    }
}
