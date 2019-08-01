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
Route::group(['middleware'=>['login']],function(){

	




































	















































































































































	// 后台 首页 的路由
	Route::get('admin','Admin\IndexController@index');


	// 后台 分类 编辑分类属性
	Route::get('admin/tags/index/{id}','Admin\TagsController@index');

	// 后台 分类 编辑分类属性页面
	Route::get('admin/tags/insert/{id}','Admin\TagsController@insert');

	// 后台 分类 执行编辑分类属性
	Route::post('admin/tags/doinsert/{id}','Admin\TagsController@doinsert');

	// 后台 分类 发送ajax
	Route::post('admin/tags/change','Admin\TagsController@change');

	// 后台 商品 发送ajax
	Route::post('admin/goods/getTagAndVals','Admin\GoodsController@getTagAndVals');

	// 后台 商品 发送ajax 上传图片
	Route::post('admin/goods/picUpload','Admin\GoodsController@picUpload');

	// 后台 商品 发送ajax 写入商品
	Route::post('admin/goods/insert','Admin\GoodsController@insert');

	// 后台 商品 发送ajax 写入商品的详细数据
	Route::post('admin/goods/addsku','Admin\GoodsController@addsku');

	// 后台 商品 发送ajax 改变商品的状态
	Route::post('admin/goods/changestatus','Admin\GoodsController@changestatus');

	// 后台 商品 删除商品
	Route::get('admin/goods/del/{id}','Admin\GoodsController@del');

	// 后台 商品 查看商品的sku
	Route::get('admin/goods/indexsku/{id}/{name}','Admin\GoodsController@indexsku');

	// 后台 商品 查看商品的sku
	Route::get('admin/goods/indexsku/{id}/{name}','Admin\GoodsController@indexsku');

	// 后台 商品 更改商品的状态
	Route::get('admin/goods/changeskustatus/{id}/{name}/{status}/{gid}','Admin\GoodsController@changeskustatus');


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




















