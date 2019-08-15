<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use  App\Models\reply;
use DB;

class ReplyController extends Controller
{

    /**
     *  开始评价显示页面
     */
    public function index($id,$sku,$detail)
    {
        // dump($detail);
        //订单商品
        $order = DB::table('order1')->where('id',$id)->get();

        $sku_id = $sku;
       
        //sku和good数据
        $sku = DB::table('sku')->where('id',$sku)->get();

        foreach( $sku as &$v){
            $v->sub  = DB::table('good')->where('id',$v->good_id)->get();
        }

        
        
        // dump($order);
        // dump($sku);

        return view('home/reply/index',['order'=>$order,'sku'=>$sku,'detail'=>$detail,'sku_id'=>$sku_id]);
    }

    /**
     *  执行添加
     */
    public function add(Request $request,$id,$sku,$detail)
    {
        // dump($id);
        // dump($detail);
        // dd($request->input());

        $reply = new reply;
        $reply->user_id = session('home_user')->id ;
        $reply->good_id = $id;
        $reply->sku_id = $sku;

        $reply->content = $request->input('content');
        $reply->desc = $request->input('editorValue');
        $reply->num = $request->input('num');
        // dd($reply);
        // 添加
        $res1 = $reply->save();

        $status = '1';
         // 查出当前数据
         $save = DB::table('order_detail')
         ->where('id', $detail)
         ->update(['status' => $status]);


        // 判断是否成功
        if($res1 && $save){
            return redirect('/home/reply/replyok')->with('success', '添加成功');
           
        }else{
            return back()->with('error', '添加失败');
        }

    }
    /**
     *  添加成功
     */
    public function replyok()
    {
        return view('home/reply/replyok');
    }
}
