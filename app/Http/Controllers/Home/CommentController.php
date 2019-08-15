<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;

class CommentController extends Controller
{
     /**
     *  评价页面
     */
    public function index()
    {
        
        //查询用户所有评价
        $reply = DB::table('reply')
       
        // 关联查sku表和reply表
        ->join('sku','reply.sku_id','=','sku.id')
        // 关联查表reply和good表
        ->join('good','reply.good_id','=','good.id')
        ->where('reply.user_id','=',session('home_user')->id)	
        ->select('reply.*','sku.pic','sku.sku','good.name')
        ->get();
       
        // dump( $reply);

    
        return view('home/comment/index',['reply'=>$reply,]);
    }

}
