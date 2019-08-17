@extends('home.layout.index')
@section('content')
  
		
		
			
			<div class="banner">
                   
						<div class="am-slider am-slider-default scoll" data-am-flexslider id="demo-slider-0">
						
							<ul class="am-slides">
								@foreach($cartoon as $k=>$v)
									<li class="banner1" ><a href="/home/list"><img src="/uploads/{{ $v->pic }}"  style="width: 1488px;float: left;display: block;height: 430px;"/></a></li>
								@endforeach
								
							</ul>
						
						</div>
						<div class="clear"></div>	
			</div>
			

			<div class="shopNav">
				<div class="slideall">
					
					   
					   <div class="nav-cont">
							<ul>
								<li class="index"><a href="/">首页</a></li>
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
		        				
						<!--侧边导航 -->
						<div id="nav" class="navfull">
							<div class="area clearfix">
								<div class="long-title" style="margin-top: -45px;"><span class="all-goods">全部分类</span></div>
								<div class="category-content" id="guide_2">
									
									<div class="category">
										<ul class="category-list" id="js_climit_li">

											@foreach($common_cates_data as $k=>$v )
											<li class="appliance js_toggle relative first">
												<div class="category-info">
													<h3 class="category-name b-category-name"><i><img src="h/images/cake.png"></i><a href="/home/list" class="ml-22" title="点心">{{$v->cname}}</a></h3>
													<em>&gt;</em></div>
												<div class="menu-item menu-in top">
													<div class="area-in">
														<div class="area-bg">
															<div class="menu-srot">
																<div class="sort-side">

																	@foreach($v->sub as $kk=>$vv )
																	<dl class="dl-sort">

																		<dt><span title="蛋糕">{{$vv->cname}}</span></dt>


																		@foreach($vv->sub as $k3=>$v3 )

																		<dd><a title="蒸蛋糕" href="/home/list/{{$v3->id}}"><span>{{$v3->cname}}</span></a></dd>

																		@endforeach


																	</dl>
																	@endforeach


																</div>
																
																<!-- <div class="brand-side">
																	<dl class="dl-sort"><dt><span>实力商家</span></dt>
																		<dd><a rel="nofollow" title="呵官方旗舰店" target="_blank" href="#" rel="nofollow"><span  class="red" >呵官方旗舰店</span></a></dd>
																		<dd><a rel="nofollow" title="格瑞旗舰店" target="_blank" href="#" rel="nofollow"><span >格瑞旗舰店</span></a></dd>
																		<dd><a rel="nofollow" title="飞彦大厂直供" target="_blank" href="#" rel="nofollow"><span  class="red" >飞彦大厂直供</span></a></dd>
																		<dd><a rel="nofollow" title="红e·艾菲妮" target="_blank" href="#" rel="nofollow"><span >红e·艾菲妮</span></a></dd>
																		<dd><a rel="nofollow" title="本真旗舰店" target="_blank" href="#" rel="nofollow"><span  class="red" >本真旗舰店</span></a></dd>
																		<dd><a rel="nofollow" title="杭派女装批发网" target="_blank" href="#" rel="nofollow"><span  class="red" >杭派女装批发网</span></a></dd>
																	</dl>
																</div> -->
															</div>
														</div>
													</div>
												</div>
											<b class="arrow"></b>	
											</li>
											@endforeach
										</ul>
									</div>
								</div>

							</div>
						</div>
						
						
						<!--轮播-->
						
						<script type="text/javascript">
							(function() {
								$('.am-slider').flexslider();
							});
							$(document).ready(function() {
								$("li").hover(function() {
									$(".category-content .category-list li.first .menu-in").css("display", "none");
									$(".category-content .category-list li.first").removeClass("hover");
									$(this).addClass("hover");
									$(this).children("div.menu-in").css("display", "block")
								}, function() {
									$(this).removeClass("hover")
									$(this).children("div.menu-in").css("display", "none")
								});
							})
						</script>



					<!--小导航 -->
					<div class="am-g am-g-fixed smallnav">
						<div class="am-u-sm-3">
							<a href="sort.html"><img src="h/images/navsmall.jpg" />
								<div class="title">商品分类</div>
							</a>
						</div>
						<div class="am-u-sm-3">
							<a href="#"><img src="h/images/huismall.jpg" />
								<div class="title">大聚惠</div>
							</a>
						</div>
						<div class="am-u-sm-3">
							<a href="#"><img src="h/images/mansmall.jpg" />
								<div class="title">个人中心</div>
							</a>
						</div>
						<div class="am-u-sm-3">
							<a href="#"><img src="h/images/moneysmall.jpg" />
								<div class="title">投资理财</div>
							</a>
						</div>
					</div>

					<!--走马灯 -->

					<div class="marqueen">
						<span class="marqueen-title">商城头条</span>
						<div class="demo">

							<ul>
								<li class="title-first"><a target="_blank" href="#">
									<img src="h/images/TJ2.jpg"></img>
									<span>[特惠]</span>商城爆品1分秒								
								</a></li>
								<li class="title-first"><a target="_blank" href="#">
									<span>[公告]</span>商城与广州市签署战略合作协议
								     <img src="h/images/TJ.jpg"></img>
								     <p>XXXXXXXXXXXXXXXXXX</p>
							    </a></li>
						@if(empty(Session::get('home_user')))	 
						
						<div class="mod-vip">
							<div class="m-baseinfo">
								<a href="person/index.html">
									<img src="h/images/getAvatar.do.jpg">
								</a>
								<em>
									Hi,<span class="s-name">小叮当</span>
									<a href="#"><p>点击更多优惠活动</p></a>									
								</em>
							</div>
							<div class="member-logout">
								<a class="am-btn-warning btn" href="/home/login">登录</a>
								<a class="am-btn-warning btn" href="/home/register">注册</a>
							</div>
							<div class="member-login">
								<a href="#"><strong>0</strong>待收货</a>
								<a href="#"><strong>0</strong>待发货</a>
								<a href="#"><strong>0</strong>待付款</a>
								<a href="#"><strong>0</strong>待评价</a>
							</div>
							<div class="clear"></div>	
						</div>	
						@else
						<div class="mod-vip">
							<div class="m-baseinfo">
								<a href="/home/data">
									<img src="/uploads/{{session('home_user')->avatar}}">
								</a>
								<em>
									Hi,<span class="s-name">{{Session::get('home_user')->name}}</span>
									<a href="#"><p>点击更多优惠活动</p></a>									
								</em>
							</div>
							<div class="member-logout">
								<a class="am-btn-warning btn" href="home/collection">我的收藏</a>
								<a href="/home/logout" class="am-btn-warning btn" href="">退出</a>
							
								
							</div>
							
							
						</div>																    
						@endif	    
								<li><a target="_blank" href="#"><span>[特惠]</span>洋河年末大促，低至两件五折</a></li>
								<li><a target="_blank" href="#"><span>[公告]</span>华北、华中部分地区配送延迟</a></li>
								<li><a target="_blank" href="#"><span>[特惠]</span>家电狂欢千亿礼券 买1送1！</a></li>
								
							</ul>
                        <div class="advTip"><img src="h/images/advTip.jpg"/></div>
						</div>
					</div>
					<div class="clear"></div>
				</div>
				<script type="text/javascript">
					if ($(window).width() < 640) {
						function autoScroll(obj) {
							$(obj).find("ul").animate({
								marginTop: "-39px"
							}, 500, function() {
								$(this).css({
									marginTop: "0px"
								}).find("li:first").appendTo(this);
							})
						}
						$(function() {
							setInterval('autoScroll(".demo")', 3000);
						})
					}
				</script>
			</div>
			<div class="shopMainbg">
				<div class="shopMain" id="shopmain">

					<!--今日推荐 -->

					<div class="am-g am-g-fixed recommendation">
						<div class="clock am-u-sm-3" ">
							<img src="h/images/2016.png "></img>
							<p>今日<br>推荐</p>
						</div>
						<div class="am-u-sm-4 am-u-lg-3 ">
							<div class="info ">
								<h3>真的有鱼</h3>
								<h4>开年福利篇</h4>
							</div>
							<div class="recommendationMain one">
								<a href="introduction.html"><img src="h/images/tj.png "></img></a>
							</div>
						</div>						
						<div class="am-u-sm-4 am-u-lg-3 ">
							<div class="info ">
								<h3>囤货过冬</h3>
								<h4>让爱早回家</h4>
							</div>
							<div class="recommendationMain two">
								<img src="h/images/tj1.png "></img>
							</div>
						</div>
						<div class="am-u-sm-4 am-u-lg-3 ">
							<div class="info ">
								<h3>浪漫情人节</h3>
								<h4>甜甜蜜蜜</h4>
							</div>
							<div class="recommendationMain three">
								<img src="h/images/tj2.png "></img>
							</div>
						</div>

					</div>
					<div class="clear "></div>					
					<!--热门活动 -->

					<div class="am-container activity ">
						<div class="shopTitle ">
							<h4>活动</h4>
							<h3>每期活动 优惠享不停 </h3>
							<span class="more ">
                              <a href="# ">全部活动<i class="am-icon-angle-right" style="padding-left:10px ;" ></i></a>
                        </span>
						</div>
					  <div class="am-g am-g-fixed ">
						<div class="am-u-sm-3 ">
							<div class="icon-sale one "></div>	
								<h4>秒杀</h4>							
							<div class="activityMain ">
								<img src="h/images/activity1.jpg "></img>
							</div>
							<div class="info ">
								<h3>春节送礼优选</h3>
							</div>														
						</div>
						
						<div class="am-u-sm-3 ">
						  <div class="icon-sale two "></div>	
							<h4>特惠</h4>
							<div class="activityMain ">
								<img src="h/images/activity2.jpg "></img>
							</div>
							<div class="info ">
								<h3>春节送礼优选</h3>								
							</div>							
						</div>						
						
						<div class="am-u-sm-3 ">
							<div class="icon-sale three "></div>
							<h4>团购</h4>
							<div class="activityMain ">
								<img src="h/images/activity3.jpg "></img>
							</div>
							<div class="info ">
								<h3>春节送礼优选</h3>
							</div>							
						</div>						

						<div class="am-u-sm-3 last ">
							<div class="icon-sale "></div>
							<h4>超值</h4>
							<div class="activityMain ">
								<img src="h/images/activity.jpg "></img>
							</div>
							<div class="info ">
								<h3>春节送礼优选</h3>
							</div>													
						</div>

					  </div>
                   </div>
					<div class="clear "></div>

					

					@foreach($common_cates_data as $k=>$v )
						<div class="am-container ">
							<div class="shopTitle ">
								<h4>{{$v->cname}}</h4>

								<!-- <h3>你是我的优乐美么？不，我是你小鱼干</h3> -->
								<div class="today-brands ">
									<!-- <a href="# ">小鱼干</a> -->
									

								<h3>
									@foreach($v->sub as $k2=>$v2 )

										@foreach($v2->sub as $k3=>$v3 )
										<a class="outer" href="/home/list/{{$v3->id}}"><span class="inner"><b class="text">{{$v3->cname}}</b></span></a>
										@endforeach
									
									@endforeach
								</h3>
								<div class="today-brands ">
									<!-- <a href="# ">小鱼干</a> -->
									

								</div>
								<span class="more ">
						<a class="more-link " href="# ">更多美味</a>
							</span>
							</div>
						</div>
						<div class="am-g am-g-fixed flood method3 ">
							<ul class="am-thumbnails ">

							@foreach($v->sub as $k2=>$v2 )
								@foreach($v2->sub as $k3=>$v3 )
									@foreach($v3->sub as $k4=>$v4 )
								
											<li class="">
												<div class="list ">
													<a href="# ">

															<a href="/home/details/{{$v4->id}}"><img style="height:183.15px;" src="{{$v4->pic}}" /></a>


														<div class="pro-title cutString">{{$v4->name}}</div>
														<span class="e-price "> {{$v4->price}} ￥</span>
													</a>
												</div>
											</li>
											
									@endforeach
								@endforeach
									
							@endforeach

								



							</ul>

						</div>
					
					@endforeach


					
					

			</div>
	

		
@endsection



	


@section('js')
<script type="text/javascript">
		$('.scarce').each(function(){
			console.log($(this).html());
			if($(this).html().length > 10){
				$(this).html($(this).html().slice(0,10) + '...');
			}
		})
	</script>
<script>
	// * 根据长度截取先使用字符串，超长部分追加… 
 
//  * str 对象字符串 
 
//  * len 目标字节长度 
 
//  * 返回值： 处理结果字符串 




function cutString(str, len) { 
         
		 //length属性读出来的汉字长度为1 
	   
		 if(str.length*2 <= len) { 
	   
		   return str; 
	   
		 } 
	   
		 var strlen = 0; 
	   
		 var s = ""; 
	   
		 for(var i = 0;i < str.length; i++) { 
	   
		   s = s + str.charAt(i); 
	   
		   if (str.charCodeAt(i) > 128) { 
	   
			 strlen = strlen + 2; 
	   
			 if(strlen >= len){ 
	   
			   return s.substring(0,s.length-1) + "..."; 
	   
			 } 
	   
		   } else { 
	   
			 strlen = strlen + 1; 
	   
			 if(strlen >= len){ 
	   
			   return s.substring(0,s.length-2) + "..."; 
	   
			 } 
	   
		   } 
	   
		  } 
	   
		  return s; 
		
	  } 

	  $('.cutString').each(function(index){

		$(this).text(cutString($(this).text(), 20))


	})	
</script>

		
@endsection
	