@extends('home.layout.index')
@section('content')

<style>
    .detail-hd {
        width: 100%;
        text-align: center;
    }
    .m-success-tip {
    padding: 30px 0 22px;
    text-align: center;
    }
    .m-success-tip .tip-inner {
    display: inline-block;
    *display: inline;
    *zoom: 1;
    padding-left: 95px;
    text-align: left;
    }
    .m-success-tip .tip-icon {
    float: left;
    width: 70px;
    height: 70px;
    margin-right: 25px;
    margin-left: -95px;
    _display: inline;
    }

    .m-success-tip .tip-icon {
        display: inline-block;
        background-image: url(//misc.360buyimg.com/user/myjd/comment/1.0.0/css/i/sprite-tip.png);
        background-repeat: no-repeat;
    }
    .m-success-tip .tip-title {
    margin-top: 9px;
    font: 20px/32px "Microsoft YaHei";
    color: #333;
    }

    .m-success-tip .tip-hint {
    font: 14px/26px "Microsoft YaHei";
    color: #999;
    }
</style>
        <div class="detail-hd">
				<div class="m-success-tip">
					<div class="tip-inner">
						<i class="tip-icon"></i>
						<h3 class="tip-title">评价已完成，以下商品未评，快去看看吧~</h3>
						<div class="tip-hint">京豆将于一天左右返到你的账户中<a  href="/home/comment" class="ftc3 ml10">返回待评价列表 &gt;</a></div>
					</div>
				</div>
			</div>

@endsection
@section('js') 



@endsection
