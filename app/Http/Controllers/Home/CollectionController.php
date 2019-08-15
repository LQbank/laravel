<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Collect;
use DB;

class CollectionController extends Controller
{
    public function index()
    {
        $uid=session('home_user')->id;
        $collect = DB::table('collect')
        ->join('sku','collect.sku_id','=','sku.id')
        // 关联查sku表和good表
        ->join('good','collect.good_id','=','good.id')
        // 关联查cate表和good表
        ->join('users','users.id','=','collect.user_id')
        ->select('collect.*','sku.*','good.*')
        ->where('collect.user_id','=',$uid)	
        ->get();
        // dump($collect);
        return view('home/collection/index',['collect'=>$collect]);
    }

    //收藏添加
    public function create($id,$sku)
    {
        // dd(session("home_user"));
        $uid=session('home_user')->id;
        // dd(uid);
        $collect=new Collect;
        $collect->user_id=$uid;
        $collect->sku_id=$sku;
        $collect->good_id=$id;
        $collect->status='1';

        $res = $collect->save();
        if($res){
            return redirect('home/collection')->with('success', '收藏成功');
        }else{
            return back()->with('error', '收藏失败');
        }
        
    }
}
