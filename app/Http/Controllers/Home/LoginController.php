<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hash;
use DB;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 加载模板
    	return view('home.login.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function dologin(Request $request)
    {
        // dd($request->input());

        //验证数据
        $this->validate($request, [ 
            'email' => 'required|email',
            'passwd' => 'required',         
        ],[

            'email.required'=>'邮箱必填',    
            'email.email'=>'邮箱格式错误',  
            'passwd.required'=>'密码必填',    
              
        ]);


        //查询 表中数据
        $email = $request->input('email','');
        $passwd = $request->input('passwd','');


        $user = DB::table('users')->where('email',$email)->first();
        // dd( $user);

            if(!empty($user))
            {


        
                //状态是否为已经激活
                if($user->status !== '1'){
                    echo "<script>alert('该邮箱没有激活，请前往邮箱激活');location.href='/home/login';</script>";   			
                    exit;
                }
            
                // 验证密码正确
                if (!Hash::check($passwd, $user->passwd)) {

                    echo "<script>alert('用户名或者密码错误');location.href='/home/login';</script>";   			
                        exit;
                }


                // 登录成功
                // session(['home_login'=>true]);
                session(['home_user'=>$user]);


                // 跳转
                return redirect('/'); 
       
        
        }else{
            return back()->with('success', '账户或密码错误');
        
        }

    }
}
