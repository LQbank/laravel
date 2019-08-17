<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;

class OrderController extends Controller
{
	/**
     * 订单页面
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
        ///所有订单
        $order = DB::table('order1')->where('order1.user_id',session('home_user')->id)->get();

        foreach ($order as $k => &$v) {
            //查询详情插入数组
            $v->sub  = DB::table('order_detail')->where('order_id',$v->id)->get();
            foreach ($v->sub as $k2 => &$v2) {
                //查询sku商品数据插入
                $v2->sub  = DB::table('sku')->where('id',$v2->sku_id)->get();

                foreach ($v2->sub as $k3 => &$v3) {
                    //查询good表数据
                    $v3->sub  = DB::table('good')->where('id',$v3->good_id)->get();
                }

            }
        }

       
        //status为0  待发货
        $order0 = DB::table('order1')->where('order1.user_id',session('home_user')->id)->where('status','0')->get();

        foreach ($order0 as $k => &$v) {
            //查询详情插入数组
            $v->sub  = DB::table('order_detail')->where('order_id',$v->id)->get();
            foreach ($v->sub as $k2 => &$v2) {
                //查询sku商品数据插入
                $v2->sub  = DB::table('sku')->where('id',$v2->sku_id)->get();

                foreach ($v2->sub as $k3 => &$v3) {
                    //查询good表数据
                    $v3->sub  = DB::table('good')->where('id',$v3->good_id)->get();
                }

            }
        }

         //status为1  待收货
         $order1 = DB::table('order1')->where('order1.user_id',session('home_user')->id)->where('status','1')->get();

         foreach ($order1 as $k => &$v) {
             //查询详情插入数组
             $v->sub  = DB::table('order_detail')->where('order_id',$v->id)->get();
             foreach ($v->sub as $k2 => &$v2) {
                 //查询sku商品数据插入
                 $v2->sub  = DB::table('sku')->where('id',$v2->sku_id)->get();
 
                 foreach ($v2->sub as $k3 => &$v3) {
                     //查询good表数据
                     $v3->sub  = DB::table('good')->where('id',$v3->good_id)->get();
                 }
 
             }
         }

         //status为2 已收货 可以评价
         $order2 = DB::table('order1')->where('order1.user_id',session('home_user')->id)->where('status','2')->get();

         $count =0;
         foreach ($order2 as $k => &$v) {
             //查询详情插入数组
             $v->sub  = DB::table('order_detail')->where('order_id',$v->id)->where('status','0')->get();
             foreach ($v->sub as $k2 => &$v2) {
                 //查询sku商品数据插入
                 $v2->sub  = DB::table('sku')->where('id',$v2->sku_id)->get();
 
                 foreach ($v2->sub as $k3 => &$v3) {
                     //查询good表数据
                     $v3->sub  = DB::table('good')->where('id',$v3->good_id)->get();

                     $count += 1;
                 }
 
             }
         }

         ///退货订单
        $order33 = DB::table('order1')->where('order1.user_id',session('home_user')->id)->where('status','!=','3')->get();

        foreach ($order33 as $k => &$v) {
            //查询详情插入数组
            $v->sub  = DB::table('order_detail')->where('order_id',$v->id)->get();
            foreach ($v->sub as $k2 => &$v2) {
                //查询sku商品数据插入
                $v2->sub  = DB::table('sku')->where('id',$v2->sku_id)->get();

                foreach ($v2->sub as $k3 => &$v3) {
                    //查询good表数据
                    $v3->sub  = DB::table('good')->where('id',$v3->good_id)->get();
                }

            }
        }

        //  dump($count);
        // dump($order33);
       

        return view('home/order/index',['order'=>$order,'order0'=>$order0,'order1'=>$order1,'order2'=>$order2,'order33'=>$order33,'count'=>$count]);
    }

    /**
     *  改变订单的状态(改变为2,可以评论)
     *
     */
    public function  changeStatus(Request $request)
    {
        // echo '1';
        $res = DB::table('order1')->find($request->input('id'));
        // 把状态取反
        $status =  '2';
        
        // 查出当前数据
        $save = DB::table('order1')
        ->where('id', $request->input('id'))
        ->update(['status' => $status]);
        
        // 判断是否成功
        if($save){
            echo 'ok';
        }else{
            echo 'no';
        }
       
    }

    /**
     *  订单退货
     *
     */
    public function tuihuo(Request $request)
    {
       // dump($request->all());
       DB::table('order1')->where('id',$request->all()['id'])->update(['status'=>3]);

       $order = DB::table('order_detail')->where('order_id',$request->all()['id'])->get();

       foreach($order as $k=>$v){
           $sku = DB::table('sku')->where('id',$v->sku_id)->first();

           $number = $sku->num + $v->num;

           DB::table('sku')->where('id',$v->sku_id)->update(['num'=>$number]);
       }
    }

}
