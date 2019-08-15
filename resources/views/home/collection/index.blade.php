<link href="/h/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css">
		<link href="/h/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css">

		<link href="/h/css/personal.css" rel="stylesheet" type="text/css">
		<link href="/h/css/colstyle.css" rel="stylesheet" type="text/css">
@extends('home.layout.center')
@section('content')
					<div class="user-collection">
						<!--标题 -->
						<div class="am-cf am-padding">
							<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">我的收藏</strong> / <small>My&nbsp;Collection</small></div>
						</div>
						<hr/>

						<div class="you-like">
							<div class="s-bar">
								我的收藏
							</div>
							<div class="s-content">
							@foreach($collect as $v)
								<div class="s-item-wrap">
								
									<div class="s-item">

										<div class="s-pic">
											<a href="/home/details/{{$v->sku_id}}" class="s-pic-link">
											<img src="{{$v->pic}}" class="s-pic-img s-guess-item-img">
											</a>
										</div>
										<div class="s-info">
											<div class="s-title"><a href="/home/details/{{$v->sku_id}}" title="{{$v->name}} {{$v->sku}}">{{$v->name}} {{$v->sku}}</a></div>
											<div class="s-price-box">
												<span class="s-price"><em class="s-price-sign">¥</em><em class="s-value">{{$v->price}}</em></span>
											</div>
										</div>
									</div>
								
								</div>
							@endforeach
							</div>
							
							<div class="s-more-btn i-load-more-item" data-screen="0"><i class="am-icon-refresh am-icon-fw"></i>更多</div>

						</div>

					</div>
        @endsection