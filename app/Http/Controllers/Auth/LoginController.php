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

class LoginController extends Controller

{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;


    /**
     * @param Request $request
     * @return mixed
     */
    public function login(Request $request)
    {
        try {
            $data = $request->input();
            if ($data['fb_id'] == '') {
                $validation = Validator::make($data, ValidationRequest::$login);
                if ($validation->fails()) {
                    return ValidationResponse($validation->errors(), Config::get('message.options.VALIDATION_FAILED'));
                }
                //Get and check user data by email
                $userData = User::GetUserByMail($data['email']);
                //Check Email Exit
                if (empty($userData)) {
                    throw new Exception(Config::get('message.options.INLAVID_MAIL'));
                }
//Check User Activation
                $user = \Sentinel::findById($userData->id);
                $activation = Activation::exists($user);
                if (!empty($activation) && $activation != '') {

                }
//Check authenticate user
                $authenticate_user = \Sentinel::authenticateAndRemember($request->all());
                if (empty($authenticate_user) && $authenticate_user == '') {
                    throw new Exception(Config::get('message.options.LOGIN_INVALID'));

                }
                $success['token'] = $userData->createToken('step')->accessToken;
                return SuccessResponse($success, Config::get('message.options.SUCESS'));
            } else {
                $userGet = User::where('fb_id', $data['fb_id'])->first();
                if (empty(json_decode(json_encode($userGet)))) {

                    $credential = array(
                        'email' => $data['email'],
                        'password' => bcrypt(str_random(18)),
                        'first_name' => $data['first_name'],
                        'last_name' =>  $data['last_name'],
                        'fb_id'=>$data['fb_id'],
                    );
                    $user = \Sentinel::registerAndActivate($credential);

                    if (!empty($user)) {
                        $role = \Sentinel::findRoleByName('user');
                        $role->users()->attach($user);
                        $userGet = User::find($user->id);
                        $success['token'] = $userGet->createToken('step')->accessToken;
                       return SuccessResponse($success, Config::get('message.options.SUCESS'));
                    }
                } else {
                     $success['token'] = $userGet->createToken('step')->accessToken;
                    return SuccessResponse($success, Config::get('message.options.SUCESS'));
                }
            }
        } catch (Exception $ex) {
            return FailResponse($ex->getMessage(), $ex->getCode());
        }
    }

    public function logout(Request $request)
    {
        try {
            \Sentinel::logout();
            return Redirect::to('/login');
        } catch (Exception $ex) {
            return View::make('errors.exception')->with('Message', $ex->getMessage());
        }
    }

    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
