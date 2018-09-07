<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;

use App\Http\Requests\ValidationRequest;
use App\Model\Chat;
use App\Model\Tickets;
use Cartalyst\Sentinel\Sentinel;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use View;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SuccessResponse(Tickets::all(), Config::get('message.options.SUCESS'));
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
        try {
            $data = $request->input();
            $validation = \Validator::make($data, ValidationRequest::$ticketAdd);

            if ($validation->fails()) {
                return ValidationResponse($validation->errors(), Config::get('message.options.VALIDATION_FAILED'));
            }
            $ticket = New Tickets;
            $ticket->user_id = \Auth::user()->id;
            $ticket->title = $data['title'];
            $ticket->question = $data['question'];
            $ticket->save();
            return SuccessResponse($ticket, Config::get('message.options.REGISTERED_SUCESS'));
        } catch (Exception $ex) {
            return FailResponse($ex->getMessage(), $ex->getCode());
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
        $chat = Chat::with(array('User' => function ($query) {
            $query->select('id', 'email', 'first_name', 'last_name');
        },
        ))->where('tickets_id', $id)->get();


        return SuccessResponse($chat, Config::get('message.options.SUCESS'));
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
