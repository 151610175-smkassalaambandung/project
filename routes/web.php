<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::group(['prefix'=>'admin','middleware'=>['auth','role:admin']], function(){
	Route::resource('pelajaran','PelajaranController');
	Route::resource('kelas','KelasController');
	Route::resource('jurusan','JurusanController');
});

Route::get('settings/profile','SettingsController@profile');
Route::get('settings/profile/edit','SettingsController@editProfile');
Route::post('settings/profile','SettingsController@updateProfile');

Route::get('settings/password','SettingsController@editPassword');
Route::post('settings/password','SettingsController@updatePassword');