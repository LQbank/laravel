@extends('home.layout.center')




@section('content')
<link rel="stylesheet" href="/h/address/base.min.css" />
<link rel="stylesheet" href="/h/address/main.min.css" />
<link rel="stylesheet" href="/h/address/address-edit.min.css" />


    <div class="breadcrumbs">
        <div class="container">
            <a href='//www.mi.com/index.html'>首页</a>
            <span class="sep">&gt;</span>
            <span>收货地址</span>
        </div>
    </div>

    <div class="page-main user-main">
        <div class="container">
            <div class="row" height="1000px">
               

                <div class="span16">
                    <div class="uc-box uc-main-box">
                        <div class="uc-content-box">
                            <div class="box-hd">
                                <h1 class="title">收货地址</h1>
                            </div>
                            <div class="box-bd">

                                <div class="user-address-list J_addressList clearfix">
                                    <div class="address-item address-item-new" data-type="" id="J_newAddress"> <i class="iconfont">&#xe609;</i>
                                        添加新地址
                                    </div>
                                    @if(!empty($address))
                                    @foreach($address as $k=>$v)
                                    <div class="address-item J_addressItem" >
                                        <dl>
                                            <dt>
                                                <span class="tag"></span> <em class="uname">{{$v->uname}}</em>
                                            </dt>
                                            <dd class="utel">{{$v->phone}}</dd>
                                            <dd class="uaddress">
                                                {{$v->province}}  {{$v->city}}  {{$v->district}}
                                                <br>{{$v->address}}</dd>
                                        </dl>
                                        <div class="actions">
                                            <!-- <a href="javascript:void(0);" data-id="{{$v->id}}" class="modify J_addressModify">修改</a> -->
                                            <a href="javascript:void(0);"  data-id="{{$v->id}}" class="modify J_addressDel">删除</a>
                                        </div>
                                    </div>
                                    @endforeach
                                    @endif
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="J_modalEditAddress" class="modal fade modal-hide modal-edit-address">
                    <div class="modal-body"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script src="/h/address/myjs/jquery.min.js"></script>
<script src="/h/address/myjs/address.js"></script>
<script src="/h/address/myjs/common.js"></script>
<script src="/h/address/address_all.js"></script>        

<script src="/h/address/data/indexNav.js"></script>
<script src="/h/address/data/indexData.js"></script>
@endsection
