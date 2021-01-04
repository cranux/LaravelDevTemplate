<?php

use Illuminate\Support\Facades\Route;

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

Route::namespace('Api')
    ->middleware(['auth:api'])
    ->group(function () {
        Route::get('/member', 'MemberController@index');
        Route::get('/userList', 'MemberController@getUserList');
    });

Route::namespace('Api')
//    ->middleware('guard:api')
    ->group(function () {
        Route::get('/login', 'LoginController@index');
        Route::get('/wechat/login', 'WechatController@onLogin');

    });
