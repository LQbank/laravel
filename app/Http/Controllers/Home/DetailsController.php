<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class DetailsController extends Controller
{
    public function index(Request $request,$id)
    {
    	// $mod = M('sku');

        // $res = $mod->where('sku.good_id='.I('get.id'))->join('good on sku.good_id=good.id')->select();
        // $res = $mod
        // ->where('sku.id='.I('get.id'))
        // ->join('join good on sku.good_id=good.id')
        // ->find();

    	// 查出当前商品的信息
		$res = DB::table('sku')
    	->where('sku.id',$id)
    	->leftJoin('good','sku.good_id','=','good.id')
    	->first();
        
        // dump($res);
        // dump($id);
        //dump($res);
        // $aaa = $mod->where('good_id='.$res['good_id'])->select();
        // dump($res->good_id);

        $aaa = DB::table('sku')->where('good_id',$res->good_id)->get();
        // dump($aaa);
        $ccc = [];
        foreach($aaa as $v){
            $bbb = explode('/',$v->sku);
            array_shift($bbb);
            array_push($ccc,$bbb);
        }


        // dump($ccc);

        
        // $mod1 = M('good');
        // $res1 = $mod1->where('id='.$res['good_id'])->find();
        $res1 = DB::table('good')->where('id',$res->good_id)->first();
        // dump($res1);
        // $mod2 = M('cate');
        // $res2 = $mod2->where('id='.$res1['cate_id'])->find();
        $res2 = DB::table('cates')->where('id',$res1->cate_id)->first();
        // dump($res2);
        $res3 = explode(',',$res2->path)[1];
        // dump($res3);
        // $res4 = $mod2->where('id='.$res3)->find();
        $res4 = DB::table('cates')->where('id',$res3)->first();
        // dump($res4);
        // $mod3 = M('tag');
        // $res5 = $mod3->where('cate_id='.$res4['id'])->select();
        $res5 = DB::table('tag')->where('cate_id',$res4->id)->get();
        
        foreach($res5 as $kk => &$k){

            // dump($res5[$kk]);
            // dump($kk);
            $k->sub = [];
            foreach($ccc as $aa){
                // $k['sub'] = $aaa[$kk];
                array_push($k->sub,$aa[$kk]);
            }
            $k->sub = array_unique($k->sub);
        }
        // dump($res5);
    	return view('home/details/index',['good'=>$res,'res2'=>$res2,'sku'=>$res5,'sid'=>$id]);
    }

    public function faajax(Request $request){
    	// echo '123';

        // $mod = M('sku');
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
        

        // $res = $mod
        // ->where($where)
        // ->join('join good on sku.good_id=good.id')
        // ->find();
        // // dump($res);
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
