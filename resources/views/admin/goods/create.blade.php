@extends('admin.layout.index')

@section('content')
    <div class="mws-panel grid_8">
        <div class="mws-panel-header">
            <span>Inline Form</span>
        </div>
        <div class="mws-panel-body no-padding">
            <form class="mws-form" id="good" action="/admin/goods/insert"  enctype="multipart/form-data" method="post" onsubmit='return sendGood()'>
                {{ csrf_field() }}
                <div class="mws-form-inline">
                    <div class="mws-form-row">
                        <label class="mws-form-label">选择商品分类</label>
                        <div class="mws-form-item">
                            <select class="small" name='cate_id'>
                                @foreach($cates as $cate)
                                    <option @if($cate->pid == 0 || strlen($cate->path) <= 3) disabled @endif value="{{$cate->id}}">{{$cate->cname}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mws-form-row">
                        <label class="mws-form-label">名称：</label>
                        <div class="mws-form-item">
                            <input type="text" name='name' class="small">
                        </div>
                    </div>
                    <div class="mws-form-row">
                        <label class="mws-form-label">厂家：</label>
                        <div class="mws-form-item">
                            <input type="text" name='company' class="small">
                        </div>
                    </div>
                    
                    <div class="mws-form-row">
                        <label class="mws-form-label">简介</label>
                        <div class="mws-form-item">
                            <!-- <textarea rows="" cols="" name="desc" class="small"></textarea> -->
                            <script id="editor" type="text/plain" style="width:550px;height:300px;"></script>

                        </div>
                    </div>
                    
                    <hr id='tag'>
                    
                    <div class="mws-form-row ">
                        <label class="mws-form-label">图片：</label>
                        <div class="mws-form-item">
                            <input type="file" name='pic' onchange="picUpload()" class="small">
                        </div>
                    </div>
                    <div class="mws-form-row ">
                        <label class="mws-form-label">图片浏览：</label>
                        <div class="mws-form-item">
                            <img src="" class='img' style="width:80px;" alt="">
                        </div>
                    </div>
                    <div class="mws-form-row">
                        <label class="mws-form-label">单价：</label>
                        <div class="mws-form-item">
                            <input type="text" name='price' class="small">
                        </div>
                    </div>
                    <div class="mws-form-row">
                        <label class="mws-form-label">数量：</label>
                        <div class="mws-form-item">
                            <input type="text" name='num' class="small">
                        </div>
                    </div>
                    <div class="mws-form-row">
                        <a id="sku" class='btn btn-warning pull-right'>添加SKU</a>

                    </div>
                    <hr />
                    <div class="mws-panel">
                        <div class="mws-panel-body no-padding">
                            <table class="mws-table" id="table">
                                <thead>
                                    <tr style='border:2px solid #ccc;'>
                                        <th></th>
                                        <th>图片</th>
                                        <th>SKU</th>
                                        <th>单价</th>
                                        <th>上架数量</th>
                                        <th>操作</th>
                                    </tr>
                                </thead>
                                <tbody id='tbody'>
                                    
                                </tbody>
                            </table>
                        </div>      
                    </div>
                <hr />
                <div class="mws-button-row">
                    <input type="submit" value="Submit" class="btn btn-danger">
                    <input type="reset" value="Reset" class="btn ">
                </div>
            </form>
        </div>      
    </div>
@endsection
    
@section('js')
<!-- 百度编辑器 -->

<script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.all.min.js"> </script>
<!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
<!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
<script type="text/javascript" charset="utf-8" src="/ueditor/lang/zh-cn/zh-cn.js"></script>
<script>
	//实例化编辑器
    //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
      var ue = UE.getEditor('editor', {
toolbars: [
        ['source', 'bold', 'italic', 'underline', 'strikethrough', 'blockquote', 'insertunorderedlist', 'insertorderedlist', 'justifyleft','justifycenter', 'justifyright',  'link', 'insertimage', 'fullscreen']
    ],
    elementPathEnabled: false,
    enableContextMenu: false,
    autoClearEmptyNode:true,
    wordCount:false,
    imagePopup:false,
    autotypeset:{ indent: true,imageBlockLine: 'center' }
});


</script>

<!-- 显示的商品的标签属性 -->
<script type="text/javascript">
    // 当选择分类时 显示他的sku
    $('select:eq(0)').change(function(){
        var cate_id = $(this).val();

        //删除上一次的tag框
        $('.tag').remove();

        // 发送ajax获取sku 并显示
        getTagAndVals(cate_id);
    })

    //首次刷新页面触发服装分类的标签和值的获取
    getTagAndVals(3);

    // 发送ajax
    function getTagAndVals(cate_id){
        $.ajax({
            url:'/admin/goods/getTagAndVals',
            data:{'cate_id':cate_id},
            type:'POST',
            dataType:'Json',
            success:function(mes){
                console.log(mes);
                var str = '';

                // 把sku遍历到页面中
                $(mes).each(function(){
                    str += `
                        <div class="mws-form-row tag">
                            <label class="mws-form-label">${$(this).attr('name')}</label>
                            <div class="mws-form-item">
                                <select class="small sel">
                                    ${op($(this).attr('vals'))}
                                </select>
                            </div>
                        </div>
                    `;
                })

                // 写入页面
                $('#tag').after(str);
            }
        })
    }

    // 遍历出每个标签名称的标签属性
    function op(ops){
        var op = '';

        $(ops).each(function(){
            // console.log($(this));
            op += `
                <option value="${$(this).attr('id')}">${$(this).attr('val')}</option>
            `;
        })
        return op;
    }
</script>

<!-- 点击图片上传 -->
<script type="text/javascript">
    console.log($('#good')[0]);
    //给表单元素绑定change事件
    function picUpload(){
        $.ajax({
            url:"/admin/goods/picUpload",
            type:'POST',
            cache:false,
            data:new FormData($('#good')[0]),
            processData:false,
            contentType:false,
            // dataType:"json",
            success:function(data){
                console.log(data);
                $('.img').attr('src','/uploads/' + data);
            }
        });
    }
</script>

<!-- 添加sku的条数 -->
<script>

    $('#sku').click(function(){
        var num = $('input[name="num"]').val();
        var price = $('input[name="price"]').val();
        var src = $('.img:eq(0)').attr('src');
        var sku = '';
        if(num == '' || price == '' || src == ''){
            return false;
        }

        $('.sel').each(function(){
            var val = $(this).val();
            $(this).find('option').each(function(){
                if($(this).attr('value') == val){
                    sku += '/' + $(this).html();
                }
            })
        })
        
        var tr = `
            <tr class="sku_item" align='center'>
                <td class="checkbox-column" >
                    <input class='duo' type="checkbox">
                </td>
                <td><img width='80px' src="${src}" alt="" /></td>
                <td>${sku}</td>
                <td>¥<span>${price}</span></td>
                <td>${num}</td>
                <td ><p class='btn btn-info btn-ms dianji'>删除</p></td>
            </tr>
        `;

        $('#tbody').append(tr);
        shanchu();
        return false;
    })
</script>

<!-- 当商品分类改变时 下面的sku重置 -->
<script>
    $('select[name="cate_id"]').change(function(){
        $('#tbody').empty();
    })

    function shanchu(){
        $('.dianji').click(function(){
            $(this).parent().parent().remove();
        })
    }
</script>

<!-- 把新增的sku写入数据库 -->
<script>
    function sendGood(){
        var skus = [];

        $('.sku_item').each(function(){
            if($(this).find('td').eq(0).find('input').attr('checked') != undefined){
                var obj = {};

                obj.pic = $(this).find('td').eq(1).find('img').attr('src');
                obj.sku = $(this).find('td').eq(2).html();
                obj.price = $(this).find('td').eq(3).find('span').html();
                obj.num = $(this).find('td').eq(4).html();

                skus.push(obj);
            }
            
        })
        // console.log(skus);
        // console.log(skus == '');
        // return false;
        if(skus == ''){
            return false;
        }else{
            $.ajax({
                url:'/admin/goods/addsku',
                data:{skus:skus},
                type:'POST',
                success:function(mes){
                    console.log(mes);
                },
                async:false
            })
        }
        
    }
</script>
@endsection