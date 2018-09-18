<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ValidationRequest;
use App\Model\BodyParts;
use App\Model\Faq;
use App\Model\MerchantCoupons;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use View;
use Illuminate\Support\Facades\Session;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faqs = Faq::all();
        return view('admin/faq', compact('faqs'));

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

        $validation = \Validator::make($data, ValidationRequest::$Adional);
        if ($validation->fails()) {
            $errors = $validation->messages()->all();
            return Response(array('success' => '0', 'data' => null, 'errors' => $errors['0']));
        }

        $body_part = new Faq;
        $body_part->title = $data['title'];
        $body_part->description = $data['description'];
        $body_part->save();
        return Response(array('success' => '1', 'data' => Config::get('message.options.SUCESS'), 'errors' => ''));

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
        $data = $request->input();

        $validation = \Validator::make($data, ValidationRequest::$Adional);
        if ($validation->fails()) {
            $errors = $validation->messages()->all();
            return Response(array('success' => '0', 'data' => null, 'errors' => $errors['0']));
        }

        $body_part = Faq::find($id);
        $body_part->title = $data['title'];
        $body_part->description = $data['description'];
        $body_part->save();
        return Response(array('success' => '1', 'data' => Config::get('message.options.SUCESS'), 'errors' => ''));

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
