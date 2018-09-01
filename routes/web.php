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

//Admin Routes
//'middleware' => 'vendor',
Route::get('/', function () {
    return View::make('auth.login');
});


Route::group(['middleware' => 'admin', 'prefix' => 'admin'], function () {

    Route::get('/', function () {
        return View::make('admin.home');
    });
    Route::get('/change_password', function () {
        return View::make('admin.change_password');
    });
     Route::post('change_password', 'UserController@changePassword');
});