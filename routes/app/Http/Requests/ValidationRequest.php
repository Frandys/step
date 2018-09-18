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
    public static $register = array(
        'email' => 'email|unique:users,email',
        'password' => 'min:6|max:32',
        'first_name' => 'required|min:2|max:255',
        'last_name' => 'min:2|max:255',
    );

    public static $registerAdmin = array(
        'email' => 'email|unique:users,email',
        'password' => 'min:6|max:255',
        'confirm_password' => 'required|same:password|min:6',
        'first_name' => 'required|min:2|max:255',
        'last_name' => 'min:2|max:255',
    );

    public static $login = array(
        'email' => 'nullable|email',
        'password' => 'required|min:6|max:255',
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

    public static $admin_pass = [
         'password_admin' => 'required|min:6',
        'confirm_password_admin' => 'required|same:password_admin|min:6',
    ];

    public static $userMetA = [
        'first_name' => 'required|min:2|max:255',
        'last_name' => 'min:2|max:255',
        'age' => 'required',
        'gender' => 'required',
        'height' => 'required',
        'weight' => 'required',
        'foot_size' => 'required',
    ];

    public static $userUpdat = [
        'age' => 'required',
        'gender' => 'required',
        'height' => 'required',
        'weight' => 'required',
        'foot_size' => 'required',
    ];

    public static $ImageBase= [
        'image' => 'required',

    ];

    public static $MarchantId= [
        'merchant_id' => 'required',

    ];

    public static $ticketAdd = [
        'title' => 'required|min:2|max:100',
        'question' => 'required|min:2|max:500',
    ];

    public static $MercahntAdd = array(
        'email' => 'email|unique:users,email',
        'first_name' => 'required|min:2|max:255',
        'last_name' => 'required|min:2|max:255',
        'phone' => 'required|min:2|max:10',
        'rating' => 'required',
        'address' => 'required|min:2|max:500',
        'discription' => 'required|min:2|max:500',
     );

    public static $MercahntUpdate = array(

        'first_name' => 'required|min:2|max:255',
        'last_name' => 'required|min:2|max:255',
        'phone' => 'required|min:2|max:10',
        'rating' => 'required',
        'address' => 'required|min:2|max:500',
        'discription' => 'required|min:2|max:500',
    );

    public static $Coupon = array(
        'title' => 'required|min:2|max:255',
        'description' => 'required|max:3000',
        'required_steps' => 'numeric|required',
        'coupon_code' => 'required|max:255',
        'coupon_point' => 'required|max:255',
        'expire_date' => 'required',
    );

    public static $BodyPart = array(
        'title' => 'required|min:2|max:255',
        'slug' => 'required|min:2|max:255',
        'description' => 'required|min:2|max:500',
    );

    public static $Adional = array(
        'title' => 'required|min:2|max:255',
        'description' => 'required|min:2|max:500',
    );
    public static $chat = array(
        'chatAdd' => 'required|min:2|max:2000'
     );

    public static $chlange = array(
        'coupon_id' => 'required',
        'type' => 'required',
        'step' => 'required',
        'start_date_time' => 'required',
        'end_date_time' => 'required',
    );

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
