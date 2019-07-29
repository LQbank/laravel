<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hash;
use DB;


class LoginController extends Controller
{
    //
   	public function login()
   	{
   		// 加载登录页面
   		return view('admin.login.login');
   	}

   	public function dologin(Request $request)
   	{
   		// $arr = [
   		// 	['name'=>'zhangsan','passwd'=>Hash::make('123123')],
   		// 	['name'=>'lisi','passwd'=>Hash::make('123123')],
   		// 	['name'=>'admin','passwd'=>Hash::make('123123')],
   		// ];

   		// foreach ($arr as $key => $value) { 
   		// 	DB::table('admin_user')->insert($value);
   		// }

   		
   		// 获取信息
   		$name = $request->input('name','');
   		$passwd = $request->input('passwd','');


   		$userinfo = DB::table('admin_user')->where('name',$name)->first();
   		// dd($passwd);
   		if(!$userinfo){
			echo "<script>alert('用户名或者密码错误');location.href='/admin/login';</script>";   			
   			exit;
   		}


   		// 验证密码正确
   		if (!Hash::check($passwd, $userinfo->passwd)) {

			
   		    echo "<script>alert('用户名或者密码错误');location.href='/admin/login';</script>";   			
      			exit;
   		}


   		// 登录成功
   		session(['admin_login'=>true]);
   		session(['admin_userinfo'=>$userinfo]);


         // 获取当前用户的权限
         $node = DB::select('select n.cname,n.aname from node as n,user_role as ur,role_node as rn where ur.uid = '.$userinfo->id.' and ur.rid = rn.rid and rn.nid = n.id');

         $node_data = [];
         foreach ($node as $key => $value) {
            if($value->aname == 'create'){
               $node_data[$value->cname][] = 'store'; 
            }

            if($value->aname == 'edit'){
               $node_data[$value->cname][] = 'update'; 
            }

            $node_data[$value->cname][] = $value->aname; 

         }
         // 压入后台首页权限
		 $node_data['indexcontroller'][] = 'index'; 
		 
		//  dd($node_data);

         // 将权限压入session
		 session(['admin_nodes'=>$node_data]);
		 
	

   		// 跳转
   		return redirect('admin'); 

   	}
}
