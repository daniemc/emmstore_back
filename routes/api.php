<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// API healt check
Route::get('/hcheck', function () {
    return response('OK', 200);
});


Route::group(['prefix' => 'auth', ['middleware' => 'throttle:20,5']], function () {
    Route::post('/register', 'api\auth\RegisterController@register');
    Route::post('/login', 'App\Http\Controllers\api\auth\LoginController@login');
    
    Route::post('/password/reset/data', 'api\auth\ResetPasswordController@getResetPasswordData');
    Route::post('/password/reset', 'api\auth\ResetPasswordController@resetPassword');
});

Route::group(['middleware' => 'jwt.verify'], function () {
    Route::get('/logout', 'App\Http\Controllers\api\auth\LoginController@logout');
    Route::get('/authUser', 'App\Http\Controllers\api\UserController@show');

    //users
    Route::get('/users', 'App\Http\Controllers\api\UserController@list');
    Route::post('/users', 'App\Http\Controllers\api\UserController@save');
    Route::put('/user/{id}', 'App\Http\Controllers\api\UserController@update');
    Route::delete('/user/{id}', 'App\Http\Controllers\api\UserController@delete');
});
