@extends('admin.layout.index')

@section('content')
        <div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span>Inline Form</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                    	<form class="mws-form" action="/admin/cartoon" method="post"   enctype="multipart/form-data">
                        {{ csrf_field() }}
                    		<div class="mws-form-inline">
                    			<div class="mws-form-row">
                    				<label class="mws-form-label">轮播图名称:</label>
                    				<div class="mws-form-item">
                    					<input type="text"  name='name' class="large">
                    				</div>
                    			</div>
                    		</div>

                    		<div class="mws-form-row" >
                              <label class="mws-form-label">图片 :</label>
                              <div class="mws-form-item">
                                     <input type="file"  name="pic"  class="small">
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