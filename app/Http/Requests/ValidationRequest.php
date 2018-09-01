<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public static $login = array(
        'email' => 'required|email|max:255',
        'password' => 'required|min:6',
    );

    public static $forgot_email = array(
        'email' => 'required|string|email|max:255',
      );

    public static $pass_reset = array(
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|confirmed|min:6',
    );

    public static $change_pass = [
        'old_password' => 'required|min:6',
        'password' => 'required|min:6',
        'confirm_password' => 'required|same:password|min:6',
    ];

    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
