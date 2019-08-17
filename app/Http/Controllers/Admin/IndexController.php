<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * 网站后台首页
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dump('这是首页');
        $admin = count(DB::table('admin_user')->get());
        $users = count(DB::table('users')->get());
        $order1 = count(DB::table('order1')->get());
        $good = count(DB::table('good')->get());

        // dump($admin);

        return view('admin/index/index',['admin'=>$admin,'users'=>$users,'order1'=>$order1,'good'=>$good,]);
    }
}
