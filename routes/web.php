<?php

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

Route::get('/', 'FrontController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('building', 'BuildingController');
Route::resource('ap', 'ApController');
Route::resource('user', 'UserController');

Route::get('location', 'SettingController@location')->name('location');
Route::get('showmarker', 'SettingController@showMarker')->name('showmarker');
Route::get('showlayer', 'SettingController@showLayer')->name('showlayer');
