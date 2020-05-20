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

Route::get('/', function () {
    return view('welcome');
});

// Login
Route::get('/admin/login','Admin\LoginController@login');
// Captcha
Route::get('/admin/captcha', "Admin\LoginController@captcha");
// Validate login
Route::post('/admin/doLogin', "Admin\LoginController@doLogin");
// Home page
Route::get('/admin/index', "Admin\LoginController@index");
// Welcome page
Route::get('/admin/welcome', "Admin\LoginController@welcome");