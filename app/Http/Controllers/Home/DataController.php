<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use  App\Models\Users;
use Illuminate\Support\Facades\Storage;

use Hash;
use Mail;



use App\Http\Requests\homeuserRequest;

class DataController extends Controller
{
    public function index()
    {

        // dd(explode(',', session('home_user')->birthday));
        return view('home/data/index');
    }

    public function changedata(Request $request)
    {

        // dd($request->input());
        $id= session('home_user')->id;

        
        // 查出当前数据
        $user = Users::where('id',$id)->first();

        // 准备添加的参数
        $user->nickname = $request->input('nickname','');
        $user->name = $request->input('name','');
        
        //性别
        switch($request->input('radio',''))
        {
            case 'boy':
                $user->sex ='1';
            break;  
            case 'girl':
                $user->sex ='0';
            break;
            default:
                $user->sex ='2';
        }

        //生日
        $user->birthday = $request->input('birthday','');

        //判断email是否存在
        if($request->input('email','')){
            $user->email = $request->input('email','');
        }
        //判断phone是否存在
        if($request->input('phone','')){
            $user->phone = $request->input('phone','');
        }
        
       

        // 修改
        $res1 = $user->save();

        // dd($res1);

        // 判断是否成功
        if($res1){
            //修改当前页面session
            $user = Users::where('id',$id)->first();

            session(['home_user'=>$user]);


            return redirect('admin/users')->with('success', '修改');
        }else{
            return back()->with('error', '修改失败');
        }


    }

    /**
     *  修改图片
     */
    public function avatar(Request $request)
    {
        // dump($request->input());
        // dump($request->file());

        $id = $request->input('id','');

        // 检查文件上传
        if ($request->hasFile('avatar')) {
            // 获取头像
            $path = $request->file('avatar')->store(date('Ymd'));
            


            // 查出当前数据
            $usersinfo = Users::where('id',$id)->first();

            if($usersinfo->avatar !=='20190727/DFl323SLCZq4QyXzt95SSE63L02nl4TuZCq59RIs.jpeg'){
                // 删除图片
                Storage::delete([$usersinfo->avatar]);
            }
            
 
            //连接表修改
            $user = Users::find($id);
            $user->avatar = $path;
            $res1 = $user->save();

           
            //判断是否成功
            if($res1){
                //修改session图片
                session('home_user')->avatar=$path;

               echo $path;
            }


        }else{
            
        }

       
    }

    /**
     *  安全设置
     */
    public function safety(Request $request)
    {

        return view('home/data/safety');

    }
    
    /**
     *  修改密码
     */
    public function changepassword(Request $request)
    {

        return view('home/data/changepassword');

    }

     /**
     *  执行修改
     */
    // public function edit(homeuserRequest $request)
    public function edit(Request $request)
    {

        // dd($request->input());

        $passwd = $request->input('oldpasswd','');

        //查询登录的用户数据
        $user = Users::find(session('home_user')->id);
    
        // 验证原密码正确
   		if (!Hash::check($passwd, $user->passwd)) {
            return back()->with('success', '原密码错误');
        }
        
         //验证数据
         $this->validate($request, [ 
            'oldpasswd' => 'required',
            'passwd' => 'required|regex:/^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{8,16}$/',
            'repass' => 'required|same:passwd',
        ],[
            'oldpasswd.required'=>'原密码必填',    
        
            'passwd.required'=>'新密码必填',    
            'passwd.regex'=>'新密码格式错误',    
            'repass.required'=>'确认密码必填',    
            'repass.same'=>'俩次密码不一致', 
          
        ]);


        $user = Users::find(session('home_user')->id);

        // 修改数据字段
        $user->passwd = Hash::make($request->input('passwd',''));
        

        // 保存并判断是否成功
        if($user->save()){
            return back()->with('success', '修改成功');
        }


    }


    /**
     *  换绑邮箱
     */
    public function email(Request $request)
    {
        return view('home/data/email');
    }

    public  function  changeemail(Request $request)
    {
        //验证不能与之前相同
        $users= Users::find(session('home_user')->id);
        if($request->input('email','') == $users->email){
            // dd($request->input('email',''));
            // dd($users->email);
            echo "<script>alert('换绑邮箱不能与之前相同');location.href='/home/data/email'</script>";
            exit;
        }
         //验证数据
         $this->validate($request, [ 
            'email' => 'required|unique:users',
          
        ],[
            'email.required'=>'邮箱不能为空',  
            'email.unique' =>'邮箱已被绑定别的账户'
        ]);
        
      
       



        //查询当前用户数据
    	$users= Users::find(session('home_user')->id);
    	$users->email = $request->input('email','');
        $users->token = str_random(30);
        $users->status = '0';
    	
    	if ($users->save()) {
    		// 发送邮件 
    		Mail::send('home.email.email',['id'=>session('home_user')->id,'token'=>$users->token],function ($m) use ($users) {
    			$m->to($users->email)->subject('[lamp软件学院]注册激活邮件！');
			});
			
			// echo "添加成功";
			
             //修改session邮箱
             session('home_user')->email=$users->email;
            // echo "<script>alert('换绑成功，请前往邮箱激活');location.href='/home/data/email'</script>";
            return redirect('/home/data/safety')->with('success', '换绑成功,请前往邮箱激活');
    		
    	}else{
    		echo "<script>alert('添加失败');location.href='/home/register'</script>";
    	}

    }


    /**
     *  换绑手机
     */
    public function phone(Request $request)
    {
        return view('home/data/phone');
    }
     // 绑定手机号
     public function changephone(Request $request)
     {

        //验证数据
        $this->validate($request, [ 
            'phone' => 'required|unique:users',
            'code' => 'required',
        ],[
            'phone.required'=>'手机号不能为空',  
            'phone.unique' =>'手机号已被绑定别的账户',
            'code.required'=>'验证码必填',
            
        ]);
 
         // 验证手机的验证码
         $phone=$request->input('phone',0);
        //  dd( $phone);
 
         // 获取发送到手机上验证码
         $key = $phone.'_code';
 
         $phone_code = session($key);
 
         $code = $request->input('code',0);



         if ($phone_code != $code) {
             
             echo "<script>alert('验证码错误');location.href='/home/data/phone'</script>";
             exit;
         }
       
        //查询当前用户数据
    	$users= Users::find(session('home_user')->id);
        $users->phone = $request->input('phone','');

        if ($users->save()) {
            //  echo "绑定手机成功"; 
             //修改session手机
             session('home_user')->phone=$users->phone;
            echo "<script>alert('绑定手机成功');location.href='/home/data/safety'</script>";
        }else{
             // return redirect('/home/register');
             echo "<script>alert('绑定手机失败');location.href='/home/data/phone'</script>";
        }
     }

     //换绑手机号
     public function changephone2(Request $request)
     {
        // 验证手机的验证码 
        $phone2=$request->input('phone2',0);
        
        $phone=$request->input('phone',0);
      
       
        if($phone2==$phone){

            echo "<script>alert('新手机号不能与旧手机号相同');location.href='/home/data/phone'</script>";
            exit;
        }

         //验证数据
         $this->validate($request, [ 
            'phone' => 'required|unique:users',
            'code' => 'required',
            'phone2' => 'required',
            'code2' => 'required',
        ],[
            'phone.required'=>'新手机号不能为空',   
            'phone.unique' =>'手机号已被绑定别的账户', 
            'code.required'=>'新手机验证码必填',
            'phone2.required'=>'旧手机号不能为空',    
            'code2.required'=>'旧手机验证码必填',

        ]);



       
        
        // 获取发送到手机上验证码
        $key = $phone.'_code';
        $key2 = $phone2.'_code';

        $phone_code = session($key);
        $phone_code2 = session($key2);
        

        $code = $request->input('code',0);
        $code2 = $request->input('code2',0);

        // dd( $code,$code2);

        if ($phone_code2 != $code2) {
            
            echo "<script>alert('旧手机号验证码错误');location.href='/home/data/phone'</script>";
            exit;
        }
        if ($phone_code != $code) {
            
            echo "<script>alert('新手机号验证码错误');location.href='/home/data/phone'</script>";
            exit;
        }
       
      
      

    
        //查询当前用户数据
        $users= Users::find(session('home_user')->id);
        $users->phone = $request->input('phone','');
  
          if ($users->save()) {
              //  echo "绑定手机成功"; 
               //修改session手机
               session('home_user')->phone=$users->phone;
              echo "<script>alert('绑定手机成功');location.href='/home/data/safety'</script>";
          }else{
               // return redirect('/home/register');
               echo "<script>alert('绑定手机失败');location.href='/home/data/phone'</script>";
          }
     }
 
}
