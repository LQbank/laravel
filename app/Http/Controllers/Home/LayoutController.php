<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class LayoutController extends Controller
{
     public static function index()
    {
        $link=DB::table('links')->where('status','1')->get();
        // dd($link);
        return $link;
    }
    public function center()
    {
        $link=DB::table('links')->get();
        return view('home/layout/center',['link'=>$link]);
    }
}
