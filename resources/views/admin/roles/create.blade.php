@extends('admin.layout.index')

@section('content')

<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span>Inline Form</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                    	<form class="mws-form" action="/admin/roles" method="post">
                    		{{ csrf_field() }}
                    		<div class="mws-form-inline">
                    			<div class="mws-form-row">
                    				<label class="mws-form-label">角色名称</label>
                    				<div class="mws-form-item">
                    					<input type="text" name="rname" class="small">
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
                    					<ul class="mws-form-list inline">
                    						@foreach($v as $kk=>$vv)
                    						<li><input type="checkbox" value="{{ $vv['id'] }}" name="nid[]"> <label>{{ $vv['desc'] }}</label></li>
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