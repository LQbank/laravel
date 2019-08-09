<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class DetailsController extends Controller
{
    public function index(Request $request,$id)
    {
        // $_SESSION['car'] = null;exit;
    	// 查出当前商品的信息
		$res = DB::table('sku')
    	->where('sku.id',$id)
    	->leftJoin('good','sku.good_id','=','good.id')
    	->first();
        
        $aaa = DB::table('sku')->where('good_id',$res->good_id)->get();
        $ccc = [];
        foreach($aaa as $v){
            $bbb = explode('/',$v->sku);
            array_shift($bbb);
            array_push($ccc,$bbb);
        }


        $res1 = DB::table('good')->where('id',$res->good_id)->first();
        
        $res2 = DB::table('cates')->where('id',$res1->cate_id)->first();
        // dump($res2);
        $res3 = explode(',',$res2->path)[1];
        // dump($res3);
        
        $res4 = DB::table('cates')->where('id',$res3)->first();
        // dump($res4);
        
        $res5 = DB::table('tag')->where('cate_id',$res4->id)->get();
        
        foreach($res5 as $kk => &$k){

            $k->sub = [];
            foreach($ccc as $aa){
          
                array_push($k->sub,$aa[$kk]);
            }
            $k->sub = array_unique($k->sub);
        }
        // dump($res5);
    	return view('home/details/index',['good'=>$res,'res2'=>$res2,'sku'=>$res5,'sid'=>$id]);
    }

    public function faajax(Request $request){
    	// echo '123';

        $sku = $request->input('sku');

        $sku = $this->dealSku($sku);
        // dump($sku);
        // exit;
        $where = '';
        if($sku){
            $where = ' where sku.good_id='.$request->input('id').' and '.$sku;
        }else{
            $where = ' where sku.good_id='.$request->input('id');
        }
        // echo $where;
        // dump($where);
        $sql = "select *,sku.id as sid from sku left join good on sku.good_id=good.id ".$where." limit 0,1";

        $res = DB::select($sql);

        // dump($res);
        // dump($res);
        
        echo json_encode($res);
        
    }

    public function dealSku($sku){
        $sku_arr = explode('/',$sku);

        array_shift($sku_arr);

        foreach($sku_arr as &$v){
            $v = "sku.sku like '%$v%'";
        }

        return implode(' and ',$sku_arr);
    }
}
