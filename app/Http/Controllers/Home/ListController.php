<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;


class ListController extends Controller
{
    public function index($id)
    {

        // 列表页 根据id 查出二级分类名称
        $name  =DB::table('cates')->find($id);
        
        // dump($name->cname);

        $tags = $this->getvalue($id);
        // dump($tags);


        //查询相关商品
		$goods = DB::table('good') 
		// 关联查sku表和good表
	    ->join('sku','sku.good_id','=','good.id')
		// 关联查cates表和good表
        ->join('cates','cates.id','=','good.cate_id')
        ->where('good.cate_id','=',$id)
        ->select('good.*','cates.cname','sku.*')
        ->get();
		//分页
		// ->limit($page->firstRow,$page->listRows)
		
        dump($goods);
        
    	return view('home/list/index',['tags'=>$tags,'goods'=>$goods]);
    }


    /**
     * 查询  所有的标签以及属性
     */
    public function getvalue($id){

    	$cate_id = $id;
    
		//将子类id找到
		if(!$pid = explode(',',DB::table('cates')->find($cate_id)->path)[1]){
			$pid =  $id;
		}
		
		//查出子类下的属性
		$tags = DB::table('Tag')->where('cate_id','=',$pid)->get();


		//将val表中数据遍历到数组中
		foreach ($tags as &$tag) {
           
			$tag->sub = DB::table('val')->where('tag_id','=',$tag->id)->get();
            
		}
		return $tags;

    }

}
