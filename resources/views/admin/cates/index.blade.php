@extends('admin.layout.index')

@section('content')

<div class="mws-panel grid_8">
	<div class="mws-panel-header">
    	<span><i class="icon-table"></i> 分离列表</span>
    </div>
    <div class="mws-panel-body no-padding">
        <table class="mws-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>分类名称</th>
                    <th>父级ID</th>
                    <th>分类路径</th>
                    <th>是否上架</th>
                    <th>创建时间</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
            	@foreach($cates as $k=>$v)
                <tr align='center'>
                    <td>{{ $v->id }}</td>
                    <td>{{ $v->cname }}</td>
                    <td>{{ $v->pid }}</td>
                    <td>{{ $v->path }}</td>
                    <td>
                        @if($v->pid == 0)
                        <div style="height:20px;" class="status" cid="{{ $v->id }}">
                            <input  class="ibutton" type="checkbox" data-label-on="上架" data-label-off="下架" @if($v->status == 1) checked @endif>
                        </div>
                        @else
                        主类才能上架
                        @endif
                    </td>
                    <td>{{ $v->created_at }}</td>
                    <td>
                    	@if(substr_count($v->path,',') < 2)
						<a href="/admin/cates/create?id={{ $v->id }}" class="btn btn-primary">添加子分类</a>
                        @if($v->pid == 0)
                        <a href="/admin/tags/index/{{ $v->id }}" class="btn btn-primary">编辑分类属性</a>
                        @endif
                    	@endif
                    </td>
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
            console.log(checked);

            var status;

            if(checked == 'checked'){
                status = 1;
            }else{
                status = 0;
            }
            
            var cid = $(this).attr('cid');

            console.log(cid);
            $.ajax({
                url:"/admin/cates/changestatus",
                type:'POST',
                data:{'cid':cid,'status':status},
                // dataType:"json",
                success:function(data){
                    console.log(data);
                }
            });
        })
    </script>
@endsection