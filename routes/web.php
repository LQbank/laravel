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
// 前台首页
Route::get('/','Home\IndexController@index');

Route::get('/', function () {

	session(['admin_login'=>null]);
	session(['admin_userinfo'=>null]);
	session(['admin_nodes'=>null]);
    return view('home/index/index');
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

	// 后台 分类 更改分类的是否上架
	Route::post('admin/cates/changestatus','Admin\CatesController@changestatus');

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

	//后台 轮播图 管理
	Route::resource('admin/cartoon','Admin\CartoonController');

	//后台 轮播图状态 ajax
	Route::post('/admin/cartoon/changeStatus','Admin\CartoonController@changeStatus');

	// 后台 商品 管理
	Route::resource('admin/goods','Admin\GoodsController'); 


	
	//后台 友情链接 管理
	Route::resource('admin/link','Admin\LinkController');

	//后台 友情链接状态 ajax
	Route::post('/admin/link/changeStatus','Admin\linkController@changeStatus');
});





 
// 前台 注册
Route::get('home/register','Home\RegisterController@index');
// 邮箱 注册
Route::post('home/register','Home\RegisterController@store');
// 激活
Route::get('home/register/changestatus','Home\RegisterController@changeStatus');
// 手机号 验证
Route::get('home/register/sendPhone','Home\RegisterController@sendPhone');
// 手机号 注册
Route::post('home/register/phone','Home\RegisterController@insert');



//前台 登录 路由
Route::get('home/login','Home\LoginController@index');
// Route::resource('home/login','Home\LoginController');

//前台 执行登录 路由
Route::post('home/login/dologin','Home\LoginController@dologin');



//退出 登录
Route::get('home/logout','Home\IndexController@logout');
// 列表页
Route::get('home/list/{id}','Home\ListController@index');

//列表页ajax (查询选择属性后的数据排序)
Route::post('home/list/sort','Home\ListController@sort');
// 购物车
Route::get('home/car','Home\CarController@index');
// 个人中心
Route::get('home/center','Home\CenterController@index');
// 收藏夹
Route::get('home/collection','Home\CollectionController@index');
// 个人资料
Route::get('home/data','Home\DataController@index');
// 订单管理
Route::get('home/order','Home\OrderController@index');
// 地址管理
Route::get('home/address','Home\addressController@index');
//地址添加
Route::get('home/address/add','Home\addressController@add');
//地址删除
Route::get('home/address/del','Home\addressController@del');

//个人信息修改
Route::post('home/data/changedata','Home\DataController@changedata');

//个人头像修改
Route::post('home/data/avatar','Home\DataController@avatar');






















































// 详情页
Route::get('home/details/{id}','Home\DetailsController@index');

// 详情页 发送ajax
Route::post('home/details/faajax','Home\DetailsController@faajax');

// 详情页 加入购物车
Route::get('home/shopcar/insert/{id}/{num}','Home\ShopCarController@insert');

// 购物车 删除购物车内的商品
Route::post('home/car/shanajax','Home\ShopCarController@shanajax');

// 购物车 结算
Route::post('home/shopcar/jiesuan','Home\ShopCarController@jiesuan');

