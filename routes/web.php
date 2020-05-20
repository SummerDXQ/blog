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

Route::group(['prefix'=>'admin','namespace'=>'Admin'],function(){
    // Login
    Route::get('login','LoginController@login');
    // Captcha
    Route::get('captcha', "LoginController@captcha");
    // Validate login
    Route::post('doLogin', "LoginController@doLogin");
});


// Add middle to check authority 
Route::group(['prefix'=>'admin','namespace'=>'Admin','middleware'=>'isLogin'],function(){
    // Home page
    Route::get('index', "LoginController@index");
    // Welcome page
    Route::get('welcome', "LoginController@welcome");
    // Logout
    Route::get('logout', "LoginController@logout");
});