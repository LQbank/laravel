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


// 后台 首页 的路由
Route::get('admin','Admin\IndexController@index');

// 后台 用户 路由
Route::resource('admin/users','Admin\UsersController');










































































 
// 前台  注册
Route::get('home/register','Home\RegisterController@index');
// 邮箱注册
Route::post('home/register','Home\RegisterController@store');
// 激活
Route::get('home/register/changestatus','Home\RegisterController@changeStatus');
// 手机号验证
Route::get('home/register/sendPhone','Home\RegisterController@sendPhone');
// 手机号注册
Route::post('home/register/phone','Home\RegisterController@insert');
