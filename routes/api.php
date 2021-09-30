<?php

use Illuminate\Http\Request;
use App\Http\Controllers\User\FrontendController;
use App\Http\Controllers\Auth\AdminAuthController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("users/{id?}",'User\FrontendController@getRegisteredUsers');
Route::post("add-users",'User\FrontendController@UserRegisteration');
Route::post("Check-google-id",'User\FrontendController@CheckGoogleId');
Route::post("Check-facebook-id",'Auth\FrontendController@CheckFacebookId');
Route::post("add-google-users",'User\FrontendController@UserGoogleRegisteration');
Route::get("check-email/{email}",'Auth\AdminAuthController@checkAdminEmail');
Route::post("user-login",'Auth\AdminAuthController@UserLogin');
Route::get("states",'User\FrontendController@getStates');
Route::get("cities/{state_id}",'User\FrontendController@getCities');
Route::get("otp",'User\FrontendController@generateOTP');
Route::post("logout",'User\AdminAuthController@logout');

Route::get('image', 'User\FrontendController@displayImage')->name('image.displayImage');
