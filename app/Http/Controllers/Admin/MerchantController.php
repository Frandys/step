<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ValidationRequest;
use App\Model\MerchantMeta;
use App\Model\UserMeta;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;

class MerchantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $merchants = MerchantMeta::with(array('User' => function ($query) {
            $query->select('id', 'email', 'first_name', 'last_name');
        },
        ))->get();

        return view('admin/manage-merchant', compact('merchants'));
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
        $data = $request->input();

        $validation = \Validator::make($data, ValidationRequest::$MercahntAdd);

        if ($validation->fails()) {
            $errors = $validation->messages()->all();
            return Response(array('success' => '0', 'data' => null, 'errors' => $errors['0']));
        }

        if ($request->images == '') {
            $fulimage = '';
        } else {
            $time = time();
            $image_parts = explode(";base64,", $request->images);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $destinationPath = 'images/merchant/';
            $file = $destinationPath . $time . '.png';
            file_put_contents($file, $image_base64);
            $fulimage = $time . '.png';
        }
        $credential = [
            'email' => $data['email'],
            'password' => bcrypt(str_random(18)),
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
        ];

        $user = \Sentinel::registerAndActivate($credential);
        if (!empty($user)) {
            $role = \Sentinel::findRoleByName('merchant');
            $role->users()->attach($user);

            $merch_meta = new MerchantMeta;
            $merch_meta->user_id = $user->id;
            $merch_meta->phone = $data['phone'];
            $merch_meta->rating = $data['rating'];
            $merch_meta->address = $data['address'];
            $merch_meta->discription = $data['discription'];
            $merch_meta->photo = $fulimage;
            $merch_meta->save();

            return Response(array('success' => '1', 'data' => Config::get('message.options.REGISTERED_SINLAVID_MAILUCESS'), 'errors' => ''));

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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
        $data = $request->input();
        $validation = \Validator::make($data, ValidationRequest::$MercahntUpdate);

        if ($validation->fails()) {
            $errors = $validation->messages()->all();
            return Response(array('success' => '0', 'data' => null, 'errors' => $errors['0']));
        }

        $user = User::find($data['user_id']);
        $user->first_name = $data['first_name'];
        $user->last_name = $data['last_name'];
        $user->save();

        if (!empty($user)) {
            $merch_meta = MerchantMeta::where('user_id', $user->id)->first();
            $merch_meta->phone = $data['phone'];
            $merch_meta->rating = $data['rating'];
            $merch_meta->address = $data['address'];
            $merch_meta->discription = $data['discription'];

            if ($request->images == '') {
                $fulimage = '';
            } else {
                $time = time();
                $image_parts = explode(";base64,", $request->images);
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type = $image_type_aux[1];
                $image_base64 = base64_decode($image_parts[1]);
                $destinationPath = 'images/merchant/';
                $file = $destinationPath . $time . '.png';
                file_put_contents($file, $image_base64);
                $fulimage = $time . '.png';

                $user_meta = MerchantMeta::find($user->id);
                if (\File::exists(public_path('/images/merchant/' . $user_meta->photo))) {
                    \File::delete(public_path('/images/merchant/' . $user_meta->photo));
                }
                $merch_meta->photo = $fulimage;
            }

            $merch_meta->save();

            return Response(array('success' => '1', 'data' => Config::get('message.options.REGISTERED_SINLAVID_MAILUCESS'), 'errors' => ''));
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
        $user = \Sentinel::findById($id);
        $user->delete();
        \Session::flash('success', Config::get('message.options.PAS_CHNGE'));
        return Redirect::back();
    }

    public function merchantDelete(Request $request)
    {
        $data = $request->input();
        $user = \Sentinel::findById($data['delete']);
        $user->delete();
        \Session::flash('success', 'Deleted successfully');
        return Redirect::back();
    }


}
