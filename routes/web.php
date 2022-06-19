<?php

use Illuminate\Support\Facades\Route;

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


Route::get('/roomlogin', 'App\Http\Controllers\LoginController@roomlogin_index');
Route::post('/roomlogin', 'App\Http\Controllers\LoginController@roomlogin');

Route::post('/roomcreate', 'App\Http\Controllers\LoginController@roomcreate');

Route::get('/userlogin', 'App\Http\Controllers\LoginController@userlogin_index');
Route::post('/userlogin', 'App\Http\Controllers\LoginController@userlogin');

Route::post('/usercreate', 'App\Http\Controllers\LoginController@usercreate');

Route::get('/timetable/{view_user_id}/{room_id}/{display_date}', 'App\Http\Controllers\TimetableController@timetable_index');
Route::post('/timetable/{view_user_id}/{room_id}', 'App\Http\Controllers\TimetableController@timetable');
Route::post('/timetable/delete', 'App\Http\Controllers\TimetableController@timetable_delete');

Route::get('/add', 'App\Http\Controllers\AdditionalController@add_index');
Route::post('/add', 'App\Http\Controllers\AdditionalController@add');

Route::get('/announce', 'App\Http\Controllers\AnnounceController@announce_index');
Route::post('/announce', 'App\Http\Controllers\AnnounceController@announce');
Route::post('/announce/delete', 'App\Http\Controllers\AnnounceController@announce_delete');

Route::get('/serch', 'App\Http\Controllers\SerchController@serch_index');
Route::post('/serch', 'App\Http\Controllers\SerchController@serchApi');

Route::get('/leaving', 'App\Http\Controllers\LeavingController@leaving_index');
Route::post('/leaving', 'App\Http\Controllers\LeavingController@leaving');

//ユーザー、ルーム被り防止api
Route::post('/getroom', 'App\Http\Controllers\GetdataController@getRoom');
Route::post('/getuser', 'App\Http\Controllers\GetdataController@getUser');


