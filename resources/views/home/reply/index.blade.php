@extends('home.layout.index')
@section('content')
<link type="text/css" rel="stylesheet"  href="/h/reply/1.css"/>
<link type="text/css" rel="stylesheet"  href="/h/reply/2.css" source="widget"/>

<!-- 评星插件 -->


    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="/h/xingxing/css/star-rating.css" media="all" rel="stylesheet"  />
        
    <!--suppress JSUnresolvedLibraryURL -->
    <script src="https://cdn.bootcss.com/jquery/2.2.1/jquery.min.js"></script>
    <script src="/h/xingxing/js/star-rating.min.js" type="text/javascript"></script>

    <style>
        a{
            color: #000; 
            text-decoration: none;
          
        }
		li {
			font-size: 13px;
			display: list-item;
			text-align: -webkit-match-parent;
			list-style-position: inside;
			list-style-type: inherit;
			margin: 0;
			line-height: 20px;
			list-style-type:none;
		} 
		
		
	</style>
    <div id="error">
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

@foreach($order as $v)   
        <div id="container">
            <div class="w">
                <div class="mycomment-detail">
                    <div class="detail-hd" id="o-info-orderinfo" oid="99298059654" payid="4" ot="0" shipmentid="70" venderid="32+ro+cdrp0=" iscarshoporder="">
                        <div class="orderinfo">
                            <h3 class="o-title">评价订单</h3>
                            <div class="o-info">
                               
                                    <span class="mr20">订单号：<a href="#" class="gray1">{{$v->code}}</a></span>
                                   
                                <span>{{$v->created_at}}</span>
                              
                            </div>
                        </div>
                        
                    </div>
                    <div class="mycomment-form">
                        
        <!-- page -->
                <div class="form-part1">
              

                <div id="carVoucher" style="display:none" class="f-item f-service clearfix">
                    <div class="fi-info">
                    </div>
                    <div class="fi-operate ">
                        <div class="commstar-wrap">
                            <div class="commstar-group ">
                            </div>
                        </div>
                    </div>
                </div>
                

                
                <div class="f-cutline"></div>
            <div class="f-item f-goods product-100001817728" voucherstatus="0" catefi="1320" catese="1585" cateth="9434">
                @foreach($sku as $v2)
								
                    <div class="fi-info">
                   
                        <div class="comment-goods">
                            <div class="p-img"><a  href="/home/details/{{$v2->id}}" >
                            <img src="{{$v2->pic}}" alt="">
                            </a></div>
                            @foreach($v2->sub as $v3)
                            <div class="p-name"><a  href="" >{{$v3->name}}</a></div>
                            @endforeach
                            <div class="p-price"><strong>{{$v2->sku}}</strong></div>
                            <div class="p-price"><strong>¥{{$v2->price}}</strong></div>
                          
                        </div>
                    </div>
                  
            <form  action="/home/reply/add/{{$v2->good_id}}/{{$sku_id}}/{{$detail}}" method="post"   enctype="multipart/form-data">        
                @endforeach

            {{ csrf_field() }}
                    <div class="fi-operate">
                        <div class="fop-item fop-star   z-tip-warn">
                            <div class="fop-label">商品评分</div>
                            <div class="fop-main">
                               
                                
                                <input id="input-21b" value="0" name="num" type="text" class="rating" data-min=0 data-max=5 data-step=0.2 data-size="lg" required title="">

                            </div>
                            <div class="fop-tip"><i class="tip-icon"></i><em class="tip-text"></em></div>
                        <div class="fi-tip"><i class="tip-icon"></i><em class="tip-text">请至少填写一件商品的评价</em></div></div>
                        
                        <div class="fop-item ">
                            <div class="fop-label">评价晒单</div>
                            <div class="fop-main">
                                <div class="f-textarea">
                                    <textarea name="content" id="" value="{{old('content')}}" placeholder="分享体验心得，给万千想买的人一个参考~"></textarea>
                                    <div class="textarea-ext"><em class="textarea-num"><b>0</b> / 500</em><span class="tips">（评价多于<span class="ftc1">10</span>个字,有机会奖励京豆哦~）</span></div>
                                </div>
                                	
                            </div>
                            <div class="fop-tip"><i class="tip-icon"></i><em class="tip-text"></em></div>

                            
								 <!-- 百度编辑器 -->
                                <script id="editor" type="text/plain" style="width:550px;height:300px;"></script>
                                
                            
                        </div>
                        
                      
                    
	                    
                       

                       
                </div>
            </div>

                <div class="f-btnbox">
                            <button href=""  class="btn-submit">发表</button>
                            <span class="f-checkbox">
                                <input id="check1" class="i-check" type="checkbox">
                            <label for="check1">匿名评价</label>
                            </span>
                        </div>	
                </div>
            </form>
                            
        </div>
        </div>
        </div>
        @endforeach

@endsection
@section('js')  

    <script>
        $(document).on('ready', function(){
        $('#input-2').rating({
                step: 1,
                size: 'sm',//星星大小可选lg,sm,xl,xs
                starCaptions: {1: 'Very Poor', 2: 'Poor', 3: 'Ok', 4: 'Good', 5: 'Very Good'},
                starCaptionClasses: {1: 'text-danger', 2: 'text-warning', 3: 'text-info', 4: 'text-primary', 5: 'text-success'}
            });
            
        });


    </script>

<!-- 百度编辑器 -->

<script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.all.min.js"> </script>
<!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
<!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
<script type="text/javascript" charset="utf-8" src="/ueditor/lang/zh-cn/zh-cn.js"></script>
<script>
	//实例化编辑器
    //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
      var ue = UE.getEditor('editor', {
toolbars: [
        ['source', 'bold', 'italic', 'underline', 'strikethrough', 'blockquote', 'insertunorderedlist', 'insertorderedlist', 'justifyleft','justifycenter', 'justifyright',  'link', 'insertimage', 'fullscreen']
    ],
    elementPathEnabled: false,
    enableContextMenu: false,
    autoClearEmptyNode:true,
    wordCount:false,
    imagePopup:false,
    autotypeset:{ indent: true,imageBlockLine: 'center' }
});


</script>

@endsection
