@extends('home.layout.index')
@section('content')
        <link type="text/css" href="/h/css/optstyle.css" rel="stylesheet" />       
		<link type="text/css" href="/h/css/style.css" rel="stylesheet" />

		<script type="text/javascript" src="/h/basic/js/jquery-1.7.min.js"></script>
		<script type="text/javascript" src="/h/basic/js/quick_links.js"></script>

		
		<script type="text/javascript" src="/h/js/jquery.imagezoom.min.js"></script>
		<script type="text/javascript" src="/h/js/jquery.flexslider.js"></script>
		<script type="text/javascript" src="/h/js/list.js"></script>



	<link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="/h/xingxing/css/star-rating.css" media="all" rel="stylesheet"  />
        
   
    <script src="/h/xingxing/js/star-rating.min.js" type="text/javascript"></script>

	
	<style>
        a, a:hover{
			color: #000; 
        }

		a:link, a:visited, a:hover {	
			text-decoration: none;
			outline: none;
		}
		.nav.white .logoBig {
			display: block;
			float: left;
			height: 90px;
			width: 200px;
			margin-left: -31px;
		}
		
	</style>

        <div class="listMain">

				<!--分类-->
			<div class="nav-table">
					   <div class="long-title"><span class="all-goods">全部分类</span></div>
					   <div class="nav-cont">
							<ul>
								<li class="index"><a href="#">首页</a></li>
                                <li class="qc"><a href="#">闪购</a></li>
                                <li class="qc"><a href="#">限时抢</a></li>
                                <li class="qc"><a href="#">团购</a></li>
                                <li class="qc last"><a href="#">大包装</a></li>
							</ul>
						    <div class="nav-extra">
						    	<i class="am-icon-user-secret am-icon-md nav-user"></i><b></b>我的福利
						    	<i class="am-icon-angle-right" style="padding-left: 10px;"></i>
						    </div>
						</div>
			</div>
				<ol class="am-breadcrumb am-breadcrumb-slash">
					<li><a href="#">首页</a></li>
					<li><a href="#">分类</a></li>
					<li class="am-active">内容</li>
				</ol>
				<script type="text/javascript">
					$(function() {});
					$(window).load(function() {
						$('.flexslider').flexslider({
							animation: "slide",
							start: function(slider) {
								$('body').removeClass('loading');
							}
						});
					});
				</script>
				<!-- <div class="scoll">
					<section class="slider">
						<div class="flexslider">
							<ul class="slides">
								<li>
									<img src="/h/images/01.jpg" title="pic" />
								</li>
								<li>
									<img src="/h/images/02.jpg" />
								</li>
								<li>
									<img src="/h/images/03.jpg" />
								</li>
							</ul>
						</div>
					</section>
				</div> -->

				<!--放大镜-->

				<div class="item-inform">
					<div class="clearfixLeft" id="clearcontent">

						<div class="box">
							<script type="text/javascript">
								$(document).ready(function() {
									$(".jqzoom").imagezoom();
									$("#thumblist li a").click(function() {
										$(this).parents("li").addClass("tb-selected").siblings().removeClass("tb-selected");
										$(".jqzoom").attr('src', $(this).find("img").attr("mid"));
										$(".jqzoom").attr('rel', $(this).find("img").attr("big"));
									});
								});
							</script>

							<div class="tb-booth tb-pic tb-s310">
								<a href="images/01.jpg"><img src="{{ $good->pic }}" big="{{ $good->pic }}" id="src" alt="细节展示放大镜特效" rel="{{ $good->pic }}" class="jqzoom" /></a>
							</div>
							
							@if(empty(session('home_user')))

								<div style="margin-left: 10px;">
									<i class="sprite-follow-sku" style="width: 14px;height: 13px;background-image: url(/h/images/__sprite.png);background-position: -44px -40px;display: inline-block;" ></i>
									<a href="" id="shoucang"    ><em>收藏</em></a>
								</div>


								<script>
								
									$('#shoucang').click(function(){

										if (confirm("尚未登录,无法收藏，是否前往登录")) {
											console.log('11');
											window.location.href = '/home/login';
											
											return false;
										} else {
											self.location=document.referrer;
										}	

									})
										

								</script>
							@elseif( $collect == null)

								<div style="margin-left: 10px;">
									<i class="sprite-follow-sku" style="width: 14px;height: 13px;background-image: url(/h/images/__sprite.png);background-position: -44px -40px;display: inline-block;" ></i>
									<a href="/home/collection/{{$good->id}}/{{$sid}}"><em>收藏</em></a>
								</div>

							@elseif($collect->status == '1')
							
								<div style="margin-left: 10px;">
									<i class="sprite-follow-sku" style="width: 14px;height: 13px;background-image: url(/h/images/__sprite.png);background-position: -44px -40px;display: inline-block;" ></i>
									<a href=""><em>已收藏</em></a>
								</div>
							@endif 
							<!-- <ul class="tb-thumb" id="thumblist">
								<li class="tb-selected">
									<div class="tb-pic tb-s40">
										<a href="#"><img src="/h/images/01_small.jpg" mid="/h/images/01_mid.jpg" big="/h/images/01.jpg"></a>
									</div>
								</li>
								<li>
									<div class="tb-pic tb-s40">
										<a href="#"><img src="/h/images/02_small.jpg" mid="/h/images/02_mid.jpg" big="/h/images/02.jpg"></a>
									</div>
								</li>
								<li>
									<div class="tb-pic tb-s40">
										<a href="#"><img src="/h/images/03_small.jpg" mid="/h/images/03_mid.jpg" big="/h/images/03.jpg"></a>
									</div>
								</li>
							</ul> -->
						</div>

						<div class="clear"></div>
					</div>

					<div class="clearfixRight">

						<!--规格属性-->
						<!--名称-->
						<div class="tb-detail-hd">
							<h1>	
				 {{ $good->name }}
	          </h1>
						</div>
						<div class="tb-detail-list">
							<!--价格-->
							<div class="tb-detail-price">
								<li class="price iteminfo_price">
									<dt>促销价</dt>
									<dd><em>¥</em><b class="sys_item_price" id="price">{{ $good->price }}</b>  </dd>                                 
								</li>
								<!-- <li class="price iteminfo_mktprice">
									<dt>原价</dt>
									<dd><em>¥</em><b class="sys_item_mktprice">98.00</b></dd>									
								</li> -->
								<div class="clear"></div>
							</div>

							<!--地址-->
							<!-- <dl class="iteminfo_parameter freight">
								<dt>配送至</dt>
								<div class="iteminfo_freprice">
									<div class="am-form-content address">
										<select data-am-selected>
											<option value="a">浙江省</option>
											<option value="b">湖北省</option>
										</select>
										<select data-am-selected>
											<option value="a">温州市</option>
											<option value="b">武汉市</option>
										</select>
										<select data-am-selected>
											<option value="a">瑞安区</option>
											<option value="b">洪山区</option>
										</select>
									</div>
									<div class="pay-logis">
										快递<b class="sys_item_freprice">10</b>元
									</div>
								</div>
							</dl> -->
							<div class="clear"></div>

							<!--销量-->
							<ul class="tm-ind-panel">
							
								<!-- <li class="tm-ind-item tm-ind-sellCount canClick">
									<div class="tm-indcon"><span class="tm-label">月销量</span><span class="tm-count">1015</span></div>
								</li> -->

								<li class="tm-ind-item tm-ind-sumCount canClick">
									<div class="tm-indcon"><span class="tm-label">累计销量</span><span class="tm-count">{{$good->sales_nums}}</span></div>
								</li>
								<li class="tm-ind-item tm-ind-reviewCount canClick tm-line3">
									<div class="tm-indcon"><span class="tm-label">累计评价</span><span class="tm-count">{{count($reply)}}</span></div>
								</li>
							</ul>
							<div class="clear"></div>

							<!--各种规格-->
							<dl class="iteminfo_parameter sys_item_specpara">
								<dt class="theme-login"><div class="cart-title">可选规格<span class="am-icon-angle-right"></span></div></dt>
								<dd>
									<!--操作页面-->

									<div class="theme-popover-mask"></div>

									<div class="theme-popover">
										<div class="theme-span"></div>
										<div class="theme-poptit">
											<a href="javascript:;" title="关闭" class="close">×</a>
										</div>
										<div class="theme-popbod dform">
											<form class="theme-signin" name="loginform" action="" method="post">

												<div class="theme-signin-left act">

													@foreach($sku as $v)
													<div class="theme-options">
														<div class="cart-title">{{ $v->name }}</div>
														<ul>
															@foreach($v->sub as $vv)
															<li class="sku-line acti">{{ $vv }}</li>
															@endforeach
														</ul>
													</div>
													@endforeach

													<div class="theme-options">
														<div class="cart-title number">数量</div>
														<dd>
															<input id="min" class="am-btn am-btn-default num1" name="" type="button" value="-" />
															<input id="text_box" name="" type="text" disabled value="1" style="width:30px;" />
															<input id="add" class="am-btn am-btn-default num1" name="" type="button" value="+" />
															<span id="Stock" class="tb-hidden">库存<span class="stock" id="cun">{{ $good->num }}</span>件</span>
														</dd>

													</div>
													<div class="clear"></div>

													<div class="btn-op">
														<div class="btn am-btn am-btn-warning">确认</div>
														<div class="btn close am-btn am-btn-warning">取消</div>
													</div>
												</div>
												<!-- <div class="theme-signin-right">
													<div class="img-info">
														<img src="/h/images/songzi.jpg" />
													</div>
													<div class="text-info">
														<span class="J_Price price-now">¥39.00</span>
														<span id="Stock" class="tb-hidden">库存<span class="stock">1000</span>件</span>
													</div>
												</div> -->

											</form>
										</div>
									</div>

								</dd>
							</dl>
							<!-- <div class="clear"></div> -->
							<!--活动	-->
							<!-- <div class="shopPromotion gold">
								<div class="hot">
									<dt class="tb-metatit">店铺优惠</dt>
									<div class="gold-list">
										<p>购物满2件打8折，满3件7折<span>点击领券<i class="am-icon-sort-down"></i></span></p>
									</div>
								</div>
								<div class="clear"></div>
								<div class="coupon">
									<dt class="tb-metatit">优惠券</dt>
									<div class="gold-list">
										<ul>
											<li>125减5</li>
											<li>198减10</li>
											<li>298减20</li>
										</ul>
									</div>
								</div>
							</div> -->
						</div>

						<div class="pay">
							<div class="pay-opt">
							<a href="home.html"><span class="am-icon-home am-icon-fw">首页</span></a>
							<a><span class="am-icon-heart am-icon-fw">收藏</span></a>
							
							</div>
							<li>
								<div class="clearfix tb-btn tb-btn-buy theme-login">
									<a id="LikBuy" title="点此按钮到下一步确认购买信息" href="#">立即购买</a>
								</div>
							</li>
							<li>
								<div class="clearfix tb-btn tb-btn-basket theme-login">
									<a onclick="login({{ $sid }})" sid="{{ $sid }}" id="LikBasket" title="加入购物车" href="#"><i></i>加入购物车</a>
								</div>
							</li>
						</div>

					</div>

					<div class="clear"></div>

				</div>

				<!--优惠套装-->
				
				<div class="clear"></div>
				
							
				<!-- introduce-->

				<div class="introduce">
					<div class="browse">
					    <div class="mc"> 
						     <ul>					    
						     	<div class="mt">            
						            <h2>看了又看</h2>        
					            </div>
						     	
							      <li class="first">
							      	<div class="p-img">                    
							      		<a  href="#"> <img class="" src="/h/images/browse1.jpg"> </a>               
							      	</div>
							      	<div class="p-name"><a href="#">
							      		【三只松鼠_开口松子】零食坚果特产炒货东北红松子原味
							      	</a>
							      	</div>
							      	<div class="p-price"><strong>￥35.90</strong></div>
							      </li>
							      			      
					      
						     </ul>					
					    </div>
					</div>
					<div class="introduceMain">
						<div class="am-tabs" data-am-tabs>
							<ul class="am-avg-sm-3 am-tabs-nav am-nav am-nav-tabs">
								<li class="am-active">
									<a href="#">

										<span class="index-needs-dt-txt">宝贝详情</span></a>

								</li>

								<li>
									<a href="#">

										<span class="index-needs-dt-txt">全部评价</span></a>

								</li>

								<li>
									<a href="#">

										<span class="index-needs-dt-txt">猜你喜欢</span></a>
								</li>
							</ul>

							<div class="am-tabs-bd">

								<div class="am-tab-panel am-fade am-in am-active" id="desc">
									{!! $good->desc !!}
									

								</div>

								<div class="am-tab-panel am-fade">
									
                                    <div class="actor-new">
                                    	<div class="rate">                
                                    		<strong>100<span>%</span></strong><br> <span>好评度</span>            
                                    	</div>
                                        <dl>                    
                                            <dt>买家印象</dt>                    
                                            <dd class="p-bfc">
                                            			<q class="comm-tags"><span>味道不错</span><em>(2177)</em></q>
                                            			<q class="comm-tags"><span>颗粒饱满</span><em>(1860)</em></q>
                                            			<q class="comm-tags"><span>口感好</span><em>(1823)</em></q>
                                            			<q class="comm-tags"><span>商品不错</span><em>(1689)</em></q>
                                            			<q class="comm-tags"><span>香脆可口</span><em>(1488)</em></q>
                                            			<q class="comm-tags"><span>个个开口</span><em>(1392)</em></q>
                                            			<q class="comm-tags"><span>价格便宜</span><em>(1119)</em></q>
                                            			<q class="comm-tags"><span>特价买的</span><em>(865)</em></q>
                                            			<q class="comm-tags"><span>皮很薄</span><em>(831)</em></q> 
                                            </dd>                                           
                                         </dl> 
                                    </div>	
                                    <div class="clear"></div>
									<div class="tb-r-filter-bar">
										<ul class=" tb-taglist am-avg-sm-4">
											<li class="tb-taglist-li tb-taglist-li-current">
												<div class="comment-info">
													<span>全部评价</span>
													<span class="tb-tbcr-num">(32)</span>
												</div>
											</li>

											<li class="tb-taglist-li tb-taglist-li-1">
												<div class="comment-info">
													<span>好评</span>
													<span class="tb-tbcr-num">(32)</span>
												</div>
											</li>

											<li class="tb-taglist-li tb-taglist-li-0">
												<div class="comment-info">
													<span>中评</span>
													<span class="tb-tbcr-num">(32)</span>
												</div>
											</li>

											<li class="tb-taglist-li tb-taglist-li--1">
												<div class="comment-info">
													<span>差评</span>
													<span class="tb-tbcr-num">(32)</span>
												</div>
											</li>
										</ul>
									</div>
									<div class="clear"></div>

									<ul class="am-comments-list am-comments-list-flip">
										
									
									@foreach($reply as $v)
										<li class="am-comment">
												<!-- 评论容器 -->
												<a href="">
													<img class="am-comment-avatar" src="/uploads/{{$v->avatar}}" />
													<!-- 评论者头像 -->
												</a>

												<div class="am-comment-main">
													<!-- 评论内容容器 -->
													<header class="am-comment-hd">
														<!--<h3 class="am-comment-title">评论标题</h3>-->
														<div class="am-comment-meta">
															<!-- 评论元数据 -->
															<a href="#link-to-user" class="am-comment-author">{{$v->nickname}}(匿名)</a>
															<!-- 评论者 -->
															评论于
															<time datetime="">{{$v->created_at}}</time>
														</div>
													</header>
						<input id="input-21b" value="{{$v->num}}" type="text" class="rating" required  disabled>
													<div class="am-comment-bd">
														<div class="tb-rev-item " data-id="255776406962">
															<div class="J_TbcRate_ReviewContent tb-tbcr-content ">
																{{$v->content}}
																
															</div>
															<div class="" style="width:100px">
																{!!$v->desc!!}
															</div>
															<div class="tb-r-act-bar">
																颜色分类：{{$v->sku}}
															</div>
														</div>

													</div>
													<!-- 评论内容 -->
												</div>
										</li>

										@endforeach

									</ul>

									<div class="clear"></div>

									<!--分页 -->
									<!-- <ul class="am-pagination am-pagination-right">
										<li class="am-disabled"><a href="#">&laquo;</a></li>
										<li class="am-active"><a href="#">1</a></li>
										<li><a href="#">2</a></li>
										<li><a href="#">3</a></li>
										<li><a href="#">4</a></li>
										<li><a href="#">5</a></li>
										<li><a href="#">&raquo;</a></li>
									</ul> -->
									<div class="clear"></div>

									<div class="tb-reviewsft">
										<div class="tb-rate-alert type-attention">购买前请查看该商品的 <a href="#" target="_blank">购物保障</a>，明确您的售后保障权益。</div>
									</div>

								</div>

								<div class="am-tab-panel am-fade">
									<div class="like">
										<ul class="am-avg-sm-2 am-avg-md-3 am-avg-lg-4 boxes">
											<li>
												<div class="i-pic limit">
													<img src="/h/images/imgsearch1.jpg" />
													<p>【良品铺子_开口松子】零食坚果特产炒货
														<span>东北红松子奶油味</span></p>
													<p class="price fl">
														<b>¥</b>
														<strong>298.00</strong>
													</p>
												</div>
											</li>
											<li>
												<div class="i-pic limit">
													<img src="/h/images/imgsearch1.jpg" />
													<p>【良品铺子_开口松子】零食坚果特产炒货
														<span>东北红松子奶油味</span></p>
													<p class="price fl">
														<b>¥</b>
														<strong>298.00</strong>
													</p>
												</div>
											</li>
											<li>
												<div class="i-pic limit">
													<img src="/h/images/imgsearch1.jpg" />
													<p>【良品铺子_开口松子】零食坚果特产炒货
														<span>东北红松子奶油味</span></p>
													<p class="price fl">
														<b>¥</b>
														<strong>298.00</strong>
													</p>
												</div>
											</li>
											<li>
												<div class="i-pic limit">
													<img src="/h/images/imgsearch1.jpg" />
													<p>【良品铺子_开口松子】零食坚果特产炒货
														<span>东北红松子奶油味</span></p>
													<p class="price fl">
														<b>¥</b>
														<strong>298.00</strong>
													</p>
												</div>
											</li>
											<li>
												<div class="i-pic limit">
													<img src="/h/images/imgsearch1.jpg" />
													<p>【良品铺子_开口松子】零食坚果特产炒货
														<span>东北红松子奶油味</span></p>
													<p class="price fl">
														<b>¥</b>
														<strong>298.00</strong>
													</p>
												</div>
											</li>
											<li>
												<div class="i-pic limit">
													<img src="/h/images/imgsearch1.jpg" />
													<p>【良品铺子_开口松子】零食坚果特产炒货
														<span>东北红松子奶油味</span></p>
													<p class="price fl">
														<b>¥</b>
														<strong>298.00</strong>
													</p>
												</div>
											</li>
											<li>
												<div class="i-pic limit">
													<img src="/h/images/imgsearch1.jpg" />
													<p>【良品铺子_开口松子】零食坚果特产炒货
														<span>东北红松子奶油味</span></p>
													<p class="price fl">
														<b>¥</b>
														<strong>298.00</strong>
													</p>
												</div>
											</li>
											<li>
												<div class="i-pic limit">
													<img src="/h/images/imgsearch1.jpg" />
													<p>【良品铺子_开口松子】零食坚果特产炒货
														<span>东北红松子奶油味</span></p>
													<p class="price fl">
														<b>¥</b>
														<strong>298.00</strong>
													</p>
												</div>
											</li>
											<li>
												<div class="i-pic limit">
													<img src="/h/images/imgsearch1.jpg" />
													<p>【良品铺子_开口松子】零食坚果特产炒货
														<span>东北红松子奶油味</span></p>
													<p class="price fl">
														<b>¥</b>
														<strong>298.00</strong>
													</p>
												</div>
											</li>
											<li>
												<div class="i-pic limit">
													<img src="/h/images/imgsearch1.jpg" />
													<p>【良品铺子_开口松子】零食坚果特产炒货
														<span>东北红松子奶油味</span></p>
													<p class="price fl">
														<b>¥</b>
														<strong>298.00</strong>
													</p>
												</div>
											</li>
											<li>
												<div class="i-pic limit">
													<img src="/h/images/imgsearch1.jpg" />
													<p>【良品铺子_开口松子】零食坚果特产炒货
														<span>东北红松子奶油味</span></p>
													<p class="price fl">
														<b>¥</b>
														<strong>298.00</strong>
													</p>
												</div>
											</li>
											<li>
												<div class="i-pic limit">
													<img src="/h/images/imgsearch1.jpg" />
													<p>【良品铺子_开口松子】零食坚果特产炒货
														<span>东北红松子奶油味</span></p>
													<p class="price fl">
														<b>¥</b>
														<strong>298.00</strong>
													</p>
												</div>
											</li>
										</ul>
									</div>
									<div class="clear"></div>

									<!--分页 -->
									<ul class="am-pagination am-pagination-right">
										<li class="am-disabled"><a href="#">&laquo;</a></li>
										<li class="am-active"><a href="#">1</a></li>
										<li><a href="#">2</a></li>
										<li><a href="#">3</a></li>
										<li><a href="#">4</a></li>
										<li><a href="#">5</a></li>
										<li><a href="#">&raquo;</a></li>
									</ul>
									<div class="clear"></div>

								</div>

							</div>


			



@endsection

@section('js')
<script type="text/javascript">
	var sku = '{{$good->sku}}';
	// console.log(sku);

	var val_arr = sku.split('/');
	// console.log(val_arr);
	// console.log($('.acti'));

	val_arr.forEach(function(val,index){
		if(val){
			$('.acti').each(function(){
				// console.log(val);
				// console.log($(this).html());
				if($(this).html() == val){
					//console.log(val);
					$(this).addClass('selected');
				}
			})
		}
	})

	$('.act').on("click",function(){
		// if($(this).attr('class') == 'sku-line acti selected'){
		// 	$(this).removeClass('selected');
		// }else{
		// 	$(this).siblings().removeClass('selected');
		// 	$(this).siblings().addClass('selected');
		// }
		var sku = '';

		$('.selected').each(function(){
			// console.log($(this).html());
			sku += '/' + $(this).html();
		});
		// console.log(sku);
		send({{$good->good_id}},sku);
		// console.log({{$good->good_id}});
	})

	function send(id,sku){
		// console.log(id);
		// console.log(sku);
		$.ajax({
			url:"/home/details/faajax",
    		data:{'id':id,'sku':sku},
    		type:'POST',
    		dataType:'json',
    		success:function(mes){
    			console.log(mes);
    			// console.log($('#cun').html());
    			// console.log(mes.length > 0);
    			if(mes.length > 0){
    				$(mes).each(function(){
	    				$('#src').attr('src',$(this).attr('pic'));
	    				$('#src').attr('rel',$(this).attr('pic'));
	    				// $('#src').attr('big',$(this).attr('pic'));
		    			$('#price').html($(this).attr('price'));
		    			$('#cun').html($(this).attr('num'));
		    			$('#desc').html($(this).attr('desc'));
		    			$('#LikBasket').attr('sid',$(this).attr('sid'));
		    			// var href = "/home/shopcar/insert/" + $(this).attr('sid');
		    			// // console.log(href);
		    			// $('#LikBasket').attr('href',href);
	    			})
    			}else{
    				// console.log(123);
    				$('#src').attr('src','/uploads/20190806/当前.jpg');
    				$('#src').attr('rel','/uploads/20190806/当前.jpg');
    				// $('#src').attr('big','/uploads/20190806/当前.jpg');
    				$('#price').html('');
    				$('#cun').html(0);
    				$('#desc').html('暂无详情');
    			}
    			// $('#src').removeAttr('src');
    			
    		}
		})
	}

	// console.log($('.num1').length);
	
	$('.num1').on('click',function(){
		console.log($('#text_box').val());
		console.log(parseInt($('#cun').html()));
		if(parseInt($('#text_box').val()) >= parseInt($('#cun').html())){
			$('#text_box').val(parseInt($('#cun').html()) - 1);
		}

		if(parseInt($('#text_box').val()) <= 0){
			$('#text_box').val(1);
		}
		// var href2 = "/home/shopcar/insert/" + $('#LikBasket').attr('sid') + '/' + (parseInt($('#text_box').val()) + 1);
		// console.log(href2);
		// $('#LikBasket').attr('href',href2);
	})

	setInterval(function(){
		if(parseInt($('#text_box').val()) >= parseInt($('#cun').html())){
			$('#text_box').val(parseInt($('#cun').html()));
		}

		if(parseInt($('#text_box').val()) <= 0){
			$('#text_box').val(0);
		}
	},100)

	// $('#LikBasket').click(function(){

	// 	if(parseInt($('#cun').html()) == 0){
	// 		alert(789);
	// 		return false;
	// 	}
	// })

	function login(id){
		// var sku = '';
		// $('.selected').each(function(){
		// 	// console.log($(this).html());
		// 	sku += '.' + $(this).html();
		// });
		// console.log(sku);

		// $('#num').html();
		if(parseInt($('#cun').html()) == 0){
			// alert(789);
			return false;
		}
		var href2 = '/home/shopcar/insert/' + $('#LikBasket').attr('sid') + '/' + parseInt($('#text_box').val());
		// console.log(href2);
		window.location.href = href2;
	}
</script>

<script>
        $(document).on('ready', function(){

			$('.clear-rating ').each(function(){

				$(this).css('display','none');

			})
			
			$('.caption').each(function(){

				$(this).css('display','none');

			})
            
        });

</script>

@endsection