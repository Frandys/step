<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use Activation;
use App\Model\UserMeta;
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

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
//                $user = \Sentinel::findById($userData->id);
//                $activation = Activation::exists($user);
//                if (!empty($activation) && $activation != '') {
//                    throw new Exception(Config::get('message.options.USER_NOT_ACTIVATE'));
//               }
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

    public function ForgotPassword(Request $request)
    {
        try {
            $data = $request->input();
            $validation = \Validator::make($data, ValidationRequest::$forgot_email);
            if ($validation->fails()) {
                return ValidationResponse($validation->errors(), Config::get('message.options.VALIDATION_FAILED'));

            }
            //Get and check user data by email
            $userData = User::GetUserByMail($data['email']);
//Check Email Exit
            if (empty($userData) && $userData == '') {
                throw new Exception(Config::get('message.options.INLAVID_MAIL'));
            }
//Check User Activation
            $user = \Sentinel::findById($userData->id);
            $activation = \Activation::exists($user);

            if (!empty($activation) && $activation != '') {
                throw new Exception(Config::get('message.options.USER_NOT_ACTIVATE'));
            }
            $user_sentinal = \Sentinel::findById($userData->id);

            //get code
            $reminder = \Reminder::exists($user_sentinal) ?: \Reminder::create($user_sentinal);

            $first_name = $userData->first_name;
            if (isset($userData->last_name)) {
                $last_name = $userData->last_name;
            }
            $mail = $userData->email;

            $baseUrl = \URL::to('/');
            $reminder = $reminder->code;
            $baseUrl = $baseUrl . '/password/reset/' . $reminder;
            $VendorTem = \App\Model\EmailTemplate::where('slug', 'forgot_password')->first();
            $mailData = str_replace("{first_name}", $first_name, $VendorTem->body);
            $mailData = str_replace("{last_name}", $last_name, $mailData);
            $content = str_replace("{button}", '  <a href="' . $baseUrl . '" type="button" class="btn btn-primary">Click Here</a>', $mailData);
            \Mail::to($data['email'])->send(new \App\Mail\ForgetMail($content));
            return SuccessResponse('', Config::get('message.options.MAIL_LINK'));
        } catch (Exception $ex) {
            return FailResponse($ex->getMessage(), $ex->getCode());
        }
    }


    public function changePassword(Request $request) {
        try {
            $data = $request->input();

            $validation = \Validator::make($data, ValidationRequest::$change_pass);

            if ($validation->fails()) {
                return ValidationResponse($validation->errors(), Config::get('message.options.VALIDATION_FAILED'));
             }

            $hasher = \Sentinel::getHasher();

            $oldPassword = $data['old_password'];
            $password = $data['password'];
            $passwordConf = $data['confirm_password'];

            $user = \Sentinel::findById(\Auth::user()->id);

            if (!$hasher->check($oldPassword, $user->password) || $password != $passwordConf) {
                throw new Exception(Config::get('message.options.VALID_PASS_MAIL'));
            }
            \Sentinel::update($user, array('password' => $password));
            return SuccessResponse('', Config::get('message.options.PAS_CHNGE'));

        } catch (Exception $ex) {
            return FailResponse($ex->getMessage(), $ex->getCode());
        }
    }

    public function index()
    {
        $usersMeta = UserMeta::with(array('User' => function ($query) {
            $query->select('id', 'email', 'first_name', 'last_name');
        },
         ))->get();
        return SuccessResponse($usersMeta, Config::get('message.options.SUCESS'));
     }

    public function UserByid()
    {
        $usersMeta = UserMeta::with(array('User' => function ($query) {
            $query->select('id', 'email', 'first_name', 'last_name');
        },
        ))->where('user_id',\Auth::user()->id)->get();
        return SuccessResponse($usersMeta, Config::get('message.options.SUCESS'));

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
