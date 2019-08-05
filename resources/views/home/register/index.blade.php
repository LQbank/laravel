<!DOCTYPE html>
<html>

	<head lang="en">
		<meta charset="UTF-8">
		<title>注册</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta name="format-detection" content="telephone=no">
		<meta name="renderer" content="webkit">
		<meta http-equiv="Cache-Control" content="no-siteapp" />

		<link rel="stylesheet" href="/h/AmazeUI-2.4.2/assets/css/amazeui.min.css" />
		<link href="/h/css/dlstyle.css" rel="stylesheet" type="text/css">
		<script src="/h/AmazeUI-2.4.2/assets/js/jquery.min.js"></script>
		<script src="/h/AmazeUI-2.4.2/assets/js/amazeui.min.js"></script>

	<style>
		 /* .alert-danger {
		color: #761b18;
		background-color: #f9d6d5;
		border-color: #f7c6c5;
		} */
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
			<a href="home/demo.html"><img alt="" src="/h/images/logobig.png" /></a>
		</div>

		<div id="error">
			@if ( $errors->getBag('email')->any())
			<div class="mws-form-message error">
				<ul class="alert alert-danger">
					@foreach ( $errors->getBag('email')->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
			@endif
    	
			@if ( $errors->getBag('phone')->any())
				<div class="mws-form-message error">
				<ul class="alert alert-danger">
					@foreach ($errors->getBag('phone')->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
				</div>
			@endif
		</div>
		<script>
		$('#error').click(function(){
			console.log('11');

				$(this).css('display','none');
		})
	
	</script>

		<div class="res-banner">
			<div class="res-main">
				<div class="login-banner-bg"><span></span><img src="/h/images/big.jpg" /></div>
				<div class="login-box">

						<div class="am-tabs" id="doc-my-tabs">
							<ul class="am-tabs-nav am-nav am-nav-tabs am-nav-justify">
								<li class="am-active"><a href="">邮箱注册</a></li>
								<li><a href="">手机号注册</a></li>
							</ul>
							<div class="am-tabs-bd">
								<div class="am-tab-panel am-active">
									<form method="post" action="/home/register">
										
										{{ csrf_field() }}
									  	<div class="user-email">
										    <label for="email">
										     	<i class="am-icon-envelope-o"></i>
										    </label>
										    <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="请输入邮箱账号">
										</div>
										<div class="user-pass">
										    <label for="password">
										     	<i class="am-icon-lock"></i>
										    </label>
										    <input type="password" name="passwd" id="password" placeholder="设置密码">
										</div>

							
										<div class="user-pass">
										    <label for="passwordRepeat">
										     	<i class="am-icon-lock"></i>
										    </label>
										    <input type="password" name="repass" id="passwordRepeat" placeholder="确认密码">
										</div>
										
										
										<div class="am-cf">
											<input type="submit" name="" value="注册" class="am-btn am-btn-primary am-btn-sm am-fl">
										</div>
									</form>
                 					
									 <div class="login-links">
											<label for="reader-me">
												<input id="reader-me" type="checkbox"> 点击表示您同意商城《服务协议》
											</label>
								  	</div>
										
								</div>

								<div class="am-tab-panel">
									<form method="post" action="/home/register/phone">
									
										{{ csrf_field() }}
									  	<div class="user-phone">
										    <label for="phone">
										      	<i class="am-icon-mobile-phone am-icon-md"></i>
										    </label>
										    <input type="tel" name="phone" id="phone" placeholder="请输入手机号">
										</div>
									  	<div class="verification">
										    <label for="code">
										      	<i class="am-icon-code-fork"></i>
										    </label>
										    <input type="tel" name="code" id="code" placeholder="请输入验证码" style="width: 160px;">
										    <a class="btn" href="javascript:void(0);" onClick="sendMobileCode();" id="sendMobileCode">
										      	<span id="dyMobileButton" style="width: 80px;">获取</span>
										   	</a>
									  	</div>
									  	<div class="user-pass">
										    <label for="password">
										      	<i class="am-icon-lock"></i>
										    </label>
										    <input type="password" name="passwd" id="password" placeholder="设置密码">
										</div>
									  	<div class="user-pass">
										    <label for="passwordRepeat">
										      	<i class="am-icon-lock"></i>
										    </label>
										    <input type="password" name="repass" id="passwordRepeat" placeholder="确认密码">
										</div>
										

										<div class="am-cf">
											<input type="submit" name="" value="注册" class="am-btn am-btn-primary am-btn-sm am-fl">
										</div>
									</form>
									<div class="login-links">
											<label for="reader-me">
												<input id="reader-me" type="checkbox"> 点击表示您同意商城《服务协议》
											</label>
									</div>
									<hr>
								</div>

								<script>
									$(function() {
									    $('#doc-my-tabs').tabs();
									  })
								</script>
								<script type="text/javascript">
									function sendMobileCode(){

											// 获取用户的验证码
											let phone = $('#phone').val();
											// 验证格式
											let phone_preg = /^1{1}[3-9]{1}[\d]{9}$/;
											if (!phone_preg.test(phone)) {
												alert('手机号格式不正确')
												return false;
											}
											
										let dyMobileButton = $('#dyMobileButton');
										let con =  	dyMobileButton.html();
										// 设置按钮样式
										dyMobileButton.attr('disabled',true);
										dyMobileButton.css('color','#ccc');
										dyMobileButton.css('cursor','not-allowed');
										let time = null;

										if(con == '获取'){
											let i = 60;
											time = setInterval(function(){
												i--;
												dyMobileButton.html('('+i+')发送');

												if(i <= 0){
													clearInterval(time);
													// 设置按钮样式
													dyMobileButton.attr('disabled',false);
													dyMobileButton.css('color','#333');
													dyMobileButton.css('cursor','pointer');
													dyMobileButton.html('获取');
												}
											},1000);


											// 发送ajax  发送验证码
											$.get('/home/register/sendPhone',{phone},function(res){
												if (res.error_code == 0) {
													alert('发送成功，验证码10分钟有效')
												}else{
													alert('发送失败')
												}
											},'json');

										}

									}
								</script>

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