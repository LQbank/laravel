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
                    <th>产品名</th>
                    <th>公司名</th>
                    <th>商品描述</th>
                    <th>购买数量</th>
                </tr>
            </thead>
            <tbody>
                <!-- 遍历出每一个商品 -->
                @foreach($orderdetail as $orderdetail)
                <tr align="center">
                    <td>{{ $orderdetail->name }}</td>
                    <td>{{ $orderdetail->company }}</td>
                    <td>{{ $orderdetail->sku }}</td>
                    <td>{{ $orderdetail->detailnum }}</td>
                    
                </tr>
              	@endforeach
                
            </tbody>
        </table>
    </div>
</div>
@endsection