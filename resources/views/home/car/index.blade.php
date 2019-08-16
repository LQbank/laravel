@extends('home.layout.index')
@section('content')
		<link rel="stylesheet" href="/home/vendor/fontawesome/css/font-awesome.css">
		<link rel="stylesheet" href="/home/vendor/owlcarousel/owl.carousel.css" media="screen">
		<link rel="stylesheet" href="/home/vendor/owlcarousel/owl.theme.css" media="screen">
		<link rel="stylesheet" href="/home/vendor/magnific-popup/magnific-popup.css" media="screen">
		<link href="/home/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
		<!-- <link href="/home/css/style.css" rel="stylesheet" type="text/css" media="all" />  -->

		<!-- Theme CSS -->
		<link rel="stylesheet" href="/home/css/theme.css">
		<link rel="stylesheet" href="/home/css/theme-elements.css">
		<link rel="stylesheet" href="/home/css/theme-blog.css">
		<link rel="stylesheet" href="/home/css/theme-shop.css">
		<link rel="stylesheet" href="/home/css/theme-animate.css">

		<!-- Skin CSS -->
		<link rel="stylesheet" href="/home/css/skins/default.css">

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="/home/css/custom.css">

		<style>
			.zong{
				font-size:25px;

			}

			.aaa > td{
				width:80px;
				height:50px;
			}

			.bbb > th{
				width:80px;
				height:50px;
			}
			/*.aaa{
				width:800px;
			}
			.bbb{
				width:800px;
			}*/
			#tab{
				width:850px;
			}
		</style>







		<link href="/h/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css" />
		<link href="/h/basic/css/demo.css" rel="stylesheet" type="text/css" />
		<link href="/h/css/cartstyle.css" rel="stylesheet" type="text/css" />
		<link href="/h/css/optstyle.css" rel="stylesheet" type="text/css" />

		<script type="text/javascript" src="/h/js/jquery.js"></script>
			<!--购物车 -->
			<div class="concent">
				@if(empty($car))
					<img src="/uploads/20190806/gwc_k2.jpg">
					<a href="/" style="background:red;color:white;padding:5px;border-radius:10%;position:relative;top:-150px;left:545px;z-index:1000">去逛逛</a>
				@else
				<div id="cartTable">
					<div class="col-md-12">
							<div class="featured-box featured-box-secundary featured-box-cart">
								<div class="box-content">
									<form method="post" action="/home/shopcar/jiesuan">
										{{ csrf_field() }}
										<table cellspacing="0" class="shop_table cart" style="" id="tab">
											<thead>
												<tr class="bbb">
													<th></th>
													<th class="product-remove" style="width:10px;">
														&nbsp;
													</th>

													<th class="product-price">
														Pic
													</th>
													
													<th class="product-price">
														Name
													</th>
													<th class="product-name">
														Sku
													</th>
													
													<th class="product-price">
														Price
													</th>
													<th class="product-quantity">
														Num
													</th>
													<th class="product-quantity">
														number
													</th>
													<th class="product-subtotal">
														Total
													</th>
												</tr>
											</thead>
											<tbody>
											@foreach($car as $car)
											<input class="duihao" type="hidden" name="id[]" value="{{ $car->id }}">
												<tr class="cart_table_item aaa">
													<td style="width:10px;">
														<input class="inp" type="checkbox" name="xuan[]" value="{{ $car->id }}">
													</td>
													<td class="product-remove" style="width:10px;">
														<a onclick="shanchu(this,{{ $car->id }})" title="Remove this item" class="remove">
															<i class="fa fa-times" style="position:relative;left:-50px;"></i>
														</a>
													</td>

													<td>
														<img src="{{ $car->pic }}" style="width:50px;">
													</td>

													<td>
														{{ $car->goodname }}
													</td>
													
													<td class="product-name">
														<a href="shop-product-sidebar.html">{{ $car->sku }}</a>
													</td>
													
													
													<td class="product-price">{{ $car->price }}</td>
													<td class="product-quantity">
														
															<div class="quantity">
																<input type="button" class="minus" value="-">
																<input type="text" style="width:50px;" disabled class="input-text qty text" name="num[{{ $car->id }}]" title="Qty" value="{{ $car->number }}" >
																<input type="button" class="plus" value="+">
															</div>
														
													</td>
													<td>{{ $car->num }}</td>
													<td class="product-subtotal">
														<span class="amount"></span>
													</td>
												</tr>
											@endforeach
												<tr align="center">
													<td class="actions" colspan="6">
														<div class="actions-continue">
															<input id="tijiao2" type="submit" value="Submit Cart" class="btn btn-default">
														</div>
													</td>
												</tr>
												<div class="zong">总价：100<br /><hr /></div>
											</tbody>
										</table>
									</form>
								</div>
							</div>
						</div>

					
				</div>
				
				@endif
				

			</div>


	@endsection

	@section('js')
		<script>

		$('.minus').click(function(){
			console.log($(this).next().val());
			if(parseInt($(this).next().val()) <= 0){
				$(this).next().val(0);
			}else{
				var yi = parseInt($(this).next().val()) - 1;

				$(this).next().val(yi);
			}
			num();
			num2();
		})

		$('.plus').click(function(){
			console.log($(this).parents('td').prev().prev().prev().prev().prev().find('input').attr('checked'));
			// console.log($(this).parents('td').next().html());
			var er = parseInt($(this).parents('td').next().html());

			if(parseInt($(this).prev().val()) >= er){
				$(this).prev().val(er);
			}else{
				var san = parseInt($(this).prev().val()) + 1;

				$(this).prev().val(san);
			}
			num();
			num2();
		})

		function num(){
			$('.amount').each(function(){
				var tex = $(this).parent().prev().prev().find('div').find('input').eq(1).val();

				var tex2 = $(this).parent().prev().prev().prev().html();
				var tex3 = parseInt(tex) *parseInt(tex2);

				$(this).html(tex3);
			});
		}
		num();


		
		function num2(){
			var zong = 0;
			$('.amount').each(function(){
				var check = $(this).parent().prev().prev().prev().prev().prev().prev().prev().prev().find('input').attr('checked');
				
				if(check == 'checked'){
					zong+=parseInt($(this).text());
				}
			})
			$('.zong').html('总价：'+zong);
			
			// console.log(zong)
		}
		num2();

		// setInterval(function(){
		// 	num2();
		// },10)
		
		$('.inp').click(function(){
			num2();
		})

		
		function shanchu(id,aa){
			// console.log($(id));
			// console.log(aa);
			var iid = $(id).parent().prev().children().val();
			$.ajax({
	    		url:'/home/car/shanajax',
	    		data:{id:iid},
	    		type:'post',
	    		success:function(mes){
	    			console.log(mes);
	    			// console.log($(id));
	    			$(id).parent().parent().remove();
	    		},
	    		async:false
	    	})

	    	$(id).parent().prev().children().removeAttr('checked');
	    	num2();

		}

		$('#tijiao2').click(function(){
			// console.log($('.zong').html());

			var str = $('.zong').html();
			var str2 = str.split('总价：');
			// console.log();
			if(parseInt(str2[1]) == 0){
				return false;
			}
			// console.log(str2[1]);
			
		})

		// var tijiao3 = 0;
		// $('#tijiao2').click(function(){
		// 	tijiao3 = 0;
		// 	if($('.inp').length > 0){
		// 		$('.inp').each(function(){
		// 			// console.log($(this).attr('aa'));
		// 			if($(this).attr('aa') == 'aa'){
		// 				// console.log(123);
		// 				tijiao3 = 1;
		// 			}
		// 		})
		// 	}

		// 	console.log(tijiao3);
		// 	if(tijiao3 == 0){
		// 		return false;
		// 	}
		// 	// return false;
		// })
		// $('.inp').each(function(){
		// 	$(this).attr('aa','');
		// })

		// $('.inp').on('click',function(){
		// 	if($(this).attr('aa') == ''){
		// 		$(this).attr('aa','aa');
		// 	}else{
		// 		$(this).attr('aa','');
		// 	}
			
		// })
		
		
	</script>
	@endsection