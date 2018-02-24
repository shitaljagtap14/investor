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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');



Route::post('register', 'ApiController@create');
Route::post('login', 'ApiController@login');
Route::get('current/login', 'ApiController@getLoginUser');
Route::get('register/user', 'ApiController@registerAllUser');
Route::get('user', 'ApiController@getUser');

Route::get('viewprofile/{id}', 'ApiController@getprofile');
Route::get('editprofile', 'ApiController@editprofile');
Route::get('subcription', 'ApiController@viewSubcription');
Route::get('subcription/status', 'ApiController@viewSubcriptionByStatus');
Route::get('sweeptake', 'ApiController@viewSweeptake');
Route::get('purchase', 'ApiController@viewPurchase');
Route::get('sweeptake/offer', 'ApiController@viewSweeptakeOffer');
Route::get('sweeptake/active/offer', 'ApiController@viewSweeptakeActiveOffer');
Route::get('Sweeptake/join/user/{id}','ApiController@showJoinUsersList');
Route::get('winner/users-list/{sweeptake}/{id}','ApiController@showWinnerUsersList');
