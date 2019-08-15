
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
                    // console.log('11');

                        $(this).css('display','none');
                })
            
                </script>
                    <div class="am-cf am-padding">
						<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">绑定邮箱</strong> / <small>Email</small></div>
					</div>
					<hr/>
					<!--进度条-->
					<div class="m-progress">
						<div class="m-progress-list">
							<span class="step-1 step">
                                <em class="u-progress-stage-bg"></em>
                                <i class="u-stage-icon-inner">1<em class="bg"></em></i>
                                <p class="stage-name">验证邮箱</p>
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
					<form class="am-form am-form-horizontal"  action="/home/data/changeemail" method="post" >
                        {{ csrf_field() }}
						<div class="am-form-group">
							<label for="user-email" class="am-form-label">验证邮箱</label>
							<div class="am-form-content">
								<input type="email" id="user-email" placeholder="请输入邮箱地址" name="email"  value="{{ old('email') }}">
							</div>
						</div>
						<!-- <div class="am-form-group code">
							<label for="user-code" class="am-form-label">验证码</label>
							<div class="am-form-content">
								<input type="tel" id="user-code" placeholder="验证码">
							</div>
							<a class="btn" href="javascript:void(0);" onClick="sendMobileCode();" id="sendMobileCode">
								<div class="am-btn am-btn-danger">验证码</div>
							</a>
						</div> -->
						<div class="info-btn">
							<button class="am-btn am-btn-danger">保存修改</button>
						</div>

					</form>


@endsection