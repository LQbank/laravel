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


//前台 登录
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');




// 后台 首页 的路由
Route::get('admin','Admin\IndexController@index');

// 后台 用户 路由
Route::resource('admin/users','Admin\UsersController');




















// 后台 分类 路由
Route::resource('admin/cates','Admin\CatesController');
