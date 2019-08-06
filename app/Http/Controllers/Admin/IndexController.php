<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        return view('admin/index/index');
    }
}
