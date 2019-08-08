<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class ShopCarController extends Controller
{
    /**
     * 把商品加入购物车
     *
     * @return \Illuminate\Http\Response
     */
    public function insert(Request $request)
    {
        // $_SESSION['car'] = null;exit;
        // dump($request->id);
        // dump($request->num);
        
        // dump($id);
        // dump($data);
        $id = $request->id;

        // 判断该商品是否已在购物车
        if(empty($_SESSION['car'][$request->id])){
            // 获取商品sku
            $data = DB::table('sku')->where('id',$request->id)->first();
            $data->number = $request->num;
            $_SESSION['car'][$id] = $data;
        }else{
            // 当前数量
            $_SESSION['car'][$id]->number = $_SESSION['car'][$id]->number + $request->num;
        }

        // 将商品存入购物车
        // $_SESSION['car'][] = $data;
        // dump($_SESSION['car']);
        return back();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
