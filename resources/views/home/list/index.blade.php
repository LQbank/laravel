@extends('home.layout.index')
@section('content')

    <link href="/h/css/seastyle.css" rel="stylesheet" type="text/css" />

	
    <script type="text/javascript" src="/h/basic/js/jquery-1.7.min.js"></script>
    <script type="text/javascript" src="/h/js/script.js"></script>
        

<div class="search">
			<div class="search-list">
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
			
				
					<div class="am-g am-g-fixed">
						<div class="am-u-sm-12 am-u-md-12">
	                  	<div class="theme-popover">														
							<div class="searchAbout">
								<span class="font-pale">相关搜索：</span>
								<a title="坚果" href="#">坚果</a>
								<a title="瓜子" href="#">瓜子</a>
								<a title="鸡腿" href="#">豆干</a>

							</div>
							<ul class="select">
								<p class="title font-normal">
									<span class="fl">松子</span>
									<span class="total fl">搜索到<strong class="num">997</strong>件相关商品</span>
								</p>
								<div class="clear"></div>
								<li class="select-result">
									<dl>
										<dt>已选</dt>
										<dd class="select-no"></dd>
										<p class="eliminateCriteria">清除</p>
									</dl>
								</li>
								<div class="clear"></div>

								@foreach($tags as $k=>$v)
								<li class="select-list">
									<dl id="select{{++$k}}">
										<dt class="am-badge am-round">{{$v->name}}</dt>	
									
										 <div class="dd-conent">										
											<dd class="select-all selected"><a href="#">全部</a></dd>

											@foreach($v->sub as $k2=>$v2)
											<dd class="key"><a href="#">{{$v2->val}}</a></dd>
											@endforeach

										 </div>
						
									</dl>
								</li>
								@endforeach

							</ul>
							<div class="clear"></div>
                        </div>
							<div class="search-content">
								<div class="sort">
									<li class="first"><a title="综合">综合排序</a></li>
									<li><a title="销量">销量排序</a></li>
									<li><a title="价格">价格优先</a></li>
									<!-- <li class="big"><a title="评价" href="#">评价为主</a></li> -->
								</div>
								<div class="clear"></div>

								
								<ul class="am-avg-sm-2 am-avg-md-3 am-avg-lg-4 boxes " id="good_items">
									
								
									@foreach($goods as $k=>$v)
									<li class="sku">
										<div class="i-pic limit">
											
											<a href="/home/details/{{$v->id}}"><img src="{{$v->pic}}" /></a>
											<p class="title fl">{{$v->name}} &nbsp;&nbsp; <b>{{$v->sku}}</b></p>
											<p class="price fl">
												<b>¥</b>
												<strong>{{$v->price}}</strong>
											</p>
											<p class="number fl">
												销量<span>{{$v->sales_nums}}</span>
											</p>
										</div>
									</li>
									@endforeach
								
								</ul>
								
							</div>
							<div class="search-side">

								<div class="side-title">
									经典搭配
								</div>

								<li>
									<div class="i-pic check">
										<img src="/h/images/cp.jpg" />
										<p class="check-title">萨拉米 1+1小鸡腿</p>
										<p class="price fl">
											<b>¥</b>
											<strong>29.90</strong>
										</p>
										<p class="number fl">
											销量<span>1110</span>
										</p>
									</div>
								</li>
								<li>
									<div class="i-pic check">
										<img src="/h/images/cp2.jpg" />
										<p class="check-title">ZEK 原味海苔</p>
										<p class="price fl">
											<b>¥</b>
											<strong>8.90</strong>
										</p>
										<p class="number fl">
											销量<span>1110</span>
										</p>
									</div>
								</li>
								<li>
									<div class="i-pic check">
										<img src="/h/images/cp.jpg" />
										<p class="check-title">萨拉米 1+1小鸡腿</p>
										<p class="price fl">
											<b>¥</b>
											<strong>29.90</strong>
										</p>
										<p class="number fl">
											销量<span>1110</span>
										</p>
									</div>
								</li>

							</div>
							<div class="clear"></div>
							<!--分页 -->
							<!-- <ul class="am-pagination am-pagination-right">
								<li class="am-disabled"><a href="#">&laquo;</a></li>
								<li class="am-active"><a href="#">1</a></li>
								<li><a href="#">2</a></li>
								<li><a href="#">&raquo;</a></li>
							</ul> -->

						</div>
					</div>
			

@endsection


@section('js')
		<script>
		
		
		cate_id	 = {{$cate_id}}


		
		$('.dd-conent').each(function(){
	
			$(this).click(function(){
				// console.log($(this));
			

				// console.log($('#selectA').text());
				// console.log($('#selectB').text());
				// console.log($('#selectC').text());

				
				// 获取当前选中的值
				var sku_str = getSku();
				
				// 如果为空则将原来的值写入
				if(sku_str==""){
					//将之前的删除
					$('.sku').remove();
					
					var zi = $('.first').text();

					switch(zi){
						case "价格优先":
							ajx({cate_id:cate_id,field:'sku.price'});
						break;
						case '销量排序':
							ajx({cate_id:cate_id,field:'good.sales_nums'});            
						break;
						case '综合排序':
							ajx({cate_id:cate_id,field:'good.id'});
						break;    	 	 
					} 
					

				}


				//如果不为空则发送ajax获取新的值
				if(sku_str){

					//将之前的删除
					$('.sku').remove();
					
					
					var zi = $('.first').text();

				
					switch(zi){
						case "价格优先":
							ajx({cate_id:cate_id,field:'sku.price',sku:sku_str});
						break;
						case '销量排序':
							ajx({cate_id:cate_id,field:'good.sales_nums',sku:sku_str});            
						break;
						case '综合排序':
							ajx({cate_id:cate_id,field:'good.id',sku:sku_str});
						break;    	 	 
					} 


				}

				return false;

			})

		})

		//获取当前选中的值
		function  getSku(){
			//获取当前选中的属性值
			sku_str='';

			if($('#selectA').text()){
				sku_str += '/'+$('#selectA').text();
			}

			if($('#selectB').text()){
				sku_str += '/'+$('#selectB').text();
					
			}

			if($('#selectC').text()){
				sku_str += '/'+$('#selectC').text();
						
			}
			return sku_str;

		}


		$('.sort').find('li').each(function(){
	
			$(this).click(function(){
				// console.log($(this));

				$(this).siblings().removeClass("first")
				
				$(this).addClass("first") 
				

				//将之前的删除
				$('.sku').remove();
				
				//获取当前选中的值
				var sku = getSku();

				var zi = $('.first').text();
				
				if(sku=="")
				{
					
						switch(zi)
						{
							case "价格优先":
								ajx({cate_id:cate_id,field:'sku.price'});
							break;
							case '销量排序':
								ajx({cate_id:cate_id,field:'sku.num'});            
							break;
							case '综合排序':
								ajx({cate_id:cate_id,field:'good.id'});
							break;    	 	 
						} 

				}else{

					switch(zi){
					case "价格优先":
						ajx({cate_id:cate_id,field:'sku.price',sku:sku});
					break;
					case '销量排序':
						ajx({cate_id:cate_id,field:'good.sales_nums',sku:sku});            
					break;
					case '综合排序':
						ajx({cate_id:cate_id,field:'good.id',sku:sku});
					break;    	 	 
				} 
				}

				
				
				

				

			})
		})



		function ajx(data){
			$.ajax({
				url:"/home/list/sort",
				data:data,
				type:"POST",
				dataType:"Json",
				success:function(mes){
					str='';

					if(mes.length == 0){
								

						// 没有查到相关商品
						str+=`	
							
							<div class="pro-text sku">
								<h4>没有查到相关商品</h4>
							</div>
							
							`
						// console.log(str);
					
							
					}else{
						$(mes).each(function(){
							str+=`
								<li class="sku">
									<div class="i-pic limit">
										
										<img src="${$(this).attr('pic')}" />
										<p class="title fl">${$(this).attr('name')} &nbsp;&nbsp; <b>${$(this).attr('sku')}</b></p>
										<p class="price fl">
											<b>¥</b>
											<strong>${$(this).attr('price')}</strong>
										</p>
										<p class="number fl">
											销量<span>${$(this).attr('sales_nums')}</span>
										</p>
									</div>
								</li>	
							`
							


						})
					}

						$('#good_items').append(str);
				}

			})

		}


		</script>
@endsection