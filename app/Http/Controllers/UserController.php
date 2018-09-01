<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Activation;
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
    public function changePassword(Request $request) {
        try {
            $data = $request->input();

            $validation = \Validator::make($data, ValidationRequest::$change_pass);

            if ($validation->fails()) {
                $errors = $validation->messages();
                 return Redirect::back()->with('errors', $errors);
            }

            $hasher = \Sentinel::getHasher();

            $oldPassword = $data['old_password'];
            $password = $data['password'];
            $passwordConf = $data['confirm_password'];

            $user = \Sentinel::getUser();

            if (!$hasher->check($oldPassword, $user->password) || $password != $passwordConf) {
                Session::flash('error', Config::get('message.options.VALID_PASS_MAIL') );
                return Redirect::back();
            }
            \Sentinel::update($user, array('password' => $password));
            \Sentinel::logout();
            Session::flash('success', Config::get('message.options.PAS_CHNGE'));
            return Redirect::to('/login');
        } catch (Exception $ex) {
            return View::make('errors.exception')->with('Message', $ex->getMessage());
        }
    }
}
