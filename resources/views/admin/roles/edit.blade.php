@extends('admin.layout.index')

@section('content')

<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span>Inline Form</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                    	<form class="mws-form" action="/admin/roles/{{ $role->id }}" method="post">
                    		{{ csrf_field() }}
                            {{ method_field('PUT') }}
                    		<div class="mws-form-inline">
                    			<div class="mws-form-row">
                    				<label class="mws-form-label">角色名称</label>
                    				<div class="mws-form-item">
                    					<input type="text" disabled  name="rname" value="{{$role->rname}}" class="small">
                    				</div>
                    			</div>
                    			
                    		
                    			<div class="mws-form-row">
                    				<label class="mws-form-label">角色权限</label>
                                    <input type="checkbox" id="all">
                                    <input type="button" value="全选" class="btn" id="selectAll">  
    	                            <input type="button" value="全不选" class="btn" id="unSelect">
                    				<div class="mws-form-item clearfix" id="list">
                    					@foreach($nodes as $k=>$v)
                    					<h3>{{ $controllernames[$k] }}</h3>
                    					<ul class="mws-form-list inline"  >
                    						@foreach($v as $kk=>$vv)

                    						<li><input type="checkbox" 

                                            {{--判断是否包含此权限，初始选中--}}
                                            @if (in_array($vv['id'],$role_node->toArray()))
                                            checked='true'
                                            @else
                                                
                                            @endif

                                              value="{{ $vv['id'] }}" name="nid[]"> <label>{{ $vv['desc'] }}</label></li>
                    						
                                            @endforeach
                    					</ul>
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

@section('js')
        <script>
                
                    //全选或全不选
                    $("#all").click(function(){   

                        if(this.checked){  
                            $("#list :checkbox").prop("checked", true);  
                        }else{   
                            $("#list :checkbox").prop("checked", false);
                        }   
                    }); 
                    //全选  
                    $("#selectAll").click(function () {
                        $("#list :checkbox,#all").prop("checked", true);  
                    });  
                    //全不选
                    $("#unSelect").click(function () {  
                        $("#list :checkbox,#all").prop("checked", false);  
                    });  
                  
        </script>
@endsection