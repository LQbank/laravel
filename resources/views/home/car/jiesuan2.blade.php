<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<!-- <title>首页</title> -->

		<link href="/h/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css" />
		<link href="/h/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css" />

		<link href="/h/basic/css/demo.css" rel="stylesheet" type="text/css" />

		<link href="/h/css/hmstyle.css" rel="stylesheet" type="text/css"/>
		<link href="/h/css/skin.css" rel="stylesheet" type="text/css" />

		<script src="/h/AmazeUI-2.4.2/assets/js/jquery.min.js"></script>
		<script src="/h/AmazeUI-2.4.2/assets/js/amazeui.min.js"></script>





		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0 ,minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<title>结算页面</title>

		<link href="/h/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css" />

		<link href="/h/basic/css/demo.css" rel="stylesheet" type="text/css" />
		<link href="/h/css/cartstyle.css" rel="stylesheet" type="text/css" />

		<link href="/h/css/jsstyle.css" rel="stylesheet" type="text/css" />

		<script type="text/javascript" src="/h/js/address.js"></script>

	</head>

	<body>

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
						<div class="menu-hd"><a href="/" target="_top" class="h">商城首页</a></div>
					</div>
					<div class="topMessage my-shangcheng">
						<div class="menu-hd MyShangcheng"><a href="/home/center" target="_top"><i class="am-icon-user am-icon-fw"></i>个人中心</a></div>
					</div>
					<!-- <div class="topMessage mini-cart">
						<div class="menu-hd"><a href="/home/car" id="mc-menu-hd" href="#" target="_top"><i class="am-icon-shopping-cart  am-icon-fw"></i><span>购物车</span><strong id="J_MiniCartNum" class="h">{{ $number }}</strong></a></div>
					</div> -->
					<div class="topMessage favorite">
						<div class="menu-hd"><a href="/home/collection" target="_top"><i class="am-icon-heart am-icon-fw"></i><span>收藏夹</span></a></div>
				</ul>
				</div>

				<!--悬浮搜索框-->

				<div class="nav white">
					<div class="logo"><img src="/h/images/logo.png" /></div>
					<div class="logoBig">
						<li><img src="/h/images/logobig.png" /></li>
					</div>

					<!-- <div class="search-bar pr">
						<a name="index_none_header_sysc" href="#"></a>
						<form>
							<input id="searchInput" name="index_none_header_sysc" type="text" placeholder="搜索" autocomplete="off">
							<input id="ai-topsearch" class="submit am-btn" value="搜索" index="1" type="submit">
						</form>
					</div> -->
				</div>

				<div class="clear"></div>
</div>


	

	<div class="paycont">
		<form action="/home/shopcar/jiesuan2" method="post">
			{{ csrf_field() }}
		<div class="address">
			<h3>确认收货地址 </h3>
			<!-- <div class="control">
				<div class="tc-btn createAddr theme-login am-btn am-btn-danger">使用新地址</div>
			</div> -->
			<div class="clear"></div>
			<ul>
				<div class="per-border"></div>
				<input id="addressid" type="hidden" name="addid" value="">
				@foreach($address as $address)
				<li class="user-addresslist ccc" addid="{{ $address->id }}">

					<div class="address-left">
						<div class="user">

							<span class="buy-address-detail">   
       						<span class="buy-user">{{ $address->uname }} </span>
							<span class="buy-phone">{{ $address->phone }}</span>
							</span>
						</div>
						<div class="default-address">
							<span class="buy-line-title buy-line-title-type">收货地址：</span>
							<span class="buy--address-detail">
					   		<span class="province">{{ $address->province }}</span>省
							<span class="city">{{ $address->city }}</span>
							<span class="dist">{{ $address->district }}</span>
							<span class="street">{{ $address->address }}</span>
							</span>

							
						</div>
						<!-- <ins class="deftip">默认地址</ins> -->
					</div>
					<div class="address-right">
						<a href="person/address.html">
							<span class="am-icon-angle-right am-icon-lg"></span></a>
					</div>
					<div class="clear"></div>
					<!-- <div class="new-addr-btn">
						<a href="#">设为默认</a>
						<span class="new-addr-bar">|</span>
						<a href="#">编辑</a>
						<span class="new-addr-bar">|</span>
						<a href="javascript:void(0);" onclick="delClick(this);">删除</a>
					</div> -->
				</li>
				@endforeach
			</ul>

			<div class="clear"></div>
		</div>
		<!--物流 -->
		

		<!--支付方式-->
		

		<!--订单 -->
		<div class="concent">
			<div id="payTable">
				<h3>确认订单信息</h3>
				<div class="cart-table-th">
					<div class="wp">

						<div class="th th-item">
							<div class="td-inner">商品信息</div>
						</div>
						<div class="th th-price">
							<div class="td-inner">单价</div>
						</div>
						<div class="th th-amount">
							<div class="td-inner">数量</div>
						</div>
						<div class="th th-sum">
							<div class="td-inner">金额</div>
						</div>
						

					</div>
				</div>
				<div class="clear"></div>

					@foreach($array as $array)
					<input type="hidden" name="id[]" value="{{ $array->id }}">
					<input type="hidden" name="number[]" value="{{ $array->number }}">
					<div class="bundle  bundle-last">
						<div class="bundle-main">
							<ul class="item-content clearfix">
								<div class="pay-phone">
									<li class="td td-item">
										<div class="item-pic">
											<a href="#" class="J_MakePoint">
												<img src="{{ $array->pic }}" class="itempic J_ItemImg"></a>
										</div>
										<div class="item-info">
											<div class="item-basic-info">
												<a href="#" class="item-title J_MakePoint" data-point="tbcart.8.11">{{ $array->name }}</a>
											</div>
										</div>
									</li>
									<li class="td td-info">
										<div class="item-props">
											<span class="sku-line">{{ $array->sku }}</span>
											
										</div>
									</li>
									<li class="td td-price">
										<div class="item-price price-promo-promo">
											<div class="price-content">
												<em class="J_Price price-now">{{ $array->price }}</em>
											</div>
										</div>
									</li>
								</div>
								<li class="td td-amount">
									<div class="amount-wrapper ">
										<div class="item-amount ">
											<span class="phone-title">购买数量</span>
											<div class="sl">
												<em class="J_Price price-now">{{ $array->number }}</em>
											</div>
										</div>
									</div>
								</li>
								<li class="td td-sum">
									<div class="td-inner">

										<em tabindex="0" class="J_ItemSum number">{{ $array->price * $array->number }}</em>
									</div>
								</li>
								

							</ul>
							<div class="clear"></div>
						</div>
					</div>
					@endforeach

				
					
				<div class="clear"></div>
				<div class="pay-total">
			<!--留言-->
				
				<!--优惠券 -->
				

					
				<!--含运费小计 -->
				<div class="buy-point-discharge ">
					<p class="price g_price ">
						<input id="zongjia" type="hidden" name="zongjia" value="">
						合计（含运费） <span>¥</span><em class="pay-sum money"></em>
					</p>
				</div>

				<!--信息 -->
				<div class="order-go clearfix">
					<div class="pay-confirm clearfix">
						<div class="box">
							<div tabindex="0" id="holyshit267" class="realPay"><em class="t">实付款：</em>
								<span class="price g_price ">
                        <span>¥</span> <em class="style-large-bold-red money" id="J_ActualFee">244.00</em>
								</span>
							</div>

							<div id="holyshit268" class="pay-address">

								<p class="buy-footer-address">
									<span class="buy-line-title buy-line-title-type">寄送至：</span>
									<span class="buy--address-detail">
					   <span class="province">湖北</span>省
									<span class="city">武汉</span>市
									<span class="dist">洪山</span>区
									<span class="street">雄楚大道666号(中南财经政法大学)</span>
									</span>
									
								</p>
								<p class="buy-footer-address">
									<span class="buy-line-title">收货人：</span>
									<span class="buy-address-detail">   
                             <span class="buy-user">艾迪 </span>
									<span class="buy-phone">15871145629</span>
									</span>
								</p>
							</div>
						</div>

						<div id="holyshit269" class="submitOrder">
							<div class="go-btn-wrap">
								<input id="J_Go" href="success.html" class="btn-go" tabindex="0" title="点击此按钮，提交订单" type="submit" name="" value="提交订单">
								
							</div>
						</div>
						<div class="clear"></div>
					</div>
				</div>
			</div>

			<div class="clear"></div>
		</div>
		</form>
	</div>


<div class="footer ">
						<div class="footer-hd ">
							<p>
								<a href="# ">恒望科技</a>
								<b>|</b>
								<a href="# ">商城首页</a>
								<b>|</b>
								<a href="# ">支付宝</a>
								<b>|</b>
								<a href="# ">物流</a>
							</p>
						</div>
						<div class="footer-bd ">
							<p>
								<a href="# ">关于恒望</a>
								<a href="# ">合作伙伴</a>
								<a href="# ">联系我们</a>
								<a href="# ">网站地图</a>
								<em>© 2015-2025 Hengwang.com 版权所有</em>
							</p>
						</div>
					</div>	

		<!--引导 -->
		<div class="navCir">
			<li class="active"><a href="home.html"><i class="am-icon-home "></i>首页</a></li>
			<li><a href="sort.html"><i class="am-icon-list"></i>分类</a></li>
			<li><a href="shopcart.html"><i class="am-icon-shopping-basket"></i>购物车</a></li>	
			<li><a href="person/index.html"><i class="am-icon-user"></i>我的</a></li>					
		</div>


		<!--菜单 -->
		<div class=tip>
			<div id="sidebar">
				<div id="wrap">
					<div id="prof" class="item ">
						<a href="# ">
							<span class="setting "></span>
						</a>
						<div class="ibar_login_box status_login ">
							<div class="avatar_box ">
								<p class="avatar_imgbox "><img src="/h/images/no-img_mid_.jpg " /></p>
								<ul class="user_info ">
									<li>用户名sl1903</li>
									<li>级&nbsp;别普通会员</li>
								</ul>
							</div>
							<div class="login_btnbox ">
								<a href="# " class="login_order ">我的订单</a>
								<a href="# " class="login_favorite ">我的收藏</a>
							</div>
							<i class="icon_arrow_white "></i>
						</div>

					</div>
					<div id="shopCart " class="item ">
						<a href="# ">
							<span class="message "></span>
						</a>
						<p>
							购物车
						</p>
						<p class="cart_num ">0</p>
					</div>
					<div id="asset " class="item ">
						<a href="# ">
							<span class="view "></span>
						</a>
						<div class="mp_tooltip ">
							我的资产
							<i class="icon_arrow_right_black "></i>
						</div>
					</div>

					<div id="foot " class="item ">
						<a href="# ">
							<span class="zuji "></span>
						</a>
						<div class="mp_tooltip ">
							我的足迹
							<i class="icon_arrow_right_black "></i>
						</div>
					</div>

					<div id="brand " class="item ">
						<a href="#">
							<span class="wdsc "><img src="/h/images/wdsc.png " /></span>
						</a>
						<div class="mp_tooltip ">
							我的收藏
							<i class="icon_arrow_right_black "></i>
						</div>
					</div>

					<div id="broadcast " class="item ">
						<a href="# ">
							<span class="chongzhi "><img src="/h/images/chongzhi.png " /></span>
						</a>
						<div class="mp_tooltip ">
							我要充值
							<i class="icon_arrow_right_black "></i>
						</div>
					</div>

					<div class="quick_toggle ">
						<li class="qtitem ">
							<a href="# "><span class="kfzx "></span></a>
							<div class="mp_tooltip ">客服中心<i class="icon_arrow_right_black "></i></div>
						</li>
						<!--二维码 -->
						<li class="qtitem ">
							<a href="#none "><span class="mpbtn_qrcode "></span></a>
							<div class="mp_qrcode " style="display:none; "><img src="/h/images/weixin_code_145.png " /><i class="icon_arrow_white "></i></div>
						</li>
						<li class="qtitem ">
							<a href="#top " class="return_top "><span class="top "></span></a>
						</li>
					</div>

					<!--回到顶部 -->
					<div id="quick_links_pop " class="quick_links_pop hide "></div>

				</div>

			</div>
			<div id="prof-content " class="nav-content ">
				<div class="nav-con-close ">
					<i class="am-icon-angle-right am-icon-fw "></i>
				</div>
				<div>
					我
				</div>
			</div>
			<div id="shopCart-content " class="nav-content ">
				<div class="nav-con-close ">
					<i class="am-icon-angle-right am-icon-fw "></i>
				</div>
				<div>
					购物车
				</div>
			</div>
			<div id="asset-content " class="nav-content ">
				<div class="nav-con-close ">
					<i class="am-icon-angle-right am-icon-fw "></i>
				</div>
				<div>
					资产
				</div>

				<div class="ia-head-list ">
					<a href="# " target="_blank " class="pl ">
						<div class="num ">0</div>
						<div class="text ">优惠券</div>
					</a>
					<a href="# " target="_blank " class="pl ">
						<div class="num ">0</div>
						<div class="text ">红包</div>
					</a>
					<a href="# " target="_blank " class="pl money ">
						<div class="num ">￥0</div>
						<div class="text ">余额</div>
					</a>
				</div>

			</div>
			<div id="foot-content " class="nav-content ">
				<div class="nav-con-close ">
					<i class="am-icon-angle-right am-icon-fw "></i>
				</div>
				<div>
					足迹
				</div>
			</div>
			<div id="brand-content " class="nav-content ">
				<div class="nav-con-close ">
					<i class="am-icon-angle-right am-icon-fw "></i>
				</div>
				<div>
					收藏
				</div>
			</div>
			<div id="broadcast-content " class="nav-content ">
				<div class="nav-con-close ">
					<i class="am-icon-angle-right am-icon-fw "></i>
				</div>
				<div>
					充值
				</div>
			</div>
		</div>


		<script>
			window.jQuery || document.write('<script src="/h/basic/js/jquery.min.js "><\/script>');
		</script>
		<script type="text/javascript " src="/h/basic/js/quick_links.js "></script>
		<script>
		    $.ajaxSetup({

	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            }
	        });
	    </script>

		<script type="text/javascript">
			$('#J_Go').click(function(){
				if($('.defaultAddr').length != 1){
					alert('请选定配送地址');
					return false;
				}
			})

			var money = 0;
			$('.number').each(function(){
				console.log($(this).html());
				money = money + parseInt($(this).html());
			})
			console.log(money);
			$('.money').html(money);
			$('#zongjia').val(money);

			
			// $('#J_Go').click(function(){
			// 	console.log($('.defaultAddr').eq(0).attr('addid'));


			// 	return false;
			// })
			
			// $('addressid')
			$('.ccc').click(function(){
				// console.log($(this).attr('addid'));
				$('#addressid').val($(this).attr('addid'));
				// console.log($('addressid').val());
			})
		</script>

</body>

</html>	

