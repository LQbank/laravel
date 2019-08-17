@extends('admin.layout.index')

@section('content')

            <div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span><i class="icon-table"></i> 友情链接展示 </span>

                    </div>
                    <div class="mws-panel-body no-padding">
                        <table class="mws-datatable-fn mws-table">

                            <thead>
                                <tr>
                         
                               		<th>id</th>
                                    <th>link</th>
                                    <th>pic</th>
                                    <th>status</th>
                                    <th>操作</th>

                                </tr>
                            </thead>
                            <tbody>
                            @foreach($links as $k=>$v)
                               	 <tr>

                                    <td>{{ $v->id }}
                                    
                                    </td>
                                    <td>{{ $v->link }}
                                    
                                    </td>
                                   
									<td style="width:200px">
									<img src="/uploads/{{ $v->pic }}" alt="User Photo"  width="200px"  >
									</td>
                                  
                                    <td  class="qy"  info="{{ $v->id }}">
									
										<input class="ibutton" type="checkbox" data-label-on="启用" data-label-off="禁用" @if($v->status) checked @else @endif  >
									</td>
                                    <td>
                                        <form action="/admin/link/{{ $v->id }}" method="post" style="display: inline;">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <input type="submit" value='删除' class="btn btn-danger">
                                        </form>
                                    </td>
                               	 </tr>
  							@endforeach



							
                         	</tbody>
                        </table>
                    </div>
            </div>
           

@endsection
@section('js')
    <script>

        $('.qy').each(function(){

        this.onclick=function(evevt){

            var id = this.getAttribute('info');

            if(evevt.target.nodeName !== 'TD'){


                $.ajax({
                    type: 'POST',
                    url: '/admin/link/changeStatus', 
                    data: { 'id': id },
                    dataType: 'json',
                    success: function(data){
                        
                    },
                    error: function(){
                    
                    }
                });

            }
        }


        })
    </script>
@endsection


