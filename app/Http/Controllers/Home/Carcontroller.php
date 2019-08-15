<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class Carcontroller extends Controller
{
    /**
     * 显示购物车页面
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 判断购物车是否存在
        if(!isset($_SESSION['car'])){
            $_SESSION['car'] = [];
        }
        // dump($_SESSION);

    	// dump($_SESSION['car']);
        // dump(session('home_user') != null);

        // 判断是否登录 登录查出数据库中的购物车商品 否则查看session中的购物车
        if(session('home_user') != null){
            $sql = "select cart.*,sku.*,good.name as goodname from cart,sku,good where sku.id=cart.sku_id and good.id=sku.good_id";
            $goods = DB::select($sql);
            // dump($goods);
        }else{
            // 遍历购物车中的商品 把商品的名称加入session中
            foreach($_SESSION['car'] as $k=>$v){
                
                $good = DB::table('good')->where('id',$v->good_id)->first();
                
                $v->goodname = $good->name;
            }
            $goods = $_SESSION['car'];
        }
    	

    	// dump($_SESSION['car']);

        return view('home/car/index',['car' => $goods]);
    }
}
