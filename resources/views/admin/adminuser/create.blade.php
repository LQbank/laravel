@extends('admin.layout.index')

@section('content')

<!-- 显示 验证错误  开始 -->
@if (count($errors) > 0)
    <div class="mws-form-message error">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<!-- 显示 验证错误  结束 -->

	
<div class="mws-panel grid_8">
	<div class="mws-panel-header">
    	<span>添加管理员</span>
    </div>
    <div class="mws-panel-body no-padding">
    	<form class="mws-form" action="/admin/adminuser" method="post" enctype="multipart/form-data">
    		{{ csrf_field() }}
    		<div class="mws-form-inline">
    			<div class="mws-form-row">
    				<label class="mws-form-label">管理员账号</label>
    				<div class="mws-form-item">
    					<input type="text" name="name" class="small" value="{{ old('name') }}">
    				</div>
    			</div>
    	
    			<div class="mws-form-row">
                    <label class="mws-form-label">管理员密码</label>
                    <div class="mws-form-item">
                        <input type="password" name="passwd" class="small">
                    </div>
                </div>

                <div class="mws-form-row">
                    <label class="mws-form-label">确认密码</label>
                    <div class="mws-form-item">
                        <input type="password" name="spass" class="small">
                    </div>
                </div>

                <div class="mws-form-row">
                    <label class="mws-form-label">选取角色</label>
                    <div class="mws-form-item">
                    
                        <select class="small" name="rid">

                            @foreach ($role as $v)
                                <option  value="{{$v->id}}">{{$v->rname}}</option>
                            @endforeach   
                        </select>
                    </div>
                </div>




                

                <div class="mws-form-row" style="width: 610px;">
                    <label class="mws-form-label">管理员头像</label>
                    <div class="mws-form-item">
                        <input type="file" name="profile" value="" class="small">
                    </div>
                </div>
    			
    		</div>
    		<div class="mws-button-row">
    			<input type="submit" value="Submit" class="btn btn-danger">
    			<input type="reset" value="Reset" class="btn ">
    		</div>
    	</form>
    </div>    	
</div>

@endsection