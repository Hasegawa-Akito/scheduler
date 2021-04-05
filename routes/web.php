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

Route::get('/roomlogin',function(){
    return view('roomlogin');
});
Route::post('/roomlogin','App\Http\Controllers\LoginController@roomlogin');

Route::get('/userlogin','App\Http\Controllers\LoginController@userlogin_index');
Route::post('/userlogin','App\Http\Controllers\LoginController@userlogin');

Route::get('/timetable/{view_user_id}/{room_id}','App\Http\Controllers\TimetableController@timetable');
Route::post('/timetable/{view_user_id}/{room_id}','App\Http\Controllers\TimetableController@timetable');

Route::get('/add','App\Http\Controllers\AdditionalController@add_index');
Route::post('/add','App\Http\Controllers\AdditionalController@add');

Route::get('/announce','App\Http\Controllers\AnnounceController@announce_index');
Route::post('/announce','App\Http\Controllers\AnnounceController@announce');
Route::post('/announce/delete','App\Http\Controllers\AnnounceController@announce_delete');

Route::get('/serch','App\Http\Controllers\SerchController@serch_index');
Route::post('/serch','App\Http\Controllers\SerchController@serch');

Route::get('/leaving','App\Http\Controllers\LeavingController@leaving_index');
Route::post('/leaving','App\Http\Controllers\LeavingController@leaving');




