<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
	/**
     * 订单页面
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home/order/index');
    }
}
