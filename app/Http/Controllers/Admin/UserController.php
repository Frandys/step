<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Activation;
use App\Model\Activations;
use Cartalyst\Sentinel\Sentinel;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Exception;
use Cartalyst\Sentinel\Users\UserInterface;
use App\User;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ValidationRequest;
use Illuminate\Support\Facades\Validator;
use View;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\EloquentDataTable;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('admin/manage-user');
    }

    public function viewUsers()
    {
        $users = User::whereHas('roles', function ($q) {
            $q->whereIn('slug', ['user']);
        })->get();

         return Datatables::of($users)
            ->addColumn('actions', function ($userd) {
                $UsrActCkh = Activations::where('user_id', $userd->id)->first();
                return empty($UsrActCkh) || $UsrActCkh['completed'] == '0' ?
          '<button type="button" id="activateUser" value=' . encrypt($userd->id) . ' class="block">Block</button>
       
         <a  href="user/' . encrypt($userd->id) . '"   class="view">View</a>':

                    '<button type="button" id="activateUser" value=' . encrypt($userd->id) . ' class="block">
Unblock</button><a href="user/' . encrypt($userd->id) . '"   class="view">View</a>';
            })
            ->rawColumns(['actions'])
            ->addIndexColumn()
            ->make();
    }


    public function activateUsers(Request $request)
    {
        $data = $request->input();
        $user = \Sentinel::findById(decrypt($data['id']));
        $UsrActCkh = Activations::where('user_id', decrypt($data['id']))->first();
        if (empty($UsrActCkh) || $UsrActCkh['completed'] == '0') {
            $ActCode = \Activation::create($user);
            \Activation::complete($user, $ActCode['code']);
        } else {
            \Activation::remove($user);
        }
        return Response(array('success' => '1', 'errors' => ''));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin/manage-user-individual');
     }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
