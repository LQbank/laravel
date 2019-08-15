<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class Carcontroller extends Controller
{
    public function index()
    {
        if(!isset($_SESSION['car'])){
            $_SESSION['car'] = [];
        }
        dump($_SESSION);

    	// dump($_SESSION['car']);
    	foreach($_SESSION['car'] as $k=>$v){
    		// dump($v);
    		$good = DB::table('good')->where('id',$v->good_id)->first();
    		// dump($good);
    		$v->goodname = $good->name;
    	}

    	// dump($_SESSION['car']);

        return view('home/car/index',['car' => $_SESSION['car']]);
    }
}
