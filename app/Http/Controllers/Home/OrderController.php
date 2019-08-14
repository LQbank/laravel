<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;

class OrderController extends Controller
{
    public function index()
    {
        //订单查询
        // $order = DB::table('order1')
        // // 关联查sku表和order1表
        // ->join('order_detail','order1.id','=','order_detail.order_id')
        // ->where('order1.user_id',4)
        // ->get();

        // foreach ($order as $k => &$v) {
        //     $v->sub  = DB::table('sku')->where('id',$v->sku_id)->get();
        // }

        $order = DB::table('order1')->where('order1.user_id',4)->get();

        foreach ($order as $k => &$v) {
            //查询详情插入数组
            $v->sub  = DB::table('order_detail')->where('order_id',$v->id)->get();
            foreach ($v->sub as $k2 => &$v2) {
                //查询sku商品数据插入
                $v2->sub  = DB::table('sku')->where('id',$v2->sku_id)->get();
            }
        }

       


         

        dump($order);
        // ->where('status','1')

        return view('home/order/index');
    }

}
