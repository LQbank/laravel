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
                        <th>ID</th>
                        <th>描述</th>
                        <th>控制器名称</th>
                        <th>方法名</th>
                        <!-- <th>操作</th> -->
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $k=>$v)
                	<tr>
                        <td>{{ $v->id }}</td>
                        <td>{{ $v->desc }}</td>
                        <td>{{ $v->cname }}</td>
                        <td>{{ $v->aname }}</td>
                        <!-- <td>
                            <form action="/admin/nodes/{{ $v->id }}" method="post" style="display: inline;">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <input type="submit" value='删除' class="btn btn-danger">
                            </form>
                            
                             <a href="">修改</a> 
                        </td> -->
                    </tr>
                    @endforeach
                </tbody>
           
        </table>
    </div>
</div>
@endsection
@section('js')
<script src="/file/plugins/datatables/jquery.dataTables.min.js"></script> 
@endsection