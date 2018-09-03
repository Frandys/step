<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Activation;
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
use Cartalyst\Sentinel\Laravel\Facades\Reminder;
use App\Http\Requests\ValidationRequest;
use Illuminate\Support\Facades\Validator;
use View;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */


    /**
     * @param Request $request
     * @return mixed
     */
    public function sendResetLinkEmail(Request $request)
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

            Mail::to($data['email'])->send(new \App\Mail\ForgetMail($content));
             throw new Exception(Config::get('message.options.MAIL_LINK'));

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
