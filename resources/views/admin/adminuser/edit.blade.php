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
    	<span>修改管理员</span>
    </div>
    <div class="mws-panel-body no-padding">
    	<form class="mws-form" action="/admin/adminuser/{{ $id }}" method="post" enctype="multipart/form-data">
    		{{ csrf_field() }}
    		{{ method_field('PUT') }}
    		<div class="mws-form-inline">
    			<div class="mws-form-row">
    				<label class="mws-form-label">管理员角色</label>
    				<div class="mws-form-item">
    					@foreach($roles as $v)
                        	<input type="checkbox" name="role[]" {{in_array($v->id,$quan) ? 'checked' : ''}} value="{{$v->id}}" class="">{{$v->rname}}&nbsp;&nbsp;&nbsp;
                        @endforeach
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