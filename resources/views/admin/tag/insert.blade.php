@extends('admin.layout.index')

@section('content')
<div class="mws-panel grid_4">
	<div class="mws-panel-header">
    	<span>添加分类</span>
    </div>
    <div class="mws-panel-body no-padding">
    	<form class="mws-form" action="/admin/tags/doinsert/{{$id}}" method="post">
    		{{ csrf_field() }}
    		<div class="mws-form-inline">
                <div class="mws-form-row">
                    <label class="mws-form-label">标签名:</label>
                    <div class="mws-form-item">
                        <input type="text" name="name" class="required" placeholder="标签名">
                    </div>
                </div>
                
            </div>

            <div class="mws-form-inline">
                <div class="mws-form-row">
                    <label class="mws-form-label">标签值:</label>
                    <div class="mws-form-item">
                        <input type="text" name="val[]" class="required" placeholder="标签值">
                        <i class='icon-minus-sign' style='color:red;font-size:22px'></i>
                    </div>
                </div>
            </div>
            <div id="addval1" class="mws-form-inline">
                <button id='addval' class="btn btn-info">+ 增加标签值</button>
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
	<script type="text/javascript">
		$('#addval').click(function(){
			var inp = `
				<div class="mws-form-inline">
                    <div class="mws-form-row">
                        <label class="mws-form-label">标签值:</label>
                        <div class="mws-form-item">
                            <input type="text" name="val[]" class="required" placeholder="标签值">
                            <i class='icon-minus-sign' style='color:red;font-size:22px'></i>
                        </div>
                    </div>
                </div>
			`;

			$('#addval1').before(inp);

			return false;
		})

		$('.icon-minus-sign').live('click',function(){
			$(this).parents()[2].remove();
		})
	</script>
@endsection