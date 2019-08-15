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
        
        $id = $request->id;

        // 判断用户是否登录
        if(session('home_user') != null){
            // 查出购物车中的商品
            $data1 = DB::table('cart')->where('sku_id',$request->id)->first();

            // 商品是否存在 不存在插入数据库 存在让商品的购买数量相加
            if(count($data1) == 0){
                $cart['sku_id'] = $request->id;
                $cart['user_id'] = session('home_user')->id;
                $cart['number'] = $request->num;
                // 执行插入
                DB::table('cart')->insert($cart);
            }else{
                $cart2['number'] = $data1->number + $request->num;
                // 执行修改
                DB::table('cart')->where('sku_id',$request->id)->update($cart2);
            } 
        }

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
        // dump($_SESSION['home_user']->id);exit;
        $count = 0;

        // 判断是否登录
        if(isset($_SESSION['home_user'])){
            // 查出当前用户的购物车
            $aa = DB::table('cart')->where('user_id',$_SESSION['home_user']->id)->get();

            // 判断是否存在 存在 让数量相加 不存在 赋值为0
            if(count($aa) > 0){
                foreach($aa as $val){
                    $count += $val->number;
                }
            }else{
                $count = 0;
            }
            
        }else{
            // 判断session 购物车是否为空 为空赋值为0 否则遍历 让数量相加
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
        }

        // $data = new ShopCarController();
        // $data->number2();
        // $this->number2();
        // dump(session('home_user'));

        return $count;
    }

    public function number2()
    {


        // if(empty(session('home_user'))){
        //     echo  '0';
        // }else{
        //     echo  '1';
        // }
    }

    /**
     * 删除购物车商品
     *
     * @return \Illuminate\Http\Response
     */
    public function shanajax(Request $request)
    {
        // dump($request->id);
        // 遍历session 购物车 并把数据删除
        foreach($_SESSION['car'] as $key => $value){
            if($value->id == $request->id){
                unset($_SESSION['car'][$request->id]);
            }
        }

        // 判断是否登录 登录把数据库中的数据删除
        if(session('home_user') != null){
            DB::table('cart')->where('sku_id',$request->id)->delete();
        }
    }

    /**
     * 购物车商品结算
     *
     * @return \Illuminate\Http\Response
     */
    public function jiesuan(Request $request)
    {

        // 判断是否登录 没登陆 跳到登陆页面
        if(session('home_user') == null){
            return redirect('/home/login')->with('message','请去登录');
            exit;
        }
        // echo '123';
        // dump($request->all());

        // 查出当前用户所有的地址
        $res = DB::table('addresses')->where('user_id',session('home_user')->id)->get();
        // dump();
        // dump($res);

        $message = $request->all();
        // dump($message['xuan']);
        // dump($message['num']);
        $array = [];

        // 遍历出所选中商品的id
        foreach($message['xuan'] as $k=>$v){
            // 查出选中商品的具体信息
            $sku = DB::table('sku')
                ->select('sku.*','good.name')
                ->join('good','good.id','sku.good_id')
                ->where('sku.id',$v)->first();
            // dump($sku);

            // 信息压入数组中
            $array[$v] = $sku;

            // 把商品数量 遍历压入数组中
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

        // 具体的时间日期 连接随机字符串生成订单号
        $order['code'] = date('Ymd').uniqid();


        $order['user_id'] = session('home_user')->id;
        $order['address_id'] = $request->all()['addid'];
        $order['total'] = $request->all()['zongjia'];
        $order['status'] = 0;


        // 执行添加 并返回id
        $order_id = DB::table('order1')->insertGetId($order);
        // dump($order_id);

        // 把购买的商品sku id遍历
        foreach($request->all()['id'] as $key=>$sku_id){
            $order_detail['order_id'] = $order_id;
            $order_detail['sku_id'] = $sku_id;
            $order_detail['num'] = $request->all()['number'][$key];

            // 查出商品数量
            $num = DB::table('sku')->where('id',$sku_id)->select('num')->first();
            // dump($num->num - 1);

            // 新商品总数 = 商品总数 - 购买的数量
            $num2['num'] = $num->num - $request->all()['number'][$key];

            // 修改数据库
            $res = DB::table('sku')->where('id',$sku_id)->update($num2);

            // 执行插入订单详情表
            $res2 = DB::table('order_detail')->insert($order_detail);

            // 购物车商品的删除
            $res3 = DB::table('cart')->where('sku_id',$sku_id)->delete();

            // 删除session 中的商品
            unset($_SESSION['car'][$sku_id]);
        }

        // if($order_id && $res && $res2){
        //     $_SESSION['car'] = null;
        // }

        // 判断是否成功
        if($order_id && $res && $res2){
            // $_SESSION['car'] = null;
            DB::commit();
            return redirect('home/shopcar/jiesuan3/'.$request->all()['zongjia'].'/'.$request->all()['addid']);
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
    public function jiesuan3(Request $request,$total,$addid)
    {
        // dump($total);
        // dump($addid);
        // // echo '123';
        // dump($request->all());

        // 商品结算的地址
        $address = DB::table('addresses')->where('id',$addid)->first();
        // dump($address);
        return view('home.order.successes',['total'=>$total,'address'=>$address]);
    }


    
}
