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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });



Route::get("users/{id?}",'User\FrontendController@getRegisteredUsers');
Route::post("register",'User\FrontendController@UserRegisteration');
Route::post("Check-google-id",'User\FrontendController@CheckGoogleId');
Route::post("Check-facebook-id",'Auth\FrontendController@CheckFacebookId');
Route::post("add-google-users",'User\FrontendController@UserGoogleRegisteration');
Route::post("check-email",'Auth\AdminAuthController@checkAdminEmail');
Route::post("login",'Auth\AdminAuthController@UserLogin');
Route::get("states",'User\FrontendController@getStates');
// Route::get("cities/{state_id}",'User\FrontendController@getCities');
Route::post("cities",'User\FrontendController@getCities');
Route::get("otp",'User\FrontendController@generateOTP');
Route::get("terms",'User\FrontendController@termsConditions');
Route::post("logout",'Auth\AdminAuthController@logout');
Route::post("forgot-password",'Auth\AdminAuthController@forgotPassword');
Route::post("reset-password",'Auth\AdminAuthController@resetPassword');
Route::get("test",'User\FrontendController@test');
