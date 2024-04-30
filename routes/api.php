<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

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

// API DB connection check
Route::get('/dbcheck', function () {
    $db = DB::connection()->getDatabaseName();
    return response($db, 200);
});


Route::group(['prefix' => 'auth', ['middleware' => 'throttle:20,5']], function () {
    Route::post('/register', 'App\Http\Controllers\api\auth\RegisterController@register');
    Route::post('/login', 'App\Http\Controllers\api\auth\LoginController@login');
    
    Route::post('/password/reset/data', 'App\Http\Controllers\api\auth\ResetPasswordController@getResetPasswordData');
    Route::post('/password/reset', 'App\Http\Controllers\api\auth\ResetPasswordController@resetPassword');
});

Route::group(['middleware' => 'jwt.verify'], function () {
    Route::get('/logout', 'App\Http\Controllers\api\auth\LoginController@logout');
    Route::get('/authUser', 'App\Http\Controllers\api\auth\LoginController@showLoguedUser');

    //users
    Route::get('/user/{id}', 'App\Http\Controllers\api\UserController@show');
    Route::get('/users', 'App\Http\Controllers\api\UserController@list');
    Route::post('/users', 'App\Http\Controllers\api\UserController@save');
    Route::put('/user/{id}', 'App\Http\Controllers\api\UserController@update');
    Route::delete('/user/{id}', 'App\Http\Controllers\api\UserController@delete');
    Route::post('/user/roles', 'App\Http\Controllers\api\UserController@handleRoleAssign');

    //products
    Route::get('/products', 'App\Http\Controllers\api\ProductsController@list');
    Route::post('/products', 'App\Http\Controllers\api\ProductsController@save');
    Route::put('/product/{id}', 'App\Http\Controllers\api\ProductsController@update');
    Route::delete('/product/{id}', 'App\Http\Controllers\api\ProductsController@delete');
    
    Route::get('/products_varitants', 'App\Http\Controllers\api\ProductVariantController@list');
    Route::post('/products_varitants', 'App\Http\Controllers\api\ProductVariantController@save');
    Route::put('/product_varitants/{id}', 'App\Http\Controllers\api\ProductVariantController@update');
    Route::delete('/product_varitants/{id}', 'App\Http\Controllers\api\ProductVariantController@delete');

    Route::resource('roles', 'App\Http\Controllers\api\RolesController');
    Route::resource('movementtypes', 'App\Http\Controllers\api\MovementTypeController');

    Route::resource('stores', 'App\Http\Controllers\api\StoreController');
    Route::post('/store/users', 'App\Http\Controllers\api\StoreController@handleUserAssign');

    Route::get('/vendors', 'App\Http\Controllers\api\VendorController@index');
});
