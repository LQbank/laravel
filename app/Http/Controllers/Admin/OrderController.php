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
        $Order = DB::select("select order1.*,users.email,addresses.*,order1.id as orderid from order1,users,addresses where order1.user_id=users.id and order1.address_id=addresses.id");
        // $Order = DB::select("select * from order1");
        dump($Order);

        return view('admin.order.index',['order1'=>$Order]);
    }
    /**
     * 查看订单详情
     *
     * @return \Illuminate\Http\Response
     */
    public function showorder($id)
    {
        $OrderDetail = DB::select("select order_detail.*,sku.*,good.*,order_detail.num as detailnum from order_detail,sku,good where order_detail.sku_id=sku.id and sku.good_id=good.id and order_detail.order_id={$id}");
        // dump($id);
        // dump($OrderDetail);

        return view('admin.order.showorder',['orderdetail'=>$OrderDetail]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
