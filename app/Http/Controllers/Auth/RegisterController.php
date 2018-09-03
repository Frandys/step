<?php

namespace App\Http\Controllers\Auth;

use Activation;
use App\Http\Controllers\Controller;
use Cartalyst\Sentinel\Sentinel;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Exception;
use Cartalyst\Sentinel\Users\UserInterface;
use App\User;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Cartalyst\Sentinel\Laravel\Facades\Reminder;
use App\Http\Requests\ValidationRequest;
use Illuminate\Support\Facades\Validator;
use View;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
//    public function showRegistrationForm()
//    {
//        return view('auth.register');
//    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\User
     */
    public function register(Request $request)
    {
        try {
            $data = $request->input();

            $validation = Validator::make($data, ValidationRequest::$register);
            if ($validation->fails()) {
                 return ValidationResponse($validation->errors(), Config::get('message.options.VALIDATION_FAILED'));
            }

            $credential = [
                'email' => $data['email'],
                'password' => $data['password'],
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
             ];

            $user = \Sentinel::registerAndActivate($credential);

            if (!empty($user)) {
                $role = \Sentinel::findRoleByName('user');
                $role->users()->attach($user);
                $userGet = User::find($user->id);
                $success['token'] = $userGet->createToken('step')->accessToken;
                $success['name'] = $userGet->first_name;
                return SuccessResponse($success, Config::get('message.options.REGISTERED_SUCESS'));
            }
        } catch (Exception $ex) {
            return FailResponse($ex->getMessage(), $ex->getCode());
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
}