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

Route::group(['middleware' => 'guest'], function () {
    Route::post('auth/login', 'Auth\LoginController@login');
    Route::post('auth/register', 'Auth\RegisterController@store');
});

Route::post('message', 'MessageController@store');

Route::group(['middleware' => 'jwt.auth'], function () {
    Route::get('auth/check', 'Auth\LoginController@check');
    Route::get('auth/logout', 'Auth\LoginController@logout');

    Route::apiResource('message', 'MessageController', ['except' => [
        'store',
    ]]);
});
