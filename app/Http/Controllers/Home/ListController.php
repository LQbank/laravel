<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use vendor\laravel\framework\src\Illuminate\Database\Query;

class ListController extends Controller
{
    /**
     *  主页
     */
    public function index($id)
    {

        // 列表页 根据id 查出分类下的所有数据
        $tags = $this->getvalue($id);
        // dump($tags);


        //查询相关商品
		$goods = DB::table('good') 
		// 关联查sku表和good表
	    ->join('sku','sku.good_id','=','good.id')
		// 关联查cates表和good表
        ->join('cates','cates.id','=','good.cate_id')
        ->where('good.cate_id','=',$id)
        ->where('sku.status',1)
        ->orderBy('good.id', 'desc')
        ->select('good.*','cates.cname','sku.*')
        ->get();
		
		
        // dump($goods);
        
    	return view('home/list/index',['tags'=>$tags,'goods'=>$goods,'cate_id'=>$id]);
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

    /**
     *  处理sku
     */
    private function  dealSku($sku)
	{
		//字符串分割取值
		$sku_arr =  explode('/',$sku);
		//弹出第一个值
		array_shift($sku_arr);

		//遍历like sql语句
		foreach($sku_arr as &$v){

            // $v = "'sku.sku','like','%$v%'";
            $v = "sku.sku like '%$v%'";
		}
        
        
		return implode(' and ',$sku_arr);
	}



    /**
     *  排序的ajax
     */
    public function  sort(Request $request)
	{
        $cate_id = $request->input('cate_id');
		$field = $request->input('field');
		$sku = $request->input('sku');

	
		if(empty($sku)){

			$goods = DB::table('good')
            // 关联查sku表和good表
            ->join('sku','sku.good_id','=','good.id')
            // 关联查cates表和good表
            ->join('cates','cates.id','=','good.cate_id')

            ->orderBy($field, 'desc')
            ->where('good.cate_id','=',$cate_id)
            ->where('sku.status',1)
            ->select('good.*','cates.cname','sku.*')
			->get();	



		}else{

			$like = $this->dealSku($sku);

			$goods = DB::select("select * from good  join sku on  sku.good_id =good.id   join cates on cates.id = good.cate_id   where(good.cate_id = $cate_id and sku.status=1  and $like) order by $field desc");



		}
		
		
		
		echo json_encode($goods);
	

	}
}
