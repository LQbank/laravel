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
                    <th>Sku pic</th>
                    <th>Cate</th>
                    <th>Name</th>
                    <th>Company</th>
                    <th>Time</th>
                    <th>SalesNum</th>
                    <th>Pinglun</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
               @foreach($goods as $good)
                <tr>
                    <td><a href="/admin/goods/indexsku/{{ $good->id }}/{{ $good->name }}"><img width="80px" src="{{ $good->pic }}" alt=""></a></td>
                    <td>{{$good->c_name}}</td>
                    <td>{{$good->name}}</td>
                    <td>{{$good->company}}</td>
                    <td>{{$good->time}}</td>
                    <td>0</td>
                    <td>0</td>
                    <td>
                        <div style="height:20px;" class="status" gid="{{$good->id}}">
                            <input  class="ibutton" type="checkbox" data-label-on="上架" data-label-off="下架" @if($good->status == 1) checked @endif>
                        </div>
                    </td>
                    <td><a href="/admin/goods/del/{{$good->id}}" class='btn btn-info'>del</a></td>
                </tr>
                @endforeach
                
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('js')
    <script type="text/javascript">
        $('.status').click(function(){
            var checked = $(this).find('input').attr('checked');

            var status;

            if(checked == 'checked'){
                status = 1;
            }else{
                status = 0;
            }
            
            var gid = $(this).attr('gid');

            $.ajax({
                url:"/admin/goods/changestatus",
                type:'POST',
                data:{'gid':gid,'status':status},
                // dataType:"json",
                success:function(data){
                    console.log(data);
                    
                }
            });
        })
    </script>
@endsection