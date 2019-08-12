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
        $res = DB::table('addresses')->where('user_id',session('home_user')->id)->get();
        // dump();
        // dump($res);

        $message = $request->all();
        // dump($message['xuan']);
        // dump($message['num']);
        $array = [];

        foreach($message['xuan'] as $k=>$v){
            $sku = DB::table('sku')
                ->select('sku.*','good.name')
                ->join('good','good.id','sku.good_id')
                ->where('sku.id',$v)->first();
            // dump($sku);
            $array[$v] = $sku;

            foreach($message['num'] as $kk=>$vv){
                if($kk == $v){
                    $array[$v]->number = $vv;
                }
            }
        }
        // dump($array);
        // dump($array->toArray());
        return view('home/car/jiesuan',['array'=>$array,'address'=>$res]);
        
    }

    /**
     * 购物车商品执行结算
     *
     * @return \Illuminate\Http\Response
     */
    public function jiesuan2(Request $request)
    {
        // 开启事务
        DB::beginTransaction();

        // code user_id address_id sku_id num total status
        $order['code'] = date('Ymd').uniqid();
        $order['user_id'] = session('home_user')->id;
        $order['address_id'] = $request->all()['addid'];
        $order['total'] = $request->all()['zongjia'];
        $order['status'] = 0;



        $order_id = DB::table('order1')->insertGetId($order);
        // dump($order_id);

        foreach($request->all()['id'] as $key=>$sku_id){
            $order_detail['order_id'] = $order_id;
            $order_detail['sku_id'] = $sku_id;
            $order_detail['num'] = $request->all()['number'][$key];

            $num = DB::table('sku')->where('id',$sku_id)->select('num')->first();
            // dump($num->num - 1);
            $num2['num'] = $num->num - $request->all()['number'][$key];
            $res = DB::table('sku')->where('id',$sku_id)->update($num2);

            $res2 = DB::table('order_detail')->insert($order_detail);
        }

        if($order_id && $res && $res2){
            $_SESSION['car'] = null;
        }

        // 判断是否成功
        if($order_id && $res && $res2){
            $_SESSION['car'] = null;
            DB::commit();
            return redirect()->route('home/shopcar/jiesuan3',['total'=>$request->all()['zongjia'],'addid'=>$request->all()['addid']]);
        }else{
            DB::rollBack();
            return back()->with('error', '添加失败');
        }

        // function build_order_no(){
        //     return date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
        // }
        // dump(uniqid());
        // dump($code);
        // echo build_order_no();
        // dump(session('home_user')->id);
        // dump($request->all()['addid']);
        // dump($request->all());
    }

    /**
     * 订单完成页面
     *
     * @return \Illuminate\Http\Response
     */
    public function jiesuan3(Request $request)
    {
        // dump($total);
        // dump($addid);
        // echo '123';
        // dump($request->all());
        $address = DB::table('addresses')->where('id',$request->all()['addid'])->first();
        // dump($address);
        return view('home.order.successes',['total'=>$request->all()['total'],'address'=>$address]);
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
