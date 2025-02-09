<!DOCTYPE html>
<html>

	<head lang="en">
		<meta charset="UTF-8">
		<title>登录</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta name="format-detection" content="telephone=no">
		<meta name="renderer" content="webkit">
		<meta http-equiv="Cache-Control" content="no-siteapp" />

		<link rel="stylesheet" href="/h/AmazeUI-2.4.2/assets/css/amazeui.css" />
		<link href="/h/css/dlstyle.css" rel="stylesheet" type="text/css">
		<script src="/h/AmazeUI-2.4.2/assets/js/jquery.min.js"></script>
	</head>

	<style>
		li {
			font-size: 13px;
			display: list-item;
			text-align: -webkit-match-parent;
			list-style-position: inside;
			list-style-type: inherit;
			margin: 0;
			line-height: 20px;
		} 
		
		.mws-form-message.error {	
		background-color: #ffcbca;
		border-color: #eb979b;
		color: #9b4449;
		margin:0 auto;
		width:auto;
		height:auto;
		}

		.mws-form-message {
		font-size: 13px;
		cursor: pointer;
		border: 1px solid #d2d2d2;
		padding: 15px 8px 15px 45px;
		position: relative;
		vertical-align: middle;
		background-color: #f8f8f8;
		background-position: 12px 12px;
		background-repeat: no-repeat;
		margin-bottom: 12px;
		-webkit-border-radius: 3px;
		-moz-border-radius: 3px;
		border-radius: 3px;
		}
	</style>
	
	</head>


	

		
	<body>

		<div class="login-boxtitle">
			<a href="home.html"><img alt="logo" src="/h/images/logobig.png" /></a>
		</div>

		<div id="error">

			@if (Session::has('success'))
			<div class="mws-form-message error">
				<ul class="alert alert-danger">
						<li>{{ Session::get('success') }}</li>
				</ul>
			</div>
			@endif 
			@if ( $errors->all())
			<div class="mws-form-message error">
				<ul class="alert alert-danger">
					@foreach ( $errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
			@endif
    	
		</div>
		<script>
		$('#error').click(function(){
			// console.log('11');

				$(this).css('display','none');
		})
	
		</script>
		

		<div class="login-banner">
			<div class="login-main">
				<div class="login-banner-bg"><span></span><img src="/h/images/big.jpg" /></div>
				<div class="login-box">

							<h3 class="title">登录商城</h3>

							<div class="clear"></div>
							
						<div class="login-form">
						<form  action="/home/login/dologin" method="post">
                    			{{ csrf_field() }}
							   	<div class="user-name">
								    <label for="user"><i class="am-icon-user"></i></label>
								    <input type="text" name="email" id="user"  value="{{old('email')}}" placeholder="邮箱/手机/用户名">
								</div>
								<div class="user-pass">
									<label for="password"><i class="am-icon-lock"></i></label>
									<input type="password" name="passwd" id="password" placeholder="请输入密码">
								</div>
								<div class="am-cf">
									<input type="submit" name="" value="登 录" class="am-btn am-btn-primary am-btn-sm">
								</div>
              			</form>
           </div>
            
						<div class="login-links">
							<label for="remember-me"><input id="remember-me" type="checkbox">记住密码</label>
											<a href="#" class="am-fr">忘记密码</a>
											<a href="/home/register" class="zcnext am-fr am-btn-default">注册</a>
											<br />
						</div>
								
						<div class="partner">		
								<h3>合作账号</h3>
							<div class="am-btn-group">
								<li><a href="#"><i class="am-icon-qq am-icon-sm"></i><span>QQ登录</span></a></li>
								<li><a href="#"><i class="am-icon-weibo am-icon-sm"></i><span>微博登录</span> </a></li>
								<li><a href="#"><i class="am-icon-weixin am-icon-sm"></i><span>微信登录</span> </a></li>
							</div>
						</div>	

				</div>
			</div>
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
	</body>

</html>