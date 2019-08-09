@extends('home.layout.index')

@section('content')
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0 ,minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<title>结算页面</title>

		<link href="/h/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css" />

		<link href="/h/basic/css/demo.css" rel="stylesheet" type="text/css" />
		<link href="/h/css/cartstyle.css" rel="stylesheet" type="text/css" />

		<link href="/h/css/jsstyle.css" rel="stylesheet" type="text/css" />

		<script type="text/javascript" src="/h/js/address.js"></script>

	<div class="paycont">
		<div class="address">
			<h3>确认收货地址 </h3>
			<div class="control">
				<div class="tc-btn createAddr theme-login am-btn am-btn-danger">使用新地址</div>
			</div>
			<div class="clear"></div>
			<ul>
				<div class="per-border"></div>
				<li class="user-addresslist">

					<div class="address-left">
						<div class="user DefaultAddr">

							<span class="buy-address-detail">   
       						<span class="buy-user">艾迪 </span>
							<span class="buy-phone">15871145629</span>
							</span>
						</div>
						<div class="default-address DefaultAddr">
							<span class="buy-line-title buy-line-title-type">收货地址：</span>
							<span class="buy--address-detail">
					   <span class="province">湖北</span>省
							<span class="city">武汉</span>市
							<span class="dist">洪山</span>区
							<span class="street">雄楚大道666号(中南财经政法大学)</span>
							</span>

							
						</div>
						<ins class="deftip">默认地址</ins>
					</div>
					<div class="address-right">
						<a href="person/address.html">
							<span class="am-icon-angle-right am-icon-lg"></span></a>
					</div>
					<div class="clear"></div>

					

				</li>
				<div class="per-border"></div>
				<li class="user-addresslist defaultAddr">
					<div class="address-left">
						<div class="user DefaultAddr">

							<span class="buy-address-detail">   
       						<span class="buy-user">艾迪 </span>
							<span class="buy-phone">15871145629</span>
							</span>
						</div>
						<div class="default-address DefaultAddr">
							<span class="buy-line-title buy-line-title-type">收货地址：</span>
							<span class="buy--address-detail">
					   <span class="province">湖北</span>省
							<span class="city">武汉</span>市
							<span class="dist">武昌</span>区
							<span class="street">东湖路75号众环大厦2栋9层902</span>
							</span>

							
						</div>
						
					</div>
					<div class="address-right">
						<span class="am-icon-angle-right am-icon-lg"></span>
					</div>
					<div class="clear"></div>

					

				</li>

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
								<a id="J_Go" href="success.html" class="btn-go" tabindex="0" title="点击此按钮，提交订单">提交订单</a>
							</div>
						</div>
						<div class="clear"></div>
					</div>
				</div>
			</div>

			<div class="clear"></div>
		</div>
	</div>
@endsection

@section('js')
	<script type="text/javascript">
		var money = 0;
		$('.number').each(function(){
			console.log($(this).html());
			money = money + parseInt($(this).html());
		})
		console.log(money);
		$('.money').html(money);
	</script>
@endsection