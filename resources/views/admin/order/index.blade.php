@extends('admin.layout.index')

@section('content')
<div class="mws-panel grid_8">
    <div class="mws-panel-header">
        <span><i class="icon-table"></i> Data Table with Numbered Pagination</span>
    </div>
    <div class="mws-panel-body no-padding">
        <table class="mws-datatable-fn mws-table">
            <thead>
                <tr>
                    <th>编号</th>
                    <th>下单人</th>
                    <th>联系人</th>
                    <th>电话</th>
                    <th>总价</th>
                    <th>状态</th>
                    <th>操作</th>
                    
                </tr>
            </thead>
            <tbody>
                <!-- 遍历出每一个商品 -->
                @foreach($order1 as $order)
                <tr align="center">
                    <td>{{ $order->code }}</td>
                    <td>{{ $order->email }}</td>
                    <td>{{ $order->uname }}</td>
                    <td>{{ $order->phone }}</td>
                    <td>{{ $order->total }}</td>
                    <td  class="qy"  info="{{ $order->orderid }}">

                            <input class="ibutton" type="checkbox" data-label-on="已发货" data-label-off="未发货" @if($order->status) checked @else @endif  >		

                    </td>
                    <td><a href="/admin/order/showorder/{{ $order->orderid }}" class='btn btn-info'>查看订单</a></td>
                </tr>
              	@endforeach
                
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('js')
    <script>

        $('.qy').each(function(){

        this.onclick=function(evevt){

            var id = this.getAttribute('info');
            // console.log(id);

            if(evevt.target.nodeName !== 'TD'){


                $.ajax({
                    type: 'POST',
                    url: '/admin/order/changeStatus', 
                    data: { 'id': id },
                    dataType: 'json',
                    success: function(data){
                        
                    },
                    error: function(){
                    
                    }
                });

            }
        }


        })
    </script>
@endsection