@extends('admin.layout.index')

@section('content')
<div class="mws-panel grid_8">
	<div class="mws-panel-header">
    	<span><i class="icon-table"></i>{{ $cates->cname }}分类的属性表</span>
    	<a href="/admin/tags/insert/{{$id}}" id="mws-form-dialog-mdl-btn" class='btn btn-success' style='float:right;margin-top:-30px;'>+ 添加标签属性</a>
    </div>
    <div class="mws-panel-body no-padding">
            <table class="mws-datatable-fn mws-table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Tag_value</th>
                    </tr>
                </thead>
                <tbody>
                	@foreach($tags as $tag)
                    <tr align='center'>
                        <td>{{$tag->id}}</td>
                        <td>{{$tag->name}}</td>
                        <td><span class='val'>{{$tag->vals}}</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
</div>

@endsection

@section('js')
	<script>
		$('.val').live('click',function(){
			if(!$(this).attr('info')){
				var val = $(this).html();
				$(this).html('<input class="inp" name="name" type="text" value="'+val+'"/>');
				$(this).attr('info','test');
			}
		})

		$('.inp').live('blur',function(){
			var val = $(this).val();
			send(this,val);
			$(this).parents('span').removeAttr('info');
			$(this).parents('span').html(val);
		})

		function send(inp,val){
			var tag_id = $(inp).parents('tr').find('td').eq(0).html();
			$.ajax({
	            url: "/admin/tags/change",
	            type:"post",
	            data: {'tag':tag_id,'val':val},
	            // dataType: "json",
	            success: function success(data) {
	                console.log(data);
	            }
	        });
		}
	</script>
@endsection
