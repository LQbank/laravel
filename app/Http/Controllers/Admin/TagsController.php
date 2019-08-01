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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {

    	// $mod = M('tag');
     //    $mod1 = M('cate');
     //    $mod2 = M('val'); 
        $cate = DB::table('cates')->where('id',$id)->first();
        $tags = DB::table('tag')->where('cate_id',$id)->get();
        $tags = $tags->all();
        

        // $tags = $mod->where('cate_id='.I('get.cate_id'))->select();
        // // dump($tags);

        foreach($tags as &$tag){
            $vals = DB::table('val')->where('tag_id',$tag->id)->get();
            $val_str = '';

            foreach($vals as $val){
                $val_str .= '/'.$val->val;
            }
            $tag->vals = $val_str;
        }
        // dump($tags);
        // dd($cate);

        return view('admin/tag/index',['id'=>$id,'tags'=>$tags,'cates'=>$cate]);
    }

    /**
     * Display a listing of the resource.
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function doinsert(Request $request, $id)
    {
    	// dump($id);
    	// dd($request->all());
    	// dd($request->input('val'));
    	

    	
        // $Tag = new Tags;
        // $Tag->cate_id = $id;
        // $Tag->name = $request->input('name','');

        $name = $request->input('name','');
        // $res1 = $Tag->save();
        // $res1 = DB::insert('insert into Tag (name,cate_id) values (?, ?)', [$name, $id]);
        // $res1 = Tags::create(['name'=>$name,'cate_id'=>$id]);

        // 插入tag表并返回id
        $res1 = DB::table('tag')->insertGetId(['name'=>$name,'cate_id'=>$id]);
        // dd($res1);
        
        // $Val = new Vals;

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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function change(Request $request)
    {
    	$vals = $request->all()['val'];
    	$tag_id = $request->all()['tag'];
    	$vals = explode('/',$vals);
        array_shift($vals);
        dump($vals);
        DB::table('val')->where('tag_id',$tag_id)->delete();
    	foreach($vals as $val){
            $res2 = DB::insert('insert into val (val,tag_id) values (?, ?)', [$val, $tag_id]);
        }
    }
}
