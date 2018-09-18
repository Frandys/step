<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

////Admin Routes
Route::get('/', function () {
    $user = \Sentinel::check();
    if (!empty($user) && $user != '') {
        return \Redirect::to('/admin');
    }else{
        return View::make('admin.login');
    }

});
//
//
Route::group(['middleware' => 'admin', 'prefix' => 'admin'], function () {
    Route::get('/', function () {
        return View::make('admin.dashboard');
    });
    Route::get('/change_password', function () {
        return View::make('admin.change-password');
    });
    Route::post('change_password', 'UserController@changePassword');
    Route::resource('user', 'Admin\UserController');
    Route::get('view_users', 'Admin\UserController@viewUsers');
    Route::post('activate_users', 'Admin\UserController@activateUsers');
    Route::resource('merchant', 'Admin\MerchantController');
    Route::post('merchant/delete', 'Admin\MerchantController@merchantDelete');
    Route::resource('merchant_coupon', 'Admin\MerchantCouponController');
    Route::post('merchant_coupon/delete', 'Admin\MerchantCouponController@merchantDelete');
    Route::get('create_coupon/{id}', 'Admin\MerchantCouponController@createCoupon');
    Route::post('check_coupon', 'Admin\MerchantCouponController@checkCoupon');

    Route::resource('body', 'Admin\BodyPartController');
    Route::post('body/delete', 'Admin\BodyPartController@bodyDelete');
    Route::resource('additional', 'Admin\AdditionalMetaController');
    Route::resource('additional-faq', 'Admin\FaqController');

    Route::resource('manage_admin', 'Admin\ManageAdminController');
    Route::post('manage_admin/delete', 'Admin\ManageAdminController@adminDelete');
    Route::post('change_password_admin', 'Admin\ManageAdminController@changePasswordAdmin');
    Route::resource('ticket', 'Admin\TicketController');
    Route::post('view_ticket', 'Admin\TicketController@viewTicket');
    Route::post('ticket/delete', 'Admin\TicketController@ticketDelete');
    Route::resource('challenges', 'Admin\ChallengesController');
    Route::post('view_challenges', 'Admin\ChallengesController@viewChallenges');
    Route::post('get_coupons', 'Admin\ChallengesController@getCoupons');


});