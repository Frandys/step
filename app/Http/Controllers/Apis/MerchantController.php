<?php

namespace App\Http\Controllers\Apis;

use App\Model\MerchantMeta;
use App\Http\Controllers\Controller;
use Activation;
use App\Model\UserCoupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ValidationRequest;
use Illuminate\Support\Facades\Validator;
use View;

class MerchantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $merchant = MerchantMeta::with(array('User' => function ($query) {
            $query->select('id', 'email', 'first_name', 'last_name');
        },
        ))->get();
        return SuccessResponse($merchant, Config::get('message.options.SUCESS'));
    }

    public function getMerchantUserId()
    {
      $merchant =  UserCoupon::with(['Merchant','MerchantMeta'])->where('user_id',\Auth::user()->id)->get();
      return SuccessResponse($merchant, Config::get('message.options.SUCESS'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $merchant = MerchantMeta::with(array('User' => function ($query) {
            $query->select('id', 'email', 'first_name', 'last_name');
        },
        ))->find($id);
        return SuccessResponse($merchant, Config::get('message.options.SUCESS'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
