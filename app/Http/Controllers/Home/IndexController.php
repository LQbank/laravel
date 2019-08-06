<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cates;


class IndexController extends Controller
{
    public static function  getPidCateData($pid = 0)
    {
        //获取一级分类
        $data = Cates::where('pid',$pid)->get();

        foreach($data as $k=>$v)
        {
            // $erji = Cates::where('pid',$v->id)->get();
        
            // $v->sub =  $erji;

            $v->sub =  self::getPidCateData($v->id);
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

    
    public function index()
    {

        // $cates_data = self::getPidCateData();

    	// return view('home/index/index',['cates_data'=>$cates_data]);
  
        return view('home/index/index');
    }

    

    // public function getCatesByid($data)
    // {

            
    //     $mod1= M('good');

    //     $good = $mod1->select();
        
        
    //     foreach($data as &$val){

    //             // dump($val[sub]);die;

    //         foreach($val[sub] as &$v){

    //             // dump($v[id]);

    //             foreach($good as $vv){

    //                 if($v['id']==$vv['cate_id']){

                        
    //                     $goods = $mod1 
    //                     ->where('cate_id='.$v[id])
    //                     ->field('good.*,cate.name as c_name,sku.*')
    //                     // 关联查sku表和good表
    //                     ->join('sku  on sku.good_id=good.id')
    //                     // 关联查cate表和good表
    //                     ->join('cate on cate.id=good.cate_id')
    //                     // 按照good表id进行分组统计
    //                     ->group('good.id')
    //                     ->select();	

    //                     // dump($goods);die;

    //                    $v['sub'] = $goods;

    //                     // dump($v['sub'] );
    //                 }
    //             }

    //         }	
            
    //     }
           
    //     return $data;
    // }


    public function logout(Request $request)
    {

        $request->session()->flush();
        // 跳转
        return redirect('/home'); 

    }
    
}
