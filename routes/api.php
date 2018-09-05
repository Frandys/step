<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group(['namespace' => 'Apis'], function () {
    Route::post('register', 'UserController@register')->name('register');
    Route::post('login', 'UserController@login')->name('login');
    Route::post('ForgotPassword', 'UserController@ForgotPassword')->name('ForgotPassword');
});


Route::group(['middleware' => 'auth:api', 'namespace' => 'Apis'], function () {
    Route::post('user_meta_add', 'UserController@UserMetaAdd')->name('UserMetaAdd');
    Route::post('changePassword', 'UserController@changePassword')->name('changePassword');
    Route::post('user_profile', 'UserController@UpdateProfile')->name('user_profile');
    Route::get('user_by_id', 'UserController@UserByid')->name('UserByid');
    Route::resource('user', 'UserController');
    Route::resource('user', 'UserController');
    Route::post('user_update', 'UserController@UserUpdate')->name('user_update');

    Route::resource('merchant', 'MerchantController');

    Route::get('/body', function () {
        return SuccessResponse(\App\Model\BodyParts::select('slug')->get(), Config::get('message.options.SUCESS'));
    });

    Route::get('/body/{slug}', function ($slug) {
        return SuccessResponse(\App\Model\BodyParts::where('slug',$slug)->get(), Config::get('message.options.SUCESS'));
    });
});