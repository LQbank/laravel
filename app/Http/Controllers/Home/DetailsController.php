<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class DetailsController extends Controller
{
    /**
     * 商品详情页
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$id)
    {
        // $_SESSION['car'] = null;exit;
    	// 查出商品的信息和sku
		$res = DB::table('sku')
    	->where('sku.id',$id)
    	->leftJoin('good','sku.good_id','=','good.id')
    	->first();
        
        // 查出商品的sku
        $aaa = DB::table('sku')->where('good_id',$res->good_id)->get();
        $ccc = [];

        // 把sku遍历出来 并拆分
        foreach($aaa as $v){
            $bbb = explode('/',$v->sku);
            array_shift($bbb);
            array_push($ccc,$bbb);
        }

        // 查出当前商品
        $res1 = DB::table('good')->where('id',$res->good_id)->first();
        
        // 查出当前商品的分类
        $res2 = DB::table('cates')->where('id',$res1->cate_id)->first();
        
        // 把获得的分类字段拆分
        $res3 = explode(',',$res2->path)[1];
        
        // 查出商品的最顶级分类
        $res4 = DB::table('cates')->where('id',$res3)->first();
        
        // 查出分类所有的属性标签
        $res5 = DB::table('tag')->where('cate_id',$res4->id)->get();
        
        // 把属性标签遍历
        foreach($res5 as $kk => &$k){

            $k->sub = [];
            // 把商品的sku压入属性标签的数组中
            foreach($ccc as $aa){
                array_push($k->sub,$aa[$kk]);
            }

            // 去除重复的sku
            $k->sub = array_unique($k->sub);
        }
        
    	return view('home/details/index',['good'=>$res,'res2'=>$res2,'sku'=>$res5,'sid'=>$id]);
    }

    /**
     * 根据参数sku 改变显示的商品
     *
     * @return \Illuminate\Http\Response
     */
    public function faajax(Request $request){
    	// echo '123';

        // 传递过来的参数sku
        $sku = $request->input('sku');

        // 获取 返回的sql语句
        $sku = $this->dealSku($sku);
        // dump($sku);
        // exit;
        $where = '';

        // 判断sku是否存在 存在就拼接SQL语句 否则不拼接
        if($sku){
            $where = ' where sku.good_id='.$request->input('id').' and '.$sku;
        }else{
            $where = ' where sku.good_id='.$request->input('id');
        }
        // echo $where;
        // dump($where);

        // 查出一条当前sku的商品SQL语句
        $sql = "select *,sku.id as sid from sku left join good on sku.good_id=good.id ".$where." limit 0,1";

        // 执行SQL语句
        $res = DB::select($sql);

        // dump($res);
        // dump($res);
        
        // 输出的json数据
        echo json_encode($res);
        
    }

    /**
     * 把sku 分割并拼接成sql的语句
     *
     * @return \Illuminate\Http\Response
     */
    public function dealSku($sku){
        $sku_arr = explode('/',$sku);

        array_shift($sku_arr);

        foreach($sku_arr as &$v){
            $v = "sku.sku like '%$v%'";
        }

        return implode(' and ',$sku_arr);
    }
}
