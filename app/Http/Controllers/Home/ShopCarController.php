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
        // dump($_SESSION);
        // if(!isset($_SESSION['home_user'])){
        //     return redirect('/home/login');
        //     exit;
        // }
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
     * 查出购物车商品数目
     *
     * @return \Illuminate\Http\Response
     */

    public static function number()
    {
        // dump($_SESSION['car']);
        if(empty($_SESSION['car'])){
            $count = 0;
        }else{
            $count = 0;

            foreach($_SESSION['car'] as $key => $value){
                // dump($value);
                $count += $value->number;
            }
            // dump($_SESSION['car']);
        }

        return $count;
    }

    /**
     * 删除购物车商品
     *
     * @return \Illuminate\Http\Response
     */
    public function shanajax(Request $request)
    {
        // dump($request->id);
        foreach($_SESSION['car'] as $key => $value){
            if($value->id == $request->id){
                unset($_SESSION['car'][$request->id]);
            }
        }
    }

    /**
     * 购物车商品结算
     *
     * @return \Illuminate\Http\Response
     */
    public function jiesuan(Request $request)
    {
        if(session('home_user') == null){
            return redirect('/home/login')->with('message','请去登录');
            exit;
        }
        // echo '123';
        // dump($request->all());
        $message = $request->all();
        dump($message['xuan']);
        dump($message['num']);
        $array = [];

        foreach($message['xuan'] as $k=>$v){
            $sku = DB::table('sku')
                ->select('sku.*','good.name')
                ->join('good','good.id','sku.good_id')
                ->where('sku.id',$v)->first();
            $array[$v] = $sku;

            foreach($message['num'] as $kk=>$vv){
                if($kk == $v){
                    $array[$v]->number = $vv;
                }
            }
        }
        dump($array);
        return view('home/car/jiesuan',['array'=>$array]);
        
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
