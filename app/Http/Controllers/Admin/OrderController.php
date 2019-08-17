<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;

class OrderController extends Controller
{
    /**
     * 查看订单页面
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 查出所有的订单信息
        $Order = DB::select("select order1.*,users.email,addresses.*,order1.id as orderid from order1,users,addresses where order1.user_id=users.id and order1.address_id=addresses.id");
        // $Order = DB::select("select * from order1");
        // dump($Order);

        return view('admin.order.index',['order1'=>$Order]);
    }
    /**
     * 查看订单详情
     *
     * @return \Illuminate\Http\Response
     */
    public function showorder($id)
    {
        // 查出订单的具体商品
        $OrderDetail = DB::select("select order_detail.*,sku.*,good.*,order_detail.num as detailnum from order_detail,sku,good where order_detail.sku_id=sku.id and sku.good_id=good.id and order_detail.order_id={$id}");
        // dump($id);
        // dump($OrderDetail);

        return view('admin.order.showorder',['orderdetail'=>$OrderDetail]);
    }

    /**
     *  改变订单的状态
     *
     */
    public function  changeStatus(Request $request)
    {
        $res = DB::table('order1')->find($request->input('id'));
        // 把轮播图状态取反
        $status =  $res->status  ? '0' : '1';
        
        // 查出当前轮播图数据
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

   

   


   

    
}
