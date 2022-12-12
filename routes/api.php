<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SignInandUpController as SigninandUp;
use App\Http\controllers\Api\CrudControllers as crud;

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
	Route::get('getusers',[SigninandUp::class,'getusers']);
	Route::post('register',[SigninandUp::class,'register']);
	Route::post('/login',[SigninandUp::class,'login']);
	Route::post('/forgetPassword',[SigninandUp::class,'forgetPassword']);

	Route::post('add_uesr',[crud::class,'add_uesr']);
	Route::get('get_user',[crud::class,'get_user']);
    Route::post('edit_user',[crud::class,'edit_user']);
	Route::post('update_user',[crud::class,'update_user']);
	Route::post('delete_user',[crud::class,'delete_user']);
