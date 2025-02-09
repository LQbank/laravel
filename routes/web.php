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
    // return view('home/index/index');
});


// 前台首页
Route::get('/','Home\IndexController@index');


//后台 登录 路由
Route::get('admin/login','Admin\LoginController@login');

//后台 执行登录 路由
Route::post('admin/login/dologin','Admin\LoginController@dologin');

//后台退出登录
Route::get('admin/logout','Admin\LoginController@logout');

// 权限页面
Route::get('admin/allow',function(){
	return view('admin.allow.allow');
});


// 权限验证的中间件  【allow】
// Route::group(['middleware'=>['login','allow']],function(){
Route::group(['middleware'=>['login']],function(){

	//后台 订单管理 查看退货订单
	Route::get('admin/order/tuihuo','Admin\OrderController@tuihuo');

	//后台 订单管理 查看退货订单
	Route::post('admin/order/changeStatus2','Admin\OrderController@changeStatus2');


	// 后台 首页 的路由
	Route::get('/admin','Admin\IndexController@index');

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

	//后台 订单管理 查看
	Route::resource('admin/order','Admin\OrderController');

	//后台 订单管理 查看订单
	Route::get('admin/order/showorder/{id}','Admin\OrderController@showorder');

	
	//后台 订单管理 修改状态ajax
	Route::post('admin/order/changeStatus','Admin\OrderController@changeStatus');

	
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

	// 继承友情链接
	Route::get('home/layout','Home\LayoutController@index');


	// 继承友情链接
	Route::get('home/layout/center','Home\LayoutController@center');


	// 列表页
	Route::get('home/list/{id}','Home\ListController@index');
	//列表页ajax (查询选择属性后的数据排序)
	Route::post('home/list/sort','Home\ListController@sort');
	// 购物车
	Route::get('home/car','Home\CarController@index');



	// 详情页
	Route::get('home/details/{id}','Home\DetailsController@index');

	// 详情页 发送ajax
	Route::post('home/details/faajax','Home\DetailsController@faajax');

	// 详情页 加入购物车
	Route::get('home/shopcar/insert/{id}/{num}','Home\ShopCarController@insert');

	// 购物车 删除购物车内的商品
	Route::post('home/car/shanajax','Home\ShopCarController@shanajax');

	// 购物车 结算页面
	Route::post('home/shopcar/jiesuan','Home\ShopCarController@jiesuan');

	// 购物车 执行结算
	Route::post('home/shopcar/jiesuan2','Home\ShopCarController@jiesuan2');

	// 购物车 跳转订单成功页面
	Route::get('home/shopcar/jiesuan3/{total}/{addid}','Home\ShopCarController@jiesuan3');

	// 购物车 添加地址
	Route::post('home/shopcar/address','Home\ShopCarController@address');

	// 中文分词 
	Route::resource('home/search','Home\SearchController');
	



	

/**
 * 	判断是否登录访问个人中心
 */
Route::group(['middleware' => ['home']], function () {
   
	//  个人中心
	Route::get('home/center','Home\CenterController@index');


	//  收藏夹
	Route::get('home/collection','Home\CollectionController@index');
	//添加收藏
	Route::get('/home/collection/{id}/{sku}','Home\CollectionController@create');


	//  个人资料
	Route::get('home/data','Home\DataController@index');
	//个人信息修改
	Route::post('home/data/changedata','Home\DataController@changedata');
	//个人头像修改
	Route::post('home/data/avatar','Home\DataController@avatar');



	//  安全设置
	Route::get('/home/data/safety','Home\DataController@safety');

	//修改密码
	Route::get('/home/data/changepassword','Home\DataController@changepassword');

	//执行修改密码
	Route::post('/home/data/edit','Home\DataController@edit');

	//换绑邮箱页面
	Route::get('/home/data/email','Home\DataController@email');

	//换绑邮箱
	Route::post('/home/data/changeemail','Home\DataController@changeemail');

	//换绑手机号页面
	Route::get('/home/data/phone','Home\DataController@phone');

	//换绑手机号
	Route::post('/home/data/changephone','Home\DataController@changephone');

	//换绑手机号
	Route::post('/home/data/changephone2','Home\DataController@changephone2');




	//  地址管理 
	Route::get('home/address','Home\addressController@index');

	//地址添加
	Route::get('home/address/add','Home\addressController@add');

	//地址删除
	Route::get('home/address/del','Home\addressController@del');

	//修改默认收货地址
	Route::get('/home/address/changeStatus','Home\addressController@changeStatus');




	//  订单管理
	Route::get('home/order','Home\OrderController@index');
	//前台 订单管理 修改状态ajax
	Route::post('home/order/changeStatus','Home\OrderController@changeStatus');

	//前台 订单管理 退货
	Route::post('home/order/tuihuo','Home\OrderController@tuihuo');




	//  评价页面
	Route::get('/home/reply/{id}/{sku}/{detail}','Home\ReplyController@index');

	//评价添加
	Route::post('home/reply/add/{id}/{sku}/{detail}','Home\ReplyController@add');

	//添加成功
	Route::get('home/reply/replyok','Home\ReplyController@replyok');

	//评价显示
	Route::get('home/comment','Home\CommentController@index');

});






