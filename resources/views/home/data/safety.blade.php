@extends('home.layout.center')




@section('content')
<link href="/h/css/infstyle.css" rel="stylesheet" type="text/css">

            <!--标题 -->
            <div class="user-safety">
                <div class="am-cf am-padding">
                    <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">账户安全</strong> / <small>Set&nbsp;up&nbsp;Safety</small></div>
                </div>
                <hr/>

              

                <div class="check">
                    <ul>
                        <li>
                            <i class="i-safety-lock"></i>
                            <div class="m-left">
                                <div class="fore1">登录密码</div>
                                <div class="fore2"><small>为保证您购物安全，建议您定期更改密码以保护账户安全。</small></div>
                            </div>
                            <div class="fore3">
                                <a href="/home/data/changepassword">
                                    <div class="am-btn am-btn-secondary">修改</div>
                                </a>
                            </div>
                        </li>
                        <!-- <li>
                            <i class="i-safety-wallet"></i>
                            <div class="m-left">
                                <div class="fore1">支付密码</div>
                                <div class="fore2"><small>启用支付密码功能，为您资产账户安全加把锁。</small></div>
                            </div>
                            <div class="fore3">
                                <a href="setpay.html">
                                    <div class="am-btn am-btn-secondary">立即启用</div>
                                </a>
                            </div>
                        </li> -->
                        <li>
                            <i class="i-safety-iphone"></i>
                            <div class="m-left">
                                <div class="fore1">手机验证</div>
                                @if(session('home_user')->phone)

                                <div class="fore2"><small>您验证的手机：{{ substr(session('home_user')->phone, 0, 3).'****'.substr(session('home_user')->phone, 7)}} 若已丢失或停用，请立即更换</small></div>
                                @else

                                <div class="fore2"><small>请绑定手机号</small></div>
                                @endif
                            
                            </div>
                            <div class="fore3">
                                <a href="/home/data/phone">
                                    <div class="am-btn am-btn-secondary">换绑</div>
                                </a>
                            </div>
                        </li>
                        <li>
                            <i class="i-safety-mail"></i>
                            <div class="m-left">
                                <div class="fore1">邮箱验证</div>
                                @if(session('home_user')->email)
                                <div class="fore2"><small>您验证的邮箱：{{substr(session('home_user')->email, 0, 4).'********'}}@qq.com 可用于快速找回登录密码</small></div>
                                @else

                                <div class="fore2"><small>请您绑定邮箱并验证,可用于快速找回登录密码</small></div>
                                @endif
                           
                            </div>
                            <div class="fore3">
                                <a href="/home/data/email">
                                    <div class="am-btn am-btn-secondary">换绑</div>
                                </a>
                            </div>
                        </li>
                        <!-- <li>
                            <i class="i-safety-idcard"></i>
                            <div class="m-left">
                                <div class="fore1">实名认证</div>
                                <div class="fore2"><small>用于提升账号的安全性和信任级别，认证后不能修改认证信息。</small></div>
                            </div>
                            <div class="fore3">
                                <a href="idcard.html">
                                    <div class="am-btn am-btn-secondary">认证</div>
                                </a>
                            </div>
                        </li> -->
                        <!-- <li>
                            <i class="i-safety-security"></i>
                            <div class="m-left">
                                <div class="fore1">安全问题</div>
                                <div class="fore2"><small>保护账户安全，验证您身份的工具之一。</small></div>
                            </div>
                            <div class="fore3">
                                <a href="question.html">
                                    <div class="am-btn am-btn-secondary">认证</div>
                                </a>
                            </div>
                        </li> -->
                    </ul>
                </div>

            </div>


@endsection