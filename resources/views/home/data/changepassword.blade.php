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
                    <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">修改密码</strong> / <small>Password</small></div>
                </div>
                <hr/>
                <!--进度条-->
                <div class="m-progress">
                    <div class="m-progress-list">
                        <span class="step-1 step">
                            <em class="u-progress-stage-bg"></em>
                            <i class="u-stage-icon-inner">1<em class="bg"></em></i>
                            <p class="stage-name">重置密码</p>
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
                <form class="am-form am-form-horizontal"   action="/home/data/edit"  method="post">
                    {{ csrf_field() }}
                    <div class="am-form-group">
                        <label for="user-old-password" class="am-form-label">原密码</label>
                        <div class="am-form-content">
                            <input type="password" id="user-old-password" placeholder="请输入原登录密码" name="oldpasswd"> 
                        </div>
                    </div>
                    <div class="am-form-group">
                        <label for="user-new-password" class="am-form-label">新密码</label>
                        <div class="am-form-content">
                            <input type="password" id="user-new-password" placeholder="由数字、字母组合" name="passwd"> 
                        </div>
                    </div>
                    <div class="am-form-group">
                        <label for="user-confirm-password" class="am-form-label">确认密码</label>
                        <div class="am-form-content">
                            <input type="password" id="user-confirm-password" placeholder="请再次输入上面的密码" name="repass">
                        </div>
                    </div>
                    <div class="info-btn">
                        <button class="am-btn am-btn-danger">保存修改</button>
                    </div>

                </form>



@endsection