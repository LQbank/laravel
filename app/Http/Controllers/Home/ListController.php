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
        ->select('good.*','cates.cname','sku.*')
        ->get();
		//分页
		// ->limit($page->firstRow,$page->listRows)
		
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
     *  前台ajax
     * 
     */
    public function  getGoods(Request $request)
    {
       //将点击后属性值 与数据库比较

       $cate_id =  $request->input('cate_id');
        $sku =  $request->input('sku');
       
        
		  // $sku = "/黑色";
		
		// $cate_id = 16;
        // $sku = '/黑色/毛线';  //-->sku.sku like '%毛线%' and sku.sku like '%黑色%'
        
		// like字段
        $like = $this->dealSku($sku);
        
        // dump($like);
         

        //  $query = DB::table('good')
        //  ->join('sku','sku.good_id','=','good.id')
        // ->where('good.cate_id',$cate_id)
        // ->where($like)
        // ->get();
        // $query->toSql();

        $query = DB::select("select * from good  join sku on  sku.good_id =good.id where(good.cate_id = $cate_id and $like)");

	 	echo json_encode($query);
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


}
