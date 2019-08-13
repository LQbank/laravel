<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class CenterController extends Controller
{
    public function index()
    {
        return view('home/center/index');
    }
}
