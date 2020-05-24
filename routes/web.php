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
    // no permission
    Route::get('noaccess', "LoginController@noaccess");

//    Route::get('jm','LoginController@jm');
});



// Add middle to check authority
Route::group(['prefix'=>'admin','namespace'=>'Admin','middleware'=>['isLogin','HasRole']],function(){
    // Home page
    Route::get('index', "LoginController@index");
    // Welcome page
    Route::get('welcome', "LoginController@welcome");
    // Logout
    Route::get('logout', "LoginController@logout");
    //
    Route::post('user/del', "UserController@delAll");
    //User model
    Route::resource('user','UserController');
    //Role model
    Route::resource('role','RoleController');
    Route::get('role/auth/{id}','RoleController@auth');
    Route::post('role/doAuth','RoleController@doAuth');
    //Permission model
    Route::resource('role','PermissionController');
    //Category model
    Route::resource('cate','CateController');
    // change category order
    Route::post('cate/changeorder','CateController@changeOrder');
    //Article model
    Route::resource('article','ArticleController');
    // Upload
    Route::post('article/upload','ArticleController@upload');
});
