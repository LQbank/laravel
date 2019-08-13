<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Home\ShopCarController;
use App\Models\Cates;
use App\Models\Cartoons;
use DB;

class IndexController extends Controller
{
    public static function  getPidCateData($pid = 0)
    {
        //获取一级分类
        $data = Cates::where('pid',$pid)->get();

        //获取商品  信息
        $good = DB::table('good')->get();

        foreach($data as $k=>$v)
        {
            // $erji = Cates::where('pid',$v->id)->get();
        
            // $v->sub =  $erji;

            $v->sub =  self::getPidCateData($v->id);
                    

                    foreach($good as $vv)
                    {
                        // dump($v1->id);  
                        // dump($vv->cate_id);  
                        //如果cate_id值相等  则将商品数据加入数组
                        if($v->id==$vv->cate_id)
                        { 
                            // dump($vv->cate_id);
                            $goods = DB::table('good')
                            ->where('cate_id','=',$v->id)
                            // 关联查sku表和good表
                            ->join('sku','sku.good_id','=','good.id')
                            // 关联查cate表和good表
                            ->join('cates','cates.id','=','good.cate_id')
                            // // 按照good表id进行分组统计
                            ->groupBy('good.id')
                            ->select('good.*','cates.cname','sku.*')	
                            ->get();
                            // dump($goods);    
                            $v->sub = $goods;
                        }
                    }
        }
        return $data;
    }

    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     *
     * 查出上架的分类和商品
     *
     */
    public function watchshop()
    {
        
    }

    
    // public static function  getGoods()
    // {
        // $cates_data = self::getPidCateData();

        // $good = DB::table('good')->get();

        // foreach($cates_data as &$val)
        // {

        //         // dump($val->cname);

        //     foreach($val->sub as &$v)
        //     {

        //         foreach($v->sub as &$v1)
        //         { 

        //             foreach($good as $vv)
        //             {
        //                 // dump($v1->id);  
        //                 // dump($vv->cate_id);  
        //                 if($v1->id==$vv->cate_id)
        //                 { 
        //                     // dump($vv->cate_id);
        //                     $goods = DB::table('good')
        //                     ->where('cate_id','=',$v1->id)
        //                     // 关联查sku表和good表
        //                     ->join('sku','sku.good_id','=','good.id')
        //                     // 关联查cate表和good表
        //                     ->join('cates','cates.id','=','good.cate_id')
        //                     // // 按照good表id进行分组统计
        //                     // ->groupBy('good.id')
        //                     ->select('good.*','cates.cname','sku.*')	
        //                     ->get();
        //                     // dump($goods);    
                

        //                     $v1->sub = $goods;
        //                 }
        //             }
        //         }
        //     }

        // }

        // return $cates_data;
        
    // }

    // public static $link='';
    public function index()
    {
        // $cates_data = self::getPidCateData();
        // dump($cates_data);

        // return view('home/index/index',['cates_data'=>$cates_data]);
        
        // $arr = self::getGoods();

        // dump($arr);
        // $link=DB::table('links')->get();
        $cartoon=DB::table('cartoons')->where('status','1')->get();

        // dd($cartoon);
        return view('home/index/index',['cartoon'=>$cartoon]);

    }

    /*
    *
    *   退出登录
    */
    public function logout(Request $request)
    {

        $request->session()->flush('home_user');

       

        // 跳转
        return redirect('/'); 

    }
    
}
