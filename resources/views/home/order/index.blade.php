
<link href="/h/css/infstyle.css" rel="stylesheet" type="text/css">
<link href="/h/css/orstyle.css" rel="stylesheet" type="text/css">
@extends('home.layout.center')
@section('content')               
		<div class="user-order">

				<!--标题 -->
				<div class="am-cf am-padding">
					<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">订单管理</strong> / <small>Order</small></div>
				</div>
				<hr>

				<div class="am-tabs am-tabs-d2 am-margin" data-am-tabs="">

					<ul class="am-avg-sm-5 am-tabs-nav am-nav am-nav-tabs">
						<li class="am-active"><a href="#tab1">所有订单{{count($order)}}</a></li>
						<!-- <li><a href="#tab2">待付款</a></li> -->
						<li><a href="#tab3">待发货{{count($order0)}}</a>
						
						</li>
						<li><a href="#tab4">待收货{{count($order1)}}</a></li>
						<li><a href="#tab5">待评价{{$count}}</a></li>
					</ul>

					<div class="am-tabs-bd" style="touch-action: pan-y; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
						<div class="am-tab-panel am-fade am-in am-active" id="tab1">
							<div class="order-top">
								<div class="th th-item">
									商品
								</div>
								<div class="th th-price">
									单价
								</div>
								<div class="th th-number">
									数量
								</div>
								<div class="th th-operation">
									商品操作
								</div>
								<div class="th th-amount">
									合计
								</div>
								<div class="th th-status">
									交易状态
								</div>
								<!-- <div class="th th-change">
									交易操作
								</div> -->
							</div>
							
							@foreach($order as $v)
							<div class="order-main">
								<div class="order-list">
								
									<!--交易成功-->
									<div class="order-status5">
										<div class="order-title">
											<div class="dd-num">订单编号：<a href="javascript:;">{{$v->code}}</a></div>
											<span>成交时间：{{$v->created_at}}</span>
											<!--    <em>店铺：小桔灯</em>-->
										</div>
										<div class="order-content">
											<div class="order-left">

											@foreach($v->sub as $v2)
												@foreach($v2->sub as $v3)
											
												<ul class="item-list">
													<li class="td td-item">
															
														<div class="item-pic">
															<a href="/home/details/{{$v3->id}}" class="J_MakePoint">
																<img src="{{$v3->pic}}" class="itempic J_ItemImg">
															</a>
														</div>
													
														<div class="item-info">
															<div class="item-basic-info">
																<a href="#">
																@foreach($v3->sub as $v4)
																	<p>{{$v4->name}}</p>
																@endforeach
																	<p class="info-little">颜色：{{$v3->sku}}
																		<br>包装：裸装 </p>
																</a>
															</div>
														</div>
													</li>
													<li class="td td-price">
														<div class="item-price">
															{{$v3->price}}
														</div>
													</li>
													<li class="td td-number">
														<div class="item-number">
															<span>×</span>{{$v2->num}}
														</div>
													</li>
													<li class="td td-operation">
														<div class="item-operation">
															
														</div>
													</li>
												</ul>
												@endforeach
											@endforeach


											</div>
											<div class="order-right">
												<li class="td td-amount">
													<div class="item-amount">
														合计：{{$v->total}}
														<!-- <p>含运费：<span>10.00</span></p> -->
													</div>
												</li>
												<div class="move-right">
													<li class="td td-status">
														<div class="item-status">
															<p class="Mystatus">交易成功</p>
															<!-- <p class="order-info"><a href="orderinfo.html">订单详情</a></p>
															<p class="order-info"><a href="logistics.html">查看物流</a></p> -->
														</div>
													</li>
													<!-- <li class="td td-change">
														<div class="am-btn am-btn-danger anniu">
															删除订单</div>
													</li> -->
												</div>
											</div>
										</div>
									</div>
								

								</div>

							</div>
							@endforeach

						</div>
						
						<div class="am-tab-panel am-fade" id="tab3">
							<div class="order-top">
								<div class="th th-item">
									商品
								</div>
								<div class="th th-price">
									单价
								</div>
								<div class="th th-number">
									数量
								</div>
								<div class="th th-operation">
									商品操作
								</div>
								<div class="th th-amount">
									合计
								</div>
								<div class="th th-status">
									交易状态
								</div>
								<!-- <div class="th th-change">
									交易操作
								</div> -->
							</div>

							@foreach($order0 as $v)
							<div class="order-main">
								<div class="order-list">
								
									<!--交易成功-->
									<div class="order-status5">
										<div class="order-title">
											<div class="dd-num">订单编号：<a href="javascript:;">{{$v->code}}</a></div>
											<span>成交时间：{{$v->created_at}}</span>
											<!--    <em>店铺：小桔灯</em>-->
										</div>
										<div class="order-content">
											<div class="order-left">

											@foreach($v->sub as $v2)
												@foreach($v2->sub as $v3)
											
												<ul class="item-list">
													<li class="td td-item">
															
														<div class="item-pic">
															<a href="/home/details/{{$v3->id}}" class="J_MakePoint">
																<img src="{{$v3->pic}}" class="itempic J_ItemImg">
															</a>
														</div>
													
														<div class="item-info">
															<div class="item-basic-info">
																<a href="#">
																@foreach($v3->sub as $v4)
																	<p>{{$v4->name}}</p>
																@endforeach
																	<p class="info-little">颜色：{{$v3->sku}}
																		<br>包装：裸装 </p>
																</a>
															</div>
														</div>
													</li>
													<li class="td td-price">
														<div class="item-price">
															{{$v3->price}}
														</div>
													</li>
													<li class="td td-number">
														<div class="item-number">
															<span>×</span>{{$v2->num}}
														</div>
													</li>
													<li class="td td-operation">
														<div class="item-operation">
															
														</div>
													</li>
												</ul>
												@endforeach
											@endforeach


											</div>
											<div class="order-right">
												<li class="td td-amount">
													<div class="item-amount">
														合计：{{$v->total}}
														<!-- <p>含运费：<span>10.00</span></p> -->
													</div>
												</li>
												<div class="move-right">
													<li class="td td-status">
														<div class="item-status">
															<p class="Mystatus">买家已付款</p>
															<!-- <p class="order-info"><a href="orderinfo.html">订单详情</a></p> -->
														</div>
													</li>
													<!-- <li class="td td-change">
														<div class="am-btn am-btn-danger anniu">
															提醒发货</div>
													</li> -->
												</div>
											</div>
										</div>
									</div>
								

								</div>

							</div>
							@endforeach
						</div>
						<div class="am-tab-panel am-fade" id="tab4">
							<div class="order-top">
								<div class="th th-item">
									商品
								</div>
								<div class="th th-price">
									单价
								</div>
								<div class="th th-number">
									数量
								</div>
								<div class="th th-operation">
									商品操作
								</div>
								<div class="th th-amount">
									合计
								</div>
								<div class="th th-status">
									交易状态
								</div>
								<div class="th th-change">
									交易操作
								</div>
							</div>

							@foreach($order1 as $v)
							<div class="order-main">
								<div class="order-list">
								
									<!--交易成功-->
									<div class="order-status5">
										<div class="order-title">
											<div class="dd-num">订单编号：<a href="javascript:;">{{$v->code}}</a></div>
											<span>成交时间：{{$v->created_at}}</span>
											<!--    <em>店铺：小桔灯</em>-->
										</div>
										<div class="order-content">
											<div class="order-left">

											@foreach($v->sub as $v2)
												@foreach($v2->sub as $v3)
											
												<ul class="item-list">
													<li class="td td-item">
															
														<div class="item-pic">
															<a href="/home/details/{{$v3->id}}" class="J_MakePoint">
																<img src="{{$v3->pic}}" class="itempic J_ItemImg">
															</a>
														</div>
													
														<div class="item-info">
															<div class="item-basic-info">
																<a href="#">
																@foreach($v3->sub as $v4)
																	<p>{{$v4->name}}</p>
																@endforeach
																	<p class="info-little">颜色：{{$v3->sku}}
																		<br>包装：裸装 </p>
																</a>
															</div>
														</div>
													</li>
													<li class="td td-price">
														<div class="item-price">
															{{$v3->price}}
														</div>
													</li>
													<li class="td td-number">
														<div class="item-number">
															<span>×</span>{{$v2->num}}
														</div>
													</li>
													<li class="td td-operation">
														<div class="item-operation">
															
														</div>
													</li>
												</ul>
												@endforeach
											@endforeach


											</div>
											<div class="order-right">
												<li class="td td-amount">
													<div class="item-amount">
														合计：{{$v->total}}
														<!-- <p>含运费：<span>10.00</span></p> -->
													</div>
												</li>
												<div class="move-right">
													<li class="td td-status">
														<div class="item-status">
															<p class="Mystatus">卖家已发货</p>
															<!-- <p class="order-info"><a href="orderinfo.html">订单详情</a></p>
															<p class="order-info"><a href="logistics.html">查看物流</a></p>
															<p class="order-info"><a href="#">延长收货</a></p> -->
														</div>
													</li>
													<li class="td td-change">
														<div class="am-btn am-btn-danger anniu  status"  info="{{$v->id}}">
															确认收货
														</div>
													</li>
												</div>
											</div>
										</div>
									</div>
								

								</div>

							</div>
							@endforeach

						</div>

						<div class="am-tab-panel am-fade" id="tab5">
							<div class="order-top">
								<div class="th th-item">
									商品
								</div>
								<div class="th th-price">
									单价
								</div>
								<div class="th th-number">
									数量
								</div>
								<div class="th th-operation">
									商品操作
								</div>
								<!-- <div class="th th-amount">
									合计
								</div> -->
								<div class="th th-status">
									交易状态
								</div>
								<div class="th th-change">
									交易操作
								</div>
							</div>

							@foreach($order2 as $v)
								@foreach($v->sub as $v2)
									@foreach($v2->sub as $v3)
							<div class="order-main">
								<div class="order-list">
								
									<!--交易成功-->
									<div class="order-status5">
										<div class="order-title">
											<div class="dd-num">订单编号：<a href="javascript:;">{{$v->code}}</a></div>
											<span>成交时间：{{$v->created_at}}</span>
											<!--    <em>店铺：小桔灯</em>-->
										</div>
										<div class="order-content">
											<div class="order-left">

										
											
												<ul class="item-list">
													<li class="td td-item">
															
														<div class="item-pic">
															<a href="/home/details/{{$v3->id}}" class="J_MakePoint">
																<img src="{{$v3->pic}}" class="itempic J_ItemImg">
															</a>
														</div>
													
														<div class="item-info">
															<div class="item-basic-info">
																<a href="#">
																@foreach($v3->sub as $v4)
																	<p>{{$v4->name}}</p>
																@endforeach
																	<p class="info-little">颜色：{{$v3->sku}}
																		<br>包装：裸装 </p>
																</a>
															</div>
														</div>
													</li>
													<li class="td td-price">
														<div class="item-price">
															{{$v3->price}}
														</div>
													</li>
													<li class="td td-number">
														<div class="item-number">
															<span>×</span>{{$v2->num}}
														</div>
													</li>
													<li class="td td-operation">
														<div class="item-operation">
															
														</div>
													</li>
												</ul>
											


											</div>
											<div class="order-right">
												<!-- <li class="td td-amount">
													<div class="item-amount">
														合计：{{$v->total}}
														
													</div>
												</li> -->
												<div class="move-right">
													<li class="td td-status">
														<div class="item-status">
															<p class="Mystatus">交易成功</p>
															<!-- <p class="order-info"><a href="orderinfo.html">订单详情</a></p>
															<p class="order-info"><a href="logistics.html">查看物流</a></p> -->
														</div>
													</li>
													<li class="td td-change">
														<a href="/home/reply/{{$v->id}}/{{$v3->id}}/{{$v2->id}}">
															<div class="am-btn am-btn-danger anniu">
																评价商品</div>
														</a>
													</li>
												</div>
											</div>
										</div>
									</div>
								

								</div>

							</div>
							@endforeach
							@endforeach
							@endforeach


						</div>
					</div>

				</div>
			</div>
			@endsection

@section('js')  	
	

	<script>

		$('.status').each(function(){

        this.onclick=function(evevt){

            var id = this.getAttribute('info');
            console.log(id);

                $.ajax({
                    type: 'POST',
                    url: '/home/order/changeStatus', 
                    data: { 'id': id },
                    // dataType: 'json',
                    success: function(mes){
						
						if(mes=='ok'){
							window.location.href ="/home/order"; 
						}
                        
                    },
                    error: function(){
                    
                    }
                });

        }


        })
    </script>
@endsection