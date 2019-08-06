<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tags;
use App\Models\Vals;
use App\Models\Cates;
use DB;

class TagsController extends Controller
{
	/**
     * 显示当前分类所有的商品属性
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
        // 查出的当前分类
        $cate = DB::table('cates')->where('id',$id)->first();

        // 查出当前分类所有的商品属性
        $tags = DB::table('tag')->where('cate_id',$id)->get();
        $tags = $tags->all();
        
        // 遍历商品属性 并把商品属性值压入商品属性数组
        foreach($tags as &$tag){
            // 查出当前遍历商品属性的所有的商品属性值
            $vals = DB::table('val')->where('tag_id',$tag->id)->get();
            $val_str = '';

            // 把商品属性值拼接成一个字符串
            foreach($vals as $val){
                $val_str .= '/'.$val->val;
            }
            // 压入数组中
            $tag->vals = $val_str;
        }
        
        return view('admin/tag/index',['id'=>$id,'tags'=>$tags,'cates'=>$cate]);
    }

    /**
     * 添加商品属性页面
     *
     * @return \Illuminate\Http\Response
     */
    public function insert(Request $request, $id)
    {
    	// dump($id);
    	// dd($request);
        return view('admin/tag/insert',['id'=>$id]);
    }

    /**
     * 执行添加商品属性
     *
     * @return \Illuminate\Http\Response
     */
    public function doinsert(Request $request, $id)
    {
        $name = $request->input('name','');

        // 插入tag表并返回id
        $res1 = DB::table('tag')->insertGetId(['name'=>$name,'cate_id'=>$id]);
      
        $vals = $request->input('val');

        // 判断是否有标签属性
        if(!empty($vals)){
        	// 遍历插入val表
        	foreach($vals as $val){
	            $res2 = DB::insert('insert into val (val,tag_id) values (?, ?)', [$val, $res1]);
	        }
        }
        
        // 判断是否成功
        if($res1){
            return redirect('admin/tags/index/'.$id)->with('success', '添加成功');
        }else{
            return back()->with('error', '添加失败');
        }
    }

    /**
     * 改变商品属性值
     *
     * @return \Illuminate\Http\Response
     */
    public function change(Request $request)
    {
        // 拿出参数
    	$vals = $request->all()['val'];
    	$tag_id = $request->all()['tag'];

        // 把参数以 / 分割
    	$vals = explode('/',$vals);

        // 删除字符串中的 / 
        array_shift($vals);
        
        // 执行删除
        DB::table('val')->where('tag_id',$tag_id)->delete();

        // 遍历写入商品属性值
    	foreach($vals as $val){
            $res2 = DB::insert('insert into val (val,tag_id) values (?, ?)', [$val, $tag_id]);
        }
    }
}
