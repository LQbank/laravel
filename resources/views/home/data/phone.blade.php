@extends('home.layout.center')
@section('content')
<link href="/h/css/stepstyle.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="/h/js/jquery-1.7.2.min.js"></script>

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
                    
                    $(this).css('display','none');
                })
                </script>
            
                    <div class="am-cf am-padding">
						<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">绑定手机</strong> / <small>Bind&nbsp;Phone</small></div>
					</div>
					<hr/>
					<!--进度条-->
					<div class="m-progress">
						<div class="m-progress-list">
							<span class="step-1 step">
                                <em class="u-progress-stage-bg"></em>
                                <i class="u-stage-icon-inner">1<em class="bg"></em></i>
                                <p class="stage-name">绑定手机</p>
                            </span>
							<span class="step-2 step">
                                <em class="u-progress-stage-bg"></em>
                                <i class="u-stage-icon-inner">2<em class="bg"></em></i>
                                <p class="stage-name">完成</p>
                            </span>
							<span class="u-progress-placeholder"></span>
						</div>
						<div class="u-progress-bar total-steps-2">
							<div class="u-progress-bar-inner"></div>
						</div>
					</div> 
					
                       

                        @if(!empty(session('home_user')->phone))
                        <form class="am-form am-form-horizontal"  method="post" action="/home/data/changephone2">
                        {{ csrf_field() }}
						<div class="am-form-group bind">
							<label for="user-phone" class="am-form-label">旧手机验证</label>
							<div class="am-form-content">
                                
                                <input type="tel" disabled  value="{{ substr(session('home_user')->phone, 0, 3).'****'.substr(session('home_user')->phone, 7) }}"   >
                                <input type="hidden" value="{{session('home_user')->phone}}"  name="phone2"    class="phone">
							</div>
                        </div>
                        
						<div class="am-form-group code">
                        <label for="user-new-code" class="am-form-label">验证码</label>
							<div class="am-form-content">
                                <input type="tel" class="code" placeholder="短信验证码" name="code2">
                
							</div>
							<a class="btn  sendMobileCode" href="javascript:void(0);"  >
								<div class="am-btn am-btn-danger  dyMobileButton"  >获取</div>
                            </a>	
                        </div>

                        <div class="am-form-group">
							<label for="user-new-phone" class="am-form-label">新手机验证</label>
							<div class="am-form-content">
								<input type="tel"  placeholder="绑定新手机号"  name="phone" class="phone">
							</div>
						</div>
						<div class="am-form-group code">
							<label for="user-new-code" class="am-form-label">验证码</label>
							<div class="am-form-content">
                                <input type="tel" class="code" placeholder="短信验证码" name="code">
                
							</div>
							<a class="btn sendMobileCode" href="javascript:void(0);"  >
								<div class="am-btn am-btn-danger  dyMobileButton"  >获取</div>
                            </a>			   
                        </div>
                        @else
                        <form class="am-form am-form-horizontal"  method="post" action="/home/data/changephone">
                         {{ csrf_field() }}
						<div class="am-form-group">
							<label for="user-new-phone" class="am-form-label">验证手机</label>
							<div class="am-form-content">
								<input type="tel"  placeholder="绑定新手机号"  name="phone" id="phone">
							</div>
						</div>
						<div class="am-form-group code">
							<label for="user-new-code" class="am-form-label">验证码</label>
							<div class="am-form-content">
                                <input type="tel" id="code" placeholder="短信验证码" name="code">
                
							</div>
							<a class="btn" href="javascript:void(0);" onClick="sendMobileCode();" id="sendMobileCode">
								<div class="am-btn am-btn-danger" id="dyMobileButton" >获取</div>
                            </a>
                          
										   
                        </div>
                        @endif
						<div class="info-btn">
							<button class="am-btn am-btn-danger">保存修改</button>
						</div>

					</form>


@endsection

								
									
@section('js')										
									  	
                               
								<script type="text/javascript">
									function sendMobileCode(){

											// 获取用户的验证码
											let phone = $('#phone').val();
                                            // console.log(phone);
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
												// if (res.error_code == 0) {
												// 	alert('发送成功，验证码10分钟有效')
												// }else{
												// 	alert('发送失败')
												// }
												console.log(res);
                                                if (res !== 0) {
													alert('发送成功，验证码10分钟有效')
                                                   
												}else{
													alert('发送失败')
												} 

											},'json');

										}

									}
                                </script>
                                
                        
                                
                                <script type="text/javascript">
									
                                    
                                    // console.log($('.sendMobileCode').eq(0));
                                $('.sendMobileCode').each(function(index){
                                   
                                    $('.sendMobileCode').eq(index).click(function(){

                                        // console.log($('.sendMobileCode').eq(index));

                                        // 获取用户的验证码
                                        let phone = $('.phone').eq(index).val();
                                        // console.log(phone);
                                        // 验证格式
                                        let phone_preg = /^1{1}[3-9]{1}[\d]{9}$/;
                                        if (!phone_preg.test(phone)) {
                                            alert('手机号格式不正确')
                                            return false;
                                        }
											
										let dyMobileButton = $('.dyMobileButton').eq(index);
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
												// if (res.error_code == 0) {
												// 	alert('发送成功，验证码10分钟有效')
												// }else{
												// 	alert('发送失败')
												// }
												console.log(res);
                                                if (res !== 0) {
													alert('发送成功，验证码10分钟有效')
                                                   
												}else{
													alert('发送失败')
												}           

											},'json');

										}



                                    })

                                })

										
								
                                </script>

@endsection					  
									