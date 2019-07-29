@extends('admin.layout.index')


@section('content')
<style type="text/css">

    #page_page{
        float: left;
        margin-left:-26px;
    }
    #page_page li{
        list-style-type: none;
        margin:0;
        padding: 0;
    }
    #page_page li{
        position: relative;
        float: left;
        padding: 6px 12px;
        line-height: 1.42857143;
        color: #337ab7;
        text-decoration: none;
        background-color: #fff;
        border: 1px solid #ddd;
    } 

   
</style>
<div class="mws-panel grid_8">

			<div class="mws-panel-header">
                <span>
                <form action="/admin/users" method="get">
                    关键字
                    <input type="text" name="search" placeholder="用户名" value="{{ $requests['search'] or '' }}">
                    <input type="submit"class="btn btn-danger"  value="搜索">
                </form>
                </span>

            </div>
                    <div class="mws-panel-body no-padding">
                    <table class="mws-datatable-fn mws-table">

                        <thead>
                                <tr>
                                        <th>ID</th>
                                        <th>用户名</th>
                                        <th>邮箱</th>
                                        <th>手机号</th>
                                        <th>头像</th>
                                        <th>操作</th>
                                </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $k=>$v)
                            <tr>
                                <td>{{ $v->id }}</td>
                                <td>{{ $v->name }}</td>
                                <td>{{ $v->email }}</td>
                                <td>{{ $v->phone }}</td>
                                <td>
                                    <img src="/uploads/{{ $v->avatar }}" style="width: 50px;border-radius: 8px;">
                                </td>
                                <td>
                                    <form action="/admin/users/{{ $v->id }}" method="post" style="display: inline;">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <input type="submit" value='删除' class="btn btn-danger">
                                    </form>
                                    
                                    <a href="/admin/users/{{ $v->id }}/edit" class="btn btn-info">修改</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                            
                    </table>

                    <div id="page_page"  class="">
                        
                    {{ $users->appends($requests)->links() }}
                    </div>

            </div>
        </div>


@endsection
