<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<title>框架</title>

		<link href="/h/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css">
		<link href="/h/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css">

		<link href="/h/css/personal.css" rel="stylesheet" type="text/css">

		<script src="/h/AmazeUI-2.4.2/assets/js/jquery.min.js" type="text/javascript"></script>
		<script src="/h/AmazeUI-2.4.2/assets/js/amazeui.js" type="text/javascript"></script>

		
		
	</head>

	<body>
		<!--头 -->
		<header>
			<article>
				<div class="mt-logo">
					<!--顶部导航条 -->
					<div class="am-container header">
						<ul class="message-l">
							<div class="topMessage">
								<div class="menu-hd">
									@if(empty(Session::get('home_user')))
										<a href="/home/login" target="_top" class="h">亲，请登录</a>	 
										<a href="/home/register" target="_top">免费注册</a>
									@endif 
							
								</div>
							</div>
						</ul>
						<ul class="message-r">
							<div class="topMessage home">
								<div class="menu-hd"><a href="/home" target="_top" class="h">商城首页</a></div>
							</div>
							<div class="topMessage my-shangcheng">
								@if(!empty(Session::get('home_user')))
									<div class="menu-hd MyShangcheng"><a href="/home/center" target="_top"><i class="am-icon-user am-icon-fw"></i>个人中心</a></div>	
								@endif 
								
							</div>
							<div class="topMessage mini-cart">
								<div class="menu-hd"><a id="mc-menu-hd" href="/home/car" target="_top"><i class="am-icon-shopping-cart  am-icon-fw"></i><span>购物车</span><strong id="J_MiniCartNum" class="h">0</strong></a></div>
							</div>
							<div class="topMessage favorite">
								<div class="menu-hd"><a href="/home/collection" target="_top"><i class="am-icon-heart am-icon-fw"></i><span>收藏夹</span></a></div>
						</ul>
						</div>

						<!--悬浮搜索框-->

						<div class="nav white">
							<div class="logoBig">
								<li><img src="/h/images/logobig.png" /></li>
							</div>

							<div class="search-bar pr">
								<a name="index_none_header_sysc" href="#"></a>
								<form>
									<input id="searchInput" name="index_none_header_sysc" type="text" placeholder="搜索" autocomplete="off">
									<input id="ai-topsearch" class="submit am-btn" value="搜索" index="1" type="submit">
								</form>
							</div>
						</div>

						<div class="clear"></div>
					</div>
				</div>
			</article>
		</header>







		<div class="center">
			<div class="col-main">
				<div class="main-wrap">
				@section('content')
                    
                @show
				</div>
				<!--底部-->
				<div class="footer">
					<div class="footer-hd">
						<p>
							<a href="#">恒望科技</a>
							<b>|</b>
							<a href="#">商城首页</a>
							<b>|</b>
							<a href="#">支付宝</a>
							<b>|</b>
							<a href="#">物流</a>
						</p>
					</div>
					<div class="footer-bd">
						<p>
							<a href="#">关于恒望</a>
							<a href="#">合作伙伴</a>
							<a href="#">联系我们</a>
							<a href="#">网站地图</a>
							<em>© 2015-2025 Hengwang.com 版权所有</em>
						</p>
					</div>
				</div>
			</div>

			<aside class="menu">
				<ul>
					<li class="person">
						<a href="/home/center">个人中心</a>
					</li>
					<li class="person">
						<a href="">个人资料</a>
						<ul>
							<li> <a href="/home/data">个人信息</a></li>
						
							<li> <a href="/home/address">收货地址</a></li>
						</ul>
					</li>
					<li class="person">
						<a href="#">我的交易</a>
						<ul>
							<li><a href="/home/order">订单管理</a></li>
						</ul>
					</li>

					<li class="person">
						<a href="#">我的小窝</a>
						<ul>
							<li> <a href="/home/collection">收藏</a></li>
							<!-- <li> <a href="foot.html">足迹</a></li>
							<li> <a href="comment.html">评价</a></li> -->
						</ul>
					</li>

				</ul>

			</aside>
		</div>

	</body>

</html>

<script>
$.ajaxSetup({

		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
</script>
@section('js')
					
@show