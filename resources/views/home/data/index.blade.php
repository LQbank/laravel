
@extends('home.layout.center')
@section('content')

<link href="/h/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css">
<link href="/h/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css">

<link href="/h/css/personal.css" rel="stylesheet" type="text/css">
<link href="/h/css/infstyle.css" rel="stylesheet" type="text/css">
<script src="/h/AmazeUI-2.4.2/assets/js/jquery.min.js" type="text/javascript"></script>
<script src="/h/AmazeUI-2.4.2/assets/js/amazeui.js" type="text/javascript"></script>

<script src="/h/ymd/jquery-3.2.0.min.js"></script>
					<div class="user-info">
						<!--标题 -->
						<div class="am-cf am-padding">
							<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">个人资料</strong> / <small>Personal&nbsp;information</small></div>
						</div>
						<hr>

						<!--头像 -->
						<div class="user-infoPic">
							<form action="/home/data/avatar" method="post" enctype="multipart/form-data" id="avatar">
							{{csrf_field()}}
							<div class="filePic">
								<input type="file" name="avatar" class="inputPic" allowexts="gif,jpeg,jpg,png,bmp" accept="image/*">
								<img class="am-circle am-img-thumbnail"  id="img" src="/uploads/{{Session::get('home_user')->avatar}}" alt="">
							</div>
								<input type="hidden" name="id" value="{{Session::get('home_user')->id}}">
							</form>

							<p class="am-form-help">头像</p>

							<div class="info-m">
							
								<div><b>用户名：<i>{{Session::get('home_user')->name}}</i></b></div>
							
								<div class="u-level">
									<span class="rank r2">
							             <s class="vip1"></s><a class="classes" href="#">铜牌会员</a>
						            </span>
								</div>
								<div class="u-safety">
									<a href="safety.html">
									 账户安全
									<span class="u-profile"><i class="bc_ee0000" style="width: 60px;" width="0">60分</i></span>
									</a>
								</div>
							</div>
						</div>

						<!--个人信息 -->
						<div class="info-main">
							<form class="am-form am-form-horizontal"  action="/home/data/changedata" method="post"  enctype="multipart/form-data">
							{{csrf_field()}}
								<div class="am-form-group">
									<label for="user-name2" class="am-form-label">昵称</label>
									<div class="am-form-content">
										<input type="text" id="user-name2" placeholder="nickname" name="nickname"  value="{{Session::get('home_user')->nickname  ? Session::get('home_user')->nickname : ''}}">

									</div>
								</div>

								<div class="am-form-group">
									<label for="user-name" class="am-form-label">姓名</label> 
									<div class="am-form-content">
										<input type="text" id="user-name2" placeholder="name"  name="name"  value="{{Session::get('home_user')->name  ? Session::get('home_user')->name : ''}}">

									</div>
								</div>

								<div class="am-form-group">
									<label class="am-form-label">性别</label>
									<div class="am-form-content sex">

							
										<label class="am-radio-inline">
											<input type="radio" name="radio" value="boy" {{Session::get('home_user')->sex=="1"  ? 'checked' : ''}}   data-am-ucheck="" class="am-ucheck-radio"><span class="am-ucheck-icons"><i class="am-icon-unchecked"></i><i class="am-icon-checked"></i></span> 男
										</label>
										<label class="am-radio-inline">
											<input type="radio" name="radio" value="girl" {{Session::get('home_user')->sex=="0"  ? 'checked' : ''}}    data-am-ucheck="" class="am-ucheck-radio"><span class="am-ucheck-icons"><i class="am-icon-unchecked"></i><i class="am-icon-checked"></i></span> 女
										</label>
										<label class="am-radio-inline">
											<input type="radio"  name="radio"   value="secret"  {{Session::get('home_user')->sex=="2"  ? 'checked' : ''}}  data-am-ucheck="" class="am-ucheck-radio"><span class="am-ucheck-icons"><i class="am-icon-unchecked"></i><i class="am-icon-checked"></i></span> 保密
										</label>


									</div>
								</div>
							
								

								<div class="am-form-group"  id="date">
									<label for="user-birth" class="am-form-label">生日</label>
									<div class="am-form-content">
									<input type="date"   value="{{Session::get('home_user')->birthday  ? Session::get('home_user')->birthday : ''}}"   name="birthday">
									</div>
								</div> 
								
								@if(!empty(Session::get('home_user')->phone))
								<div class="am-form-group">
									<label for="user-phone" class="am-form-label">电话</label>
									<div class="am-form-content">
										<input id="user-phone"  type="tel"  name="phone" 
											{{Session::get('home_user')->phone  ? 'disabled' :''}} 
										value="{{Session::get('home_user')->phone  ? Session::get('home_user')->phone : ''}}">

									</div>
								</div>
								@endif

								@if(!empty(Session::get('home_user')->email))
								<div class="am-form-group">
									<label for="user-email" class="am-form-label">电子邮件</label>
									<div class="am-form-content">
										<input id="user-email" placeholder="Email" type="email" name="email"
										{{Session::get('home_user')->email  ? 'disabled' :''}} 
										value="{{Session::get('home_user')->email  ? Session::get('home_user')->email : ''}}">

									</div>
								</div>
								@endif
								<!-- <div class="am-form-group address">
									<label for="user-address" class="am-form-label">收货地址</label>
									<div class="am-form-content address">
										<a href="address.html">
											<p class="new-mu_l2cw">
												<span class="province">湖北</span>省
												<span class="city">武汉</span>市
												<span class="dist">洪山</span>区
												<span class="street">雄楚大道666号(中南财经政法大学)</span>
												<span class="am-icon-angle-right"></span>
											</p>
										</a>

									</div>
								</div>
								<div class="am-form-group safety">
									<label for="user-safety" class="am-form-label">账号安全</label>
									<div class="am-form-content safety">
										<a href="safety.html">

											<span class="am-icon-angle-right"></span>

										</a>

									</div>
								</div> -->
								<div class="info-btn">
								<button class="am-btn am-btn-danger">保存修改</button>
								</div>

							</form>
						</div>

					</div>


@endsection

@section('js')
	



	<script>
		// 如果里面val值后发送ajax
		$("input[name='avatar']").bind("change", function(){

				$.ajax({
					url:"/home/data/avatar",
					type:'POST',
					cache:false,
					data:new FormData($('#avatar')[0]),
					processData:false,
					contentType:false,
					// dataType:"json",
					success:function(data){
						console.log(data);
						//判断是否上传成功
						if(data){
							
							//将返回的值替换写入img
							$('#img').attr('src','/uploads/' + data);

						}else{
							alert('上传失败');
						}
					
					}
				});
		});
		

		
	</script>

@endsection