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
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ValidationRequest;
use Illuminate\Support\Facades\Validator;
use View;

class ManageAdminController extends Controller
{

    /**
     * ManageAdminController constructor.
     */
    public function __construct()
    {
//        $user = \Sentinel::getUser();
//        if (!$user->hasAccess('admin.create')) {
//            return Redirect('/');
//        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::whereHas('roles', function ($q) {
            $q->whereIn('slug', ['admin']);
        })->get();
        return view('admin/manage-admin-users', compact('users'));
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

        $validation = \Validator::make($data, ValidationRequest::$registerAdmin);
        if ($validation->fails()) {
            $errors = $validation->messages()->all();
            return Response(array('success' => '0', 'data' => null, 'errors' => $errors['0']));
        }

        $credential = [
            'email' => $data['email'],
            'password' => $data['password'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
        ];

        $user = \Sentinel::registerAndActivate($credential);

        if (!empty($user)) {
            $role = \Sentinel::findRoleByName('admin');
            $role->users()->attach($user);


            $user->permissions = [
                'admin.create' => false,
             ];
            $user->save();

            Mail::to($user)->send(new \App\Mail\ForgetMail($credential));
            Session::flash('success', Config::get('message.options.MAIL_LINK'));

            return Response(array('success' => '1', 'data' => Config::get('message.options.SUCESS'), 'errors' => ''));

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


    public function changePasswordAdmin(Request $request)
    {
        try {
            $data = $request->input();
             $validation = \Validator::make($data, ValidationRequest::$admin_pass);
            if ($validation->fails()) {
                $errors = $validation->messages()->all();
                return Response(array('success' => '0', 'data' => null, 'errors' => $errors['0']));
            }

            $hasher = \Sentinel::getHasher();

            $password = $data['password_admin'];
            //$passwordConf = $data['confirm_password'];

            $user = \Sentinel::findById($data['user_id_pass']);

//            if (!$hasher->check($oldPassword, $user->password) || $password != $passwordConf) {
//                return Response(array('success' => '0', 'data' => null, 'errors' => Config::get('message.options.VALID_PASS_MAIL')));
//
//            }
            \Sentinel::update($user, array('password' => $password));

            return Response(array('success' => '1', 'data' => Config::get('message.options.SUCESS'), 'errors' => ''));

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

    public function adminDelete(Request $request)
    {
        $data = $request->input();
        $user = \Sentinel::findById($data['delete']);
        $user->delete();
        \Session::flash('success', 'Deleted successfully');
        return Redirect::back();
    }
}
