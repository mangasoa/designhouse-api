<?php

use Illuminate\Http\Request;
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


// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

 Route::get('/', function(){
     return response()->json(['message' => 'Hello, World'], 200);
 });
*/
//Public routes
Route::get('me', 'App\Http\Controllers\User\MeController@getMe');
/*
Route Group for authenticated users only
*/
 Route::group(['middleware' => ['auth:api']], function(){
    Route::post('logout', 'App\Http\Controllers\Auth\LoginController@logout');
    Route::put('settings/profile', 'App\Http\Controllers\User\SettingsController@updateProfile');
    Route::put('settings/password', 'App\Http\Controllers\User\SettingsController@updatePassword');
 });

 /*
Route Group for authenticated guests only
*/
// Routes for guests only
Route::group(['middleware' => ['guest:api']], function(){
    Route::post('register', 'App\Http\Controllers\Auth\RegisterController@register');
    Route::post('verification/verify/{user}', 'App\Http\Controllers\Auth\VerificationController@verify')->name('verification.verify');
    //Route::post('verification/verify', 'App\Http\Controllers\Auth\VerificationController@verify')->name('verification.verify');
    Route::post('verification/resend', 'App\Http\Controllers\Auth\VerificationController@resend');
    Route::post('login', 'App\Http\Controllers\Auth\LoginController@login');
    Route::post('password/email', 'App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::post('password/reset', 'App\Http\Controllers\Auth\ResetPasswordController@reset');
});

