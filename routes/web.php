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

	session(['admin_login'=>null]);
	session(['admin_userinfo'=>null]);
	session(['admin_nodes'=>null]);
    return view('welcome');
});


//后台 登录 路由
Route::get('admin/login','Admin\LoginController@login');

//后台 执行登录 路由
Route::post('admin/login/dologin','Admin\LoginController@dologin');

// 权限页面
Route::get('admin/allow',function(){
	return view('admin.allow.allow');
});


// 权限验证的中间件  【allow】
Route::group(['middleware'=>['login','allow']],function(){

	// 后台 首页 的路由
	Route::get('admin','Admin\IndexController@index');

	// 后台 用户 路由
	Route::resource('admin/users','Admin\UsersController');

	
	// 后台 分类 路由
	Route::resource('admin/cates','Admin\CatesController');

	// 后台 管理员 管理
	Route::resource('admin/adminuser','Admin\AdminuserController');

	// 后台  权限 管理
	Route::resource('admin/nodes','Admin\NodesController'); 

	// 后台 角色 管理
	Route::resource('admin/roles','Admin\RolesController'); 

	// 后台 商品 管理
	Route::resource('admin/goods','Admin\GoodsController'); 
	
});




















