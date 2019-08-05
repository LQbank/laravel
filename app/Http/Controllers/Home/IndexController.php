<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    
    public function index()
    {
    	return view('home/index/index');
    }

    public function logout(Request $request)
    {

        $request->session()->flush();
        // 跳转
        return redirect('/home'); 

    }
    
}
