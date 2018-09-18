<?php

namespace App\Http\Controllers\Admin;

use App\Model\Chat;
use App\Model\Tickets;
use App\Http\Controllers\Controller;
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

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/messaging-support');


    }

    public function viewTicket(Request $request)
    {
       $data = $request->all();
        $users = Tickets::orderBy('id', 'desc');
         if (isset($data['user_id']) && $data['user_id'] == '1') {
            $users = $users->where('status', '0')->get();
        } else {
            $users = $users->get();
        }
        return Datatables::of($users)
            ->addColumn('action', function ($user) {
                return '<a class="view" href="ticket/'.encrypt($user->id).'">View</a>';
            })
            ->editColumn('status', '{{$status == "0" ? "Pending" : "Closed"}}')
            ->editColumn('updated_at', '{{date("Y-m-d H:i:s", substr($updated_at, 0, 10))}}')
            ->editColumn('created_at', '{{date("Y-m-d H:i:s", substr($created_at, 0, 10))}}')
            ->addIndexColumn()
            ->make(true);
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

        $validation = \Validator::make($data, ValidationRequest::$chat);
        if ($validation->fails()) {
            $errors = $validation->messages();
            return Redirect::back()->with('errors', $errors);
        }
//       $ticket = Tickets::find($data['job_id']);
////        $user->UserChatAdd()->attach(\Sentinel::getUser()->id);

        $chat = new Chat;
         $chat->chat = $data['chatAdd'];
        $chat->user_id = \Sentinel::getUser()->id;
        $chat->tickets_id = $data['job_id'];
        $chat->save();
        $chat->save();

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
       $chat = Tickets::with('UserChat')->find(decrypt($id));
        return view('admin/messaging-individual-pending',compact('chat'));
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


    public function ticketDelete(Request $request)
    {
        $data = $request->input();
        $ticket = Tickets::find($data['delete']);
        $ticket->status = '1';
        $ticket->save();
        \Session::flash('success', 'Closed successfully');
        return Redirect::back();
    }
}
